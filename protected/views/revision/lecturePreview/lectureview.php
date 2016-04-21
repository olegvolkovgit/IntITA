<?php
    //todo
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $lectureRevision->id_module)),
    'Ревізії занять модуля' => Yii::app()->createUrl('/revision/ModuleLecturesRevisions', array('idModule'=>$lectureRevision->id_module)),
    'Попередній перегляд заняття',
);
?>
<!--highlight-->
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js"></script>
<script src='http://yastatic.net/highlightjs/8.2/highlight.min.js'></script>
<script src="http://pc035860.github.io/angular-highlightjs/angular-highlightjs.min.js"></script>
<!--highlight-->
<!--codemirror textarea hightlight-->
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/lib/codemirror.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/theme/rubyblue.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'codemirror.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/lib/codemirror.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/javascript/javascript.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/clike/clike.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/php/php.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-ui-codemirror/ui-codemirror.js'); ?>"></script>
<!--codemirror textarea hightlight-->

<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular-ui-router.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/revision_preview/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/revision_preview/controllers/lectureRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/revision_preview/controllers/testCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/revision_preview/config.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/revision_preview/directives/hoverSpot.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/revision_preview/directives/startVideo.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script>
    idRevision = '<?php echo $idRevision;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-app="revisionPreviewApp">
    <div ng-controller="lectureRevisionCtrl">
        <div ng-cloak id="revisionMainBox">
            <div class="lessonText">
                <?php
                $this->renderPartial('lecturePreview/_lecturePageTabs', array('lectureRevision' => $lectureRevision));
                ?>
            </div>
            <div class="lectureInfo">
                <?php
                $this->renderPartial('lecturePreview/_lectureInfo', array('lectureRevision' => $lectureRevision));
                ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonsStyle.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>"/>
