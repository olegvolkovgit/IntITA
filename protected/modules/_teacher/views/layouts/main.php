<?php
/* @var $content*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo Config::getBaseUrl(); ?>/css/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css');; ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/style.css"/>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'cabinet/authForm.js'); ?>"></script>
    <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/trimField.js"></script>
    <title><?php echo Yii::app()->name; ?></title>
</head>

    <body>
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
            $this->renderPartial('/cabinet/_forgotpass');
            $this->endWidget('zii.widgets.jui.CJuiDialog');
            ?>
        </div>
    </body>
</html>