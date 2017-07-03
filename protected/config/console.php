<?php
$local_config = require(dirname(__FILE__).'/local.php');
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log','config'),
	'import' => array(
		'application.models.*',
        'application.models.task.*',
		'application.models.user.*',
		'application.models.revision.*',
		'application.models.revision.state.*',
		'application.models.revision.state.course.*',
		'application.models.revision.state.lecture.*',
		'application.models.revision.state.module.*',
        'application.components.*',
        'application.helpers.*',
        'application.helpers.ngtable.*',
        'application.models.accountancy.*',
        'application.models.message.*',
        'application.models.accountancy.services.serviceAccess.*',
        'application.models.quiz.*',
        'application.models.accountancy.services.*',

	),
	// application components
	'components'=>array(

		// database settings are configured in database.php
		'db'=>$local_config['db'],
        'dbForum'=>$local_config['dbForum'],
        'config' => array(
            'class' => 'DConfig',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),

	),
);
