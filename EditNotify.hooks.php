<?php

class EditNotifyHooks {
	public static function onBeforeCreateEchoEvent( &$echoNotifications, &$echoNotificationCategories, &$echoNotificationIcons ) {
		$echoNotificationCategories['echo-category-create'] = [
			'priority' => 7,
			'tooltip' => 'echo-pref-tooltip-echo-category-create',
		];
		$echoNotificationCategories['echo-category-edit'] = [
			'priority' => 3,
			'tooltip' => 'echo-pref-tooltip-echo-category-edit',
		];
		$echoNotificationIcons += array(
		    'editnotify-create' => array('path' => "EditNotify/icons/plus.gif"),
		    'editnotify-edit'   => array('path' => "EditNotify/icons/edit.gif")
		);

		//Echo notification for page creation
		$echoNotifications['edit-notify-create'] = array(
			'category' => 'echo-category-create',
			'section' => 'alert',
			'primary-link' => array(
				'message' => 'editnotify-primary-message',
				'destination' => 'title'
			),
			'presentation-model' => 'EchoEditNotifyPageCreatePresentationModel',
			'formatter-class' => 'EchoEditNotifyPageCreateFormatter',
			'title-message' => 'editnotify-title-message-create',
			'title-params' => array( 'title' ),
			'flyout-message' => 'editnotify-flyout-message-create',
			'flyout-params' => array( 'agent', 'title' ),
			'email-subject-message' => 'editnotify-email-subject-message-create',
			'email-subject-params' => array( 'agent', 'title' ),
			'email-body-batch-message' => 'editnotify-email-body-message-create',
			'email-body-batch-params' => array( 'title' )
		);

		//Echo notification for minor page edit
		$echoNotifications['edit-notify-edit-minor'] = array(
		    'category' => 'echo-category-edit',
		    'section' => 'message',
		    'primary-link' => array(
				'message' => 'editnotify-primary-message',
				'destination' => 'title'
		    ),
		    'presentation-model' => 'EchoEditNotifyPresentationModel',
		    'formatter-class' => 'EchoEditNotifyFormatter',
		    'title-message' => 'editnotify-title-message',
		    'title-params' => array( 'title' ),
		    'flyout-message' => 'editnotify-flyout-message',
		    'flyout-params' => array( 'agent', 'title' ),
		    'email-subject-message' => 'editnotify-email-subject-message',
		    'email-subject-params' => array( 'agent', 'title' ),
		    'email-body-batch-message' => 'editnotify-email-body-message',
		    'email-body-batch-params' => array( 'title', 'change' )
		);

		//Echo notification for major page edit
		$echoNotifications['edit-notify-edit-major'] = array(
		    'category' => 'echo-category-edit',
		    'section' => 'alert',
		    'primary-link' => array(
				'message' => 'editnotify-primary-message',
				'destination' => 'title'
		    ),
		    'presentation-model' => 'EchoEditNotifyPresentationModel',
		    'formatter-class' => 'EchoEditNotifyFormatter',
		    'title-message' => 'editnotify-title-message',
		    'title-params' => array( 'title' ),
		    'flyout-message' => 'editnotify-flyout-message',
		    'flyout-params' => array( 'agent', 'title' ),
		    'email-subject-message' => 'editnotify-email-subject-message',
		    'email-subject-params' => array( 'agent', 'title' ),
		    'email-body-batch-message' => 'editnotify-email-body-message',
		    'email-body-batch-params' => array( 'title', 'change' )
		);

		return true;
	}

	public static function onEchoGetDefaultNotifiedUsers( $event, &$users ) {
		switch ( $event->getType() ) {
			case 'edit-notify-edit-minor':
			case 'edit-notify-edit-major':
			case 'edit-notify-create':
				$extra = $event->getExtra();
				$userId = $extra['user-id'];
				$user = User::newFromId( $userId );
				$users[$userId] = $user;
				break;
		}

		return true;
	}

	public static function onPageContentSave( WikiPage &$wikiPage, &$user, &$content, &$summary, $isMinor, $isWatch, $section, &$flags, &$status ) {
		global $wgEditNotifyAlerts;
		$title = $wikiPage->getTitle();
		$text = ContentHandler::getContentText( $content );

		wfDebug( "EditNotify: Edit" );

		$existingPageStructure = ENPageStructure::newFromTitle( $title );
		$newPageStructure = new ENPageStructure;
		$newPageStructure->parsePageContents( $text );

		$newPageComponent = $newPageStructure->mComponents;
		$existingPageComponent = $existingPageStructure->mComponents;

		if (!$wikiPage->exists()) {
			wfDebug( "EditNotify: Page doesn't exist" );
			return true;
		} elseif ( $newPageStructure == $existingPageStructure ) {
			wfDebug( "EditNotify: Page structure didn't change" );
			return true;
		} elseif ( isset( $newPageComponent[0] ) == false ) {
			wfDebug( "EditNotify: No components in new page structure" );
			return true;
		}

		foreach ($wgEditNotifyAlerts as $editNotifyAlert) {
			if (is_array($editNotifyAlert['action']) && in_array('edit',$editNotifyAlert['action']) || $editNotifyAlert['action'] == 'edit') {
				foreach ($editNotifyAlert['users'] as $userToNotify) {
					wfDebug( "EditNotify: Notify $userToNotify" );
					if ($isMinor) {
						wfDebug( "EditNotify: minor edit" );
						self::pageEditNotify($title, 'edit-notify-edit-minor', $userToNotify, 'all pages');
					} else {
						wfDebug( "EditNotify: major edit" );
						self::pageEditNotify($title, 'edit-notify-edit-major', $userToNotify, 'all pages');
					}
				}
			}
		}

		return true;
	}

	public static function onPageContentInsertComplete(WikiPage $wikiPage, User $user, $content, $summary,
		$isMinor,$isWatch, $section, $flags, Revision $revision) {
		global $wgEditNotifyAlerts;
		$title = $wikiPage->getTitle();

		wfDebug( "EditNotify: Creation" );

		foreach ($wgEditNotifyAlerts as $editNotifyAlert) {
			if (is_array($editNotifyAlert['action']) && in_array('create', $editNotifyAlert['action']) || $editNotifyAlert['action'] == 'create') {
				foreach ( $editNotifyAlert['users'] as $userToNotify ) {
					self::pageCreateNotify($title, 'edit-notify-create', $userToNotify);
				}
			}
		}

		return true;
	}

	public static function pageCreateNotify($pageTitle, $pageType, $user) {
		EchoEvent::create(array(
			'type' => $pageType,
			'extra' => array(
				'title' => $pageTitle,
				'user-id' => User::newFromName($user)->getId(),
			),
			'title' => $pageTitle
		));

		return true;
	}

	public static function pageEditNotify($pageTitle, $pageType, $user, $change) {
		EchoEvent::create(array(
			'type' => $pageType,
			'extra' => array(
				'title' => $pageTitle,
				'user-id' => User::newFromName($user)->getId(),
				'change' => $change
			),
			'title' => $pageTitle
		));

		return true;
	}
}
