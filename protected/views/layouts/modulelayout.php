<!DOCTYPE html>
<html ng-app="mainApp" xmlns:og="https://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <!-- for tabs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for tabs -->
    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/fontface.css"/>
    <!-- fonts -->
    <!-- layouts style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/style.css"/>
    <!--   hamburger menu style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/hamburgerMenu.css"/>
    <link rel="shortcut icon" href="<?php echo Config::getBaseUrl(); ?>/css/images/favicon.ico" type="image/x-icon"/>
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery-1.8.3.js"></script>
    <!--[if lte IE 8]>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/json3.min.js'); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.29/angular.min.js"></script>
    <script>
        document.createElement('ng-include');
        document.createElement('ng-switch');
        document.createElement('ng-if');
        document.createElement('ng-pluralize');
        document.createElement('ng-view');

        // needed to enable CSS reference
        document.createElement('ng:view');
    </script>
    <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'labelForIe.js'); ?>"></script>
    <![endif]-->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/app.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/ui-bootstrap-tpls-1.3.3.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openDialog.js"></script>
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css');; ?>"/>
    <!-- jQuery -->
    <!-- passEye, jQuery -->
    <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.passEye.js"></script>
    <!-- passEye, jQuery -->
    <!-- trimEmail-->
    <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/trimField.js"></script>
    <!-- trimEmail -->
    <!-- Placeholder for old browser -->
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/placeholder.min.js"></script>
    <!-- Placeholder for old browser -->
    <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
</head>

<body style="overflow-y: scroll" itemscope itemtype="https://schema.org/Product">

<div id="contentBoxMain">
    <?php echo $content; ?>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'forgotpass',
        'themeUrl' => Config::getBaseUrl() . '/css',
        'cssFile' => 'jquery-ui.css',
        'theme' => 'my',
        'options' => array(
            'width' => 540,
            'autoOpen' => false,
            'modal' => true,
            'resizable' => false
        ),
    ));
    $this->renderPartial('/site/_forgotpass');
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>
<!-- footer -->
<!-- Humburger script -->
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/lessonHamburgerMenu.js"></script>
</body>
</html>