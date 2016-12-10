<? $css_version = 1; ?>
<?php
/* @var $this LessonController */
/* @var $page LecturePage */
/* @var $lecture Lecture */
/* @var $lectureElement LectureElement */
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $page->revision->id_module)),
    'Ревізії занять модуля' => Yii::app()->createUrl('/revision/ModuleLecturesRevisions', array('idModule'=>$page->revision->id_module)),
    'Ревізії заняття' => Yii::app()->createUrl('/revision/revisionsBranch', array('idRevision'=>$page->id_revision)),
    'Ревізія даного заняття' => Yii::app()->createUrl('/revision/EditLectureRevision', array('idRevision'=>$page->id_revision)),
    'Редагування ревізії',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/highlight.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/highlight2.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular-highlightjs.min.js'); ?>"></script>

<link rel="stylesheet" type="text/css"
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/lib/codemirror.css'); ?>"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/theme/rubyblue.css'); ?>"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo StaticFilesHelper::fullPathTo('css', 'codemirror.css'); ?>"/>

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/lib/codemirror.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/mode/javascript/javascript.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/mode/css/css.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/mode/htmlmixed/htmlmixed.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'codemirror/mode/php/php.js'); ?>"></script>

<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ng-ckeditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ngBootbox.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/editor/revisionEditCtrl.js'); ?>"></script>

<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/editor/plainTaskCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/editor/skipTaskCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/editor/taskCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/editor/testCtrl.js'); ?>"></script>

<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/directives/lectureBlocks.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/directives/styleDirectives.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/taskJson.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/getLectureData.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/directives/ajaxLoader.js'); ?>"></script>


<script type="text/javascript">
    lang = '<?php if(CommonHelper::getLanguage()=='ua') echo 'uk'; else echo CommonHelper::getLanguage();?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idPage = '<?php echo $page->id;?>';
    idRevision = '<?php echo $page->id_revision;?>';
    idLecture = '<?php echo $page->revision->id_lecture;?>';
    idModule = <?php echo $page->revision->id_module;?>;
</script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'editPage.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'equation-embed.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'font-awesome.min.css'); ?>" />

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'eq_config.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'eq_editor-lite-18.js'); ?>"></script>

