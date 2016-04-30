<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 19.04.2016
 * Time: 11:48
 */
$header = new Header();
?>
<!DOCTYPE html>
<html>
    <head>
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
        <!-- fonts -->
        <link rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/fontface.css"/>
        <!-- fonts -->
        <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/hamburgerMenu.css"/>
        <link rel="shortcut icon" href="<?php echo Config::getBaseUrl(); ?>/css/images/favicon.ico" type="image/x-icon"/>
        <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery-1.8.3.js"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openDialog.js"></script>
        <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css');; ?>"/>
        <!-- passEye, jQuery -->
        <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.passEye.js"></script>
        <!-- passEye, jQuery -->
        <!-- trimEmail-->
        <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/trimField.js"></script>
        <!-- trimEmail -->
        <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
    </head>

    <body style="overflow-y: scroll">
    <?php $this->renderPartial('/site/_hamburgermenu'); ?>
    <div class="main">
        <div style="height: 5px; width: auto"></div>
        <?php if (isset($this->breadcrumbs)): ?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'homeLink' => CHtml::link(Yii::t('breadcrumbs', '0049'), Config::getBaseUrl()),
                'htmlOptions' => array(
                    'class' => 'my-cool-breadcrumbs'
                )
            )); ?><!-- breadcrumbs -->
        <?php endif ?>

        <?php if (!Yii::app()->user->isGuest && !(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index')
            && !(Yii::app()->controller->id == 'aboutus') && !(Yii::app()->controller->id == 'lesson')
        ) {
            $post = Yii::app()->user->model;
            $statusInfo = $this->beginWidget('UserStatusWidget', ['bigView' => true ,'registeredUser'=>$post]);
            $this->endWidget();
        }
        ?>
    </div>
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
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/lessonHamburgerMenu.js"></script>
    </body>
</html>
