<!DOCTYPE html>
<html xmlns:og="https://ogp.me/ns#">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo Config::getBaseUrl(); ?>">
    <meta name="twitter:image"
          content="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>">
    <meta property="og:image"
          content="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/fontface.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/hamburgerMenu.css"/>
    <link rel="shortcut icon" href="<?php echo Config::getBaseUrl(); ?>/css/images/favicon.ico" type="image/x-icon"/>
    <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/filters/interpreterJsonFilter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/app.js'); ?>"></script>
    <?php if (!Yii::app()->user->isGuest) { ?>
        <script src="<?php echo Config::getFullChatPath()."/js/ITA.js" ?>"></script>
    <?php } ?>
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openDialog.js"></script>
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css');; ?>"/>
    <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.passEye.js"></script>
    <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/trimField.js"></script>
    <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
</head>

<body style="overflow-y: scroll" itemscope itemtype="https://schema.org/Product" ng-app="interpreterApp">

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
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-83801032-1', 'auto');
    ga('send', 'pageview');

</script>
<!--IntITAMessenger-->
<?php if (!Yii::app()->user->isGuest) { ?>
    <div ita-messenger="" path="<?php echo Config::getFullChatPath() ?>" class="dnd-container"></div>
<?php } ?>
<!--IntITAMessenger-->
</body>
</html>
