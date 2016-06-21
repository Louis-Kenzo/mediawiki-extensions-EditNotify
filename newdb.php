<?php

$wgEditNotify = array(
    'create-page'=>array(
	'usergroup'=>array('userid1','userid2'),
	'userlist'=>array('userid5','userid6'),
	'nonuser'=>array('email-id1','email-id12')
    ),
    'edit-page'=>array(
	'all-pages'=>array(
		'usergroup'=>array('userid1','userid2'),
		'userlist'=>array('userid5','userid6'),
		'nonuser'=>array('email-id1','email-id12')
	),
        'namespaces'=>array('namespace1','namespace2'),
        'category'=>array('category1','category2'),
        'pagelist'=>array(
		'page1'=>array(
		    'usergroup'=>array('userid1','userid2'),
		    'userlist'=>array('userid5','userid6'),
		    'nonuser'=>array('email-id1','email-id12')
		),
		'page2'=>array(
		    'usergroup'=>array('userid1','userid2'),
		    'userlist'=>array('userid5','userid6'),
		    'nonuser'=>array('email-id1','email-id12')
		)
        )
    ),
    'template-field-name'=>array(
	    'template'=>array(
		'field-name1'=>array(
		    'all-pages'=>array(
			'usergroup'=>array('userid1','userid2'),
			'userlist'=>array('userid5','userid6'),
			'nonuser'=>array('email-id1','email-id12')
		    ),
		    'namespaces'=>array('namespace1','namespace2'),
		    'category'=>array('category1','category2'),
		    'pagelist'=>array(
			'page1'=>array(
			    'usergroup'=>array('userid1','userid2'),
			    'userlist'=>array('userid5','userid6'),
			    'nonuser'=>array('email-id1','email-id12')
			),
			'page2'=>array(
			    'usergroup'=>array('userid1','userid2'),
			    'userlist'=>array('userid5','userid6'),
				    'nonuser'=>array('email-id1','email-id12')
			)
		    )
		),
	        'field-name2'=>array(
		    'all-pages'=>array(
		        'usergroup'=>array('userid1','userid2'),
		        'userlist'=>array('userid5','userid6'),
		        'nonuser'=>array('email-id1','email-id12')
		    ),
		    'namespaces'=>array('namespace1','namespace2'),
		    'category'=>array('category1','category2'),
		    'pagelist'=>array(
		        'page1'=>array(
			    'usergroup'=>array('userid1','userid2'),
			    'userlist'=>array('userid5','userid6'),
			    'nonuser'=>array('email-id1','email-id12')
		        ),
		        'page2'=>array(
			    'usergroup'=>array('userid1','userid2'),
			    'userlist'=>array('userid5','userid6'),
			    'nonuser'=>array('email-id1','email-id12')
		        )
		    )
	        )
	    )
	    //template2
    ),
    'template-field-name-value'=>array(
	    'template'=>array(
		    'field-name1'=>array(
			    'field-value'=>array(
			        'all-pages'=>array(
				    'usergroup'=>array('userid1','userid2'),
				    'userlist'=>array('userid5','userid6'),
				    'nonuser'=>array('email-id1','email-id12')
			        ),
			        'namespaces'=>array('namespace1','namespace2'),
			        'category'=>array('category1','category2'),
			        'pagelist'=>array(
				    'page1'=>array(
				        'usergroup'=>array('userid1','userid2'),
				        'userlist'=>array('userid5','userid6'),
				        'nonuser'=>array('email-id1','email-id12')
				    ),
				    'page2'=>array(
				        'usergroup'=>array('userid1','userid2'),
				        'userlist'=>array('userid5','userid6'),
				        'nonuser'=>array('email-id1','email-id12')
				    )
			        )

			    )
		    ),
		    'field-name2'=>array(
			    'field-value'=>array(
			        'all-pages'=>array(
				    'usergroup'=>array('userid1','userid2'),
				    'userlist'=>array('userid5','userid6'),
				    'nonuser'=>array('email-id1','email-id12')
			        ),
			        'namespaces'=>array('namespace1','namespace2'),
			        'category'=>array('category1','category2'),
			        'pagelist'=>array(
				    'page1'=>array(
				        'usergroup'=>array('userid1','userid2'),
				        'userlist'=>array('userid5','userid6'),
				        'nonuser'=>array('email-id1','email-id12')
				    ),
				    'page2'=>array(
				        'usergroup'=>array('userid1','userid2'),
				        'userlist'=>array('userid5','userid6'),
				        'nonuser'=>array('email-id1','email-id12')
				    )
			        )

			    )
		    )
	    )
	    //template2

    )
)
?>