<div ng-app="revisionEdit" class="pageRevision">
    <div ng-controller="CKEditorCtrl">
        <input type="hidden" ng-init="interpreterServer=<?php echo htmlspecialchars(json_encode(Config::getInterpreterServer())); ?>" ng-model="interpreterServer" />
        <div data-ng-init="
        deleteMsg='<?php echo addslashes(Yii::t('lecture', '0767')); ?>';
        errorMsg='<?php echo addslashes(Yii::t('lecture', '0768')); ?>';
        editMsg='<?php echo addslashes(Yii::t('lecture', '0769')); ?>';
        saveMsg='<?php echo addslashes(Yii::t('lecture', '0770')); ?>';
        saveBtn='<?php echo addslashes(Yii::t('lecture', '0771')); ?>';
        closeBtn='<?php echo addslashes(Yii::t('lecture', '0772')); ?>';
            ">
        </div>
        <div data-loading id="loaderContainer">
            <img id="ajaxLoader" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
        </div>
        <div id="lecturePage">
            <h1 class="lessonPart lessonEditPart">
                <?php echo Yii::t('lecture', '0073') . " : ".CHtml::encode($page->revision->properties->title_ua); ?>
            </h1>
            <div class="lectureProgress">
                <?php foreach($pages as $part){ ?>
                    <a class="pageTitle" class="pageDone"
                       id="<?php if($page->id==$part->id) echo "currentPage" ?>"
                       href="<?=Yii::app()->createUrl("revision/editPageRevision", array("idPage" => $part->id)); ?>"
                       title="<?php echo $part->page_title ?>"
                        >
                        <div class="spotDone"></div>
                    </a>
                <?php } ?>
            </div>
            <div class='icons'>
                <a ng-href='<?=Yii::app()->createUrl("revision/previewLectureRevision", array("idRevision" => $page->id_revision)); ?>#/page{{page}}'>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'preview.png'); ?>" title="Попередній перегляд"/>
                </a>
            </div>
            <table class="table" id="pageView">
                <tr>
                    <div class="pageTitleCke">
                        Назва сторінки:
                        <?php
                        $this->widget('editable.EditableField', array(
                            'type' => 'text',
                            'model' => $page,
                            'attribute' => 'page_title',
                            'url' => $this->createUrl('revision/editPageTitle'),
                            'title' => 'Введи назву частини',
                            'placement' => 'right',
                            'params'     => array('idRevision' => $page->id_revision),
                        ));
                        ?>
                    </div>
                    <div class="videoLink">
                        <?php
                        if($page->video){
                            echo Yii::t('lecture', '0613').': ';
                            $this->widget('editable.EditableField', array(
                                'type' => 'text',
                                'model' => $page->getVideo(),
                                'attribute' => 'html_block',
                                'url' => $this->createUrl('revision/editVideo'),
                                'title' => Yii::t('module', '0369'),
                                'placement' => 'right',
                                'params'     => array('idRevision' => $page->id_revision, 'idPage' => $page->id),
                            ));
                            ?>
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png'); ?>"
                                 class="editIco"
                                 title="Видалити відео"
                                 ng-click="deleteVideo(<?= $page->id ?>,<?= $page->id_revision ?>,<?= $page->video ?>)">
                        <?php } else { ?>
                            <div class="row col-lg-4">
                                <div class="input-group" ng-form="myForm">
                                    <input type="url" class="form-control" name="inputUrl" ng-model="url.text" id="pageVideo" required />
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="button" ng-disabled="myForm.$invalid" ng-click="addPageVideo(<?= $page->id ?>,<?= $page->id_revision ?>)">Додати відео</button>
                                    </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </tr>
            </table>
            <fieldset>
                <h3>Контент сторінки:</h3>
                <div id="blockList">
                    <?php $this->renderPartial('/revision/_blocks_list_CKE', array('dataProvider' => $dataProvider, 'editMode' => 1, 'user' => $user)); ?>
                </div>
                <div ng-cloak id="addBlock" style="display: none;">
                    <div ng-class="{lessonInstr: instructionStyle,  lessonBG: instructionStyle}">
                        <div ng-show="instructionStyle" class="instrTaskImg" >
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'instr.png'); ?>">
                        </div>
                        <div ng-class="{content: instructionStyle}" >
                            <?php
                            $this->renderPartial('/revision/_addBlockCKE', array('idPage' => $page->id, 'idRevision' => $page->id_revision, 'editMode' => 1));
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div style="display: block; clear: both">
                    <?php echo Yii::t('lecture', '0691'); ?>
                    <br>
                    <button selected-button class="btn btn-default" ng-click="addTextBlock('<?php echo LectureElement::TEXT; ?>')"><?php echo Yii::t('lecture', '0692'); ?></button>
                    <button selected-button class="btn btn-default" ng-click="addCodeBlock('<?php echo LectureElement::CODE; ?>')"><?php echo Yii::t('lecture', '0693'); ?></button>
                    <button selected-button class="btn btn-default" ng-click="addTextBlock('<?php echo LectureElement::EXAMPLE; ?>')"><?php echo Yii::t('lecture', '0694'); ?></button>
                    <button selected-button class="btn btn-default" ng-click="addInstructionBlock('<?php echo LectureElement::INSTRUCTION; ?>')"><?php echo Yii::t('lecture', '0695'); ?></button>
                </div>
            </fieldset>
            <h3><label for="pageQuiz"><?php echo Yii::t('lecture', '0696'); ?></label></h3>
            <?php
            if ($quiz != null) {
                switch ($quiz->id_type) {
                    case LectureElement::TASK:
                        $this->renderPartial('/revision/_editTaskCKE', array('idElement' => $page->quiz, 'pageId' => $page->id,'revisionId'=>$page->id_revision,'quizType'=>LectureElement::TASK));
                        break;
                    case LectureElement::PLAIN_TASK:
                        $this->renderPartial('/revision/_editPlainTaskCKE', array('idElement' => $page->quiz, 'pageId' => $page->id,'revisionId'=>$page->id_revision,'quizType'=>LectureElement::PLAIN_TASK));
                        break;
                    case LectureElement::SKIP_TASK :
                        $this->renderPartial('/revision/_editSkipTaskCKE', array('idElement' => $page->quiz, 'pageId' => $page->id,'revisionId'=>$page->id_revision,'quizType'=>LectureElement::SKIP_TASK));
                        break;
                    case LectureElement::TEST:
                    case LectureElement::FINAL_TEST:
                        $this->renderPartial('/revision/_editTestCKE', array('idElement' => $page->quiz, 'pageId' => $page->id,'revisionId'=>$page->id_revision,'quizType'=>LectureElement::TEST));
                        break;
                    default:
                        break;
                }
            } else { ?>
            <div id="buttonsPanel">
                <button class="btn btn-default" ng-click="showAddTestFormCKE('12')"><?php echo Yii::t('lecture', '0697'); ?></button>
                <button class="btn btn-default" ng-click="showAddPlainTaskFormCKE('6')"><?php echo Yii::t('lecture', '0698'); ?></button>
                <button class="btn btn-default" ng-click="showAddTaskFormCKE('5')"><?php echo Yii::t('lecture', '0699'); ?></button>
                <button class="btn btn-default" ng-click="showAddSkipTaskFormCKE()"><?=Yii::t('editor', '0789');?></button>
            </div>
                <?php
            }
            ?>
            <?php if ($page->quiz == null) {
            $this->renderPartial('/revision/_addTestCKE', array('pageId' => $page->id,'revisionId'=>$page->id_revision));
            $this->renderPartial('/revision/_addTaskCKE', array('pageId' => $page->id,'revisionId'=>$page->id_revision,'quizType'=>LectureElement::TASK));
            $this->renderPartial('/revision/_addPlainTaskCKE', array('pageId' => $page->id,'revisionId'=>$page->id_revision));
            $this->renderPartial('/revision/_addSkipTaskCKE', array('pageId' => $page->id,'revisionId'=>$page->id_revision,'quizType'=>LectureElement::SKIP_TASK));
            }?>
        </div>
    </div>
</div>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>

