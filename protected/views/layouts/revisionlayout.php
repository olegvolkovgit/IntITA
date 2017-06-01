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
        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'fontface.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'style.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'hamburgerMenu.css'); ?>"/>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo StaticFilesHelper::fullPathTo('css', 'images/favicon.ico'); ?>"/>
        <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.min.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/revisionApp.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/services/interpreterServices.js'); ?>"></script>
        <?php if (!Yii::app()->user->isGuest) { ?>
            <script src="<?php echo Config::getBaseUrl()."/crmChat/js/ITA.js" ?>"></script>
        <?php } ?>
        <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'openDialog.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css');; ?>"/>
        <script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'trimField.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />

        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/courseRevisionCtrl.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/getCourseData.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/courseRevisionsActions.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/sendCourseRevisionMessage.js'); ?>"></script>

        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/lectureRevisionCtrl.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/revisionsActions.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/getLectureData.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/filters/interpreterJsonFilter.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/lib/codemirror.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/theme/rubyblue.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'codemirror.css'); ?>"/>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/highlight.min.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/highlight2.min.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular-highlightjs.min.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/lib/codemirror.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/javascript/javascript.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/clike/clike.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/php/php.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-ui-codemirror/ui-codemirror.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/mode/css/css.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/mode/htmlmixed/htmlmixed.js'); ?>"></script>
        
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular-ui-router.min.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'ivpusic/angular-cookies.min.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/sendRevisionMessage.js'); ?>"></script>
        
        <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ckeditor/ckeditor.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ng-ckeditor.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ngBootbox.min.js'); ?>"></script>

        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/getModuleData.js'); ?>"></script>
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/sendModuleRevisionMessage.js'); ?>"></script>
        <link rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.css'); ?>" type='text/css' media='all' />
        <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
        
        <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
    </head>

    <body style="overflow-y: scroll" ng-app="revisionApp">
    <?php $this->renderPartial('/site/_hamburgermenu'); ?>
    <div class="main">
        <div style="height: 15px; width: auto"></div>
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
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'lessonHamburgerMenu.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.passEye.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'titleValidation.js'); ?>"></script>
    </body>

    <!--IntITAMessenger-->
    <?php if (!Yii::app()->user->isGuest) { ?>
        <div ita-messenger="" path="<?php echo Config::getFullChatPath() ?>" class="dnd-container"></div>
    <?php } ?>
    <!--IntITAMessenger-->
</html>
