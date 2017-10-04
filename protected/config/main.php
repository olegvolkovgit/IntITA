<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('editable', dirname(__FILE__) . '/../extensions/x-editable');
$local_config = require(dirname(__FILE__) . '/local.php');
$params_config = require(dirname(__FILE__) . '/params.php');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'INTITA',

    'sourceLanguage' => 'XS',
    'language' => 'ua',

    // preloading 'log' component
    'preload' => array(
        'log',
        'config',
        //'debug'
    ),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.track.*',
        'application.models.track.statistics.*',
        'application.models.accountancy.*',
        'application.models.accountancy.services.*',
        'application.models.accountancy.services.serviceAccess.*',
        'application.models.accountancy.paymentScheme.*',
        'application.models.accountancy.corporateEntity.*',
        'application.models.accountancy.agreements.*',
        'application.models.accountancy.contractingParty.*',
        'application.models.accountancy.userDocuments.*',
        'application.models.message.*',
        'application.models.quiz.*',
        'application.models.slider.*',
        'application.models.revision.*',
        'application.models.crm.*',
        'application.models.crm.tasksState.*',
        'application.models.revision.state.*',
        'application.models.revision.state.lecture.*',
        'application.models.revision.state.module.*',
        'application.models.revision.state.course.*',
        'application.models.user.*',
        'application.components.*',
        'application.components.widgets.*',
        'application.components.WebSocket.*',
        'ext.imperavi-redactor-widget.*',
        'application.models.task.*',
        // 'ext.yii2-debug.*',
        'application.helpers.*',
        'application.helpers.ngtable.*',
        'editable.*', //easy include of editable classes
        'ext.giix-components.*', // giix components
        'ext.PHPExcel.*', //PHPExcel
        'application.components.Exceptions.*',
        'application.models.quiz.TaskMarks.php',
        'ext.yii-pdf.*', // html to pdf
    ),

    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'generatorPaths' => array(
                'ext.giix-core', // giix generators
            ),
            'password' => 'admin',
            'ipFilters' => ['127.0.0.1', '10.0.0.1', 'localhost', '::1'] // '::1' - needs for work gii generator
        ),
        '_admin',
        '_teacher',
        '_accountancy',
        //'debug',
    ),

    // application components
    'components' => array(
        'session' => [
            'class' => 'CHttpSession',
            'cookieParams' => [
                'httponly' => true
            ],
        ],

        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),

        'clientScript' => array(
            'class' => 'system.web.CClientScript',
//            'scriptMap'=>array(
//                'jquery.min.js'=>'https://code.jquery.com/jquery-2.2.4.min.js',
//            )
        ),

        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),

        'messages' => array(
            'class' => 'CDbMessageSource',
            'cacheID' => 'cache',
            'cachingDuration' => !YII_DEBUG ? 3600 * 24 : 0,
            'sourceMessageTable' => 'sourcemessages',
            'translatedMessageTable' => 'translate',
        ),

        'user' => array(
            'loginUrl' => array('/site/index'),
            'allowAutoLogin' => true,
            'class' => 'IntITAUser',
        ),

        'authManager' => array(
            'class' => 'application.components.AuthManager',
            'defaultRoles' => array('0'), // по умолчанию 0, то есть гость
        ),

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '/',
            'caseSensitive' => true,
            'rules' => array(
                '' => array('site/index', 'urlSuffix' => ''),
                '<action:login|logout|error|rapidReg>' => 'site/<action>',
                'courses/<selector:\w+>/<organization:\w+>' => 'courses/index',
                'aboutus/<id:\d+>' => 'aboutus/index',
                'invoice/<id:\d+>' => 'payments/invoice',
                'cabinet/<organizationId:\d+>' => '_teacher/cabinet/index',
                'cabinet' => '_teacher/cabinet/index',
                'cabinet/mail' => '_teacher/cabinet/mail',
                'profile/edit' => 'studentreg/edit',
                'agreement/<id:\d+>' => 'payments/showAgreement',


                array('class' => 'CourseRule'),//rules for course page ($routes: 'course/index', 'module/index', 'lesson/index')
                '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',

                'profile/<idUser:\d+>' => 'studentreg/profile', /*TEMP Url for profile tabs */
                'teacher/<idTeacher:\d+>' => 'profile/index', /* Url for teacher page */
                'consultation/course_<idCourse:\d+>&lecture_<lectureId:\d+>' => 'consultationscalendar/index',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                '<controller:aajax>/<action:\w+>' => 'autoadmin/<controller>/<action>',
                '<controller:afile>/<action:\w+>' => 'autoadmin/<controller>/<action>',
                '<controller:\w+>/foreign-<key:\w+>' => 'autoadmin/<controller>/foreign<key>',
            ),
        ),

        'widgetFactory' => array(
            'enableSkin' => true,
        ),

        // database settings are configured in database.php
        'db' => $local_config['db'],
        'db2' => $local_config['db'],
        'dbForum' => $local_config['dbForum'],
        'dbMail' => $local_config['dbMail'],

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CWebLogRoute',
                    'categories' => 'application',
                    'levels' => 'error, warning, trace, profile, info',
                    'showInFireBug' => true
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, trace, info, profile',
                    'categories' => 'system.db.*',
                    'logFile' => 'sql.log',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, trace, info, profile',
                    'categories' => 'application.revision.*',
                    'logFile' => 'revision.log',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, trace, info, profile',
                    'categories' => 'application.crm.*',
                    'logFile' => 'crm.log',
                ),
            ),
        ),

        'config' => array(
            'class' => 'DConfig',
            //'cache'=>3600,
        ),

        //X-editable config
        'editable' => array(
            'class' => 'editable.EditableConfig',
            'form' => 'plain',        //form style: 'bootstrap', 'jqueryui', 'plain'
            'mode' => 'popup',            //mode: 'popup' or 'inline'
            'defaults' => array(              //default settings for all editable elements
                'emptytext' => 'Натисніть для редагування'
            )
        ),

        //'debug' => $local_config['debug'],

        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                    'defaultParams' => array(// More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode' => '', //  This parameter specifies the mode of the new document.
                        'format' => 'A4', // format A4, A5, ...
                        'default_font_size' => 0, // Sets the default document font size in points (pt)
                        'default_font' => '', // Sets the default font-family for the new document.
                        'mgl' => 0, // margin_left. Sets the page margins for the new document.
                        'mgr' => 0, // margin_right
                        'mgt' => 0, // margin_top
                        'mgb' => 0, // margin_bottom
                        'mgh' => 5, // margin_header
                        'mgf' => 5, // margin_footer
                        'orientation' => 'P', // landscape or portrait orientation
                    )
                ),
            ),
        ),
    ),
    'params' => $params_config['params'],
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']

);
