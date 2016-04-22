<? $css_version = 1; ?>
<?php
/* @var $this LessonController */
/* @var $page LecturePage */
/* @var $lecture Lecture */
/* @var $lectureElement LectureElement */
$module = $lecture->idModule;
$lecture = Lecture::model()->findByPk($page->id_lecture);
if ($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        Course::getCourseTitleForBreadcrumbs($idCourse) => Yii::app()->createUrl('course/index', array('id' => $idCourse)),
        $lecture->ModuleTitle->getTitle() => Yii::app()->createUrl('module/index', array('idModule' => $module, 'idCourse' => $idCourse)),
        $lecture->title() =>
            Yii::app()->createUrl('lesson/index', array('id' => $page->id_lecture, 'idCourse' => $idCourse)),
    );
} else {
    $this->breadcrumbs = array(
        $lecture->ModuleTitle->getTitle() => Yii::app()->createUrl('module/index', array('idModule' => $module)),
        $lecture->title() =>
            Yii::app()->createUrl('lesson/index', array('id' => $page->id_lecture, 'idCourse' => $idCourse)),
    );
}
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js"></script>
<script src='http://yastatic.net/highlightjs/8.2/highlight.min.js'></script>
<script src="http://pc035860.github.io/angular-highlightjs/angular-highlightjs.min.js"></script>

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
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/config.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/controllers.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/directives/lectureBlocks.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/directives/styleDirectives.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/services/sendTaskJsonService.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/services/getTaskJson.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>


<script type="text/javascript">
    lang = '<?php if(CommonHelper::getLanguage()=='ua') echo 'uk'; else echo CommonHelper::getLanguage();?>';
    idLecture = '<?php echo $page->id_lecture;?>';
    idModule = <?php echo $lecture->idModule;?>;
</script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonsStyle.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'editPage.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/><!-- highlight include -->
<link rel="stylesheet" type="text/css" href="http://latex.codecogs.com/css/equation-embed.css"/>

<!--[if lte IE 7]>
<link rel="stylesheet" href="http://latex.codecogs.com/css/ie6.css" type="text/css"/>
<![endif]-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">

<script type="text/javascript" src="http://latex.codecogs.com/js/eq_config.js"></script>
<script type="text/javascript" src="http://latex.codecogs.com/js/eq_editor-lite-18.js"></script>
<script>
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idTeacher = '<?php echo $user;?>';
    idLecture = '<?php echo $page->id_lecture;?>';
</script>
<?php $this->renderPartial('/site/_hamburgermenu'); ?>
<div ng-app="lessonEdit" class="lessonEdit">
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
        <div id="lecturePage">
            <br>
            <h1 class="lessonPart lessonEditPart">
                <?php echo Yii::t('lecture', '0073') . " " . $lecture->order . ': ';
                $title = Lecture::getTypeTitleParam();
                $this->widget('editable.EditableField', array(
                    'type' => 'text',
                    'model' => $lecture,
                    'attribute' => $title,
                    'emptytext' => Yii::t('config', '0575'),
                    'url' => $this->createUrl('lesson/updateLectureAttribute'),
                    'title' => Yii::t('lecture', '0567'),
                    'placement' => 'right',
                )); ?>
            </h1>
            <div class="lectureVerify" >
                <?php if($lecture->verified==0) { ?>
                    <a href="<?php echo Yii::app()->createUrl('/lesson/confirm', array('id' => $page->id_lecture));?>">
                        <img style="margin-left: 5px"
                             src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'checked.png'); ?>"
                             title="Підтвердити готовність лекції(шаблонізація)" />
                    </a>
                <?php } else { ?>
                    <a href="<?php echo Yii::app()->createUrl('/lesson/cancel', array('id' => $page->id_lecture));?>">
                        <img style="margin-left: 5px"
                             src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'notChecked.png'); ?>"
                             title="Встановити лекцію в розробці" />
                    </a>
                <?php } ?>
            </div>
            <div class="lessonPart">
                <h4 class="labelBlock" style="display: inline-block">
                    <?php echo Yii::t('lecture', '0615') . ' ' . $page->page_order . '. ';
                        $this->widget('editable.EditableField', array(
                            'type' => 'textarea',
                            'model' => $page,
                            'attribute' => 'page_title',
                            'emptytext' => Yii::t('config', '0575'),
                            'url' => $this->createUrl('lesson/updateLecturePageAttribute'),
                            'placement' => 'right',
                        ));
                    ?>
                </h4>
                <div style="width: auto">
                    <a href="<?php echo Yii::app()->createURL('lesson/editPage', array('pageId' => $page->id, 'idCourse' => $idCourse)); ?>">
                        <img style="margin-left: 5px"
                             src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'imperavi.png'); ?>"
                             id="editIco1" class="editButton" title="<?php echo Yii::t('lecture', '0686') . ' Imperavi' ?>"/>
                    </a>
                    <a href="<?php echo Yii::app()->createUrl('lesson/showPagesList', array('idLecture' => $page->id_lecture,
                        'idCourse' => $idCourse)); ?>">
                        <img style="margin-left: 5px"
                             src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'list.jpg'); ?>"
                             class="editButton" title="<?php echo Yii::t('lecture', '0688'); ?>"/>
                    </a>
                    <a href="{{locationToPreview}}">
                        <img style="margin-left: 5px"
                             src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'view.png'); ?>"
                             id="editIco1" class="editButton" title="<?php echo Yii::t('lecture', '0687'); ?>"/>
                    </a>
                </div>
            </div>
            <h3><label for="pageVideo"><?php echo Yii::t('lecture', '0613'); ?></label></h3>
            <?php
            if ($page->video == null) { ?>
                <?php $this->renderPartial('/editor/_addVideo', array('idLecture' => $page->id_lecture, 'pageOrder' =>
                    $page->page_order)); ?>
                <button onclick="addVideoInput()" id="addVideoStart"><?php echo Yii::t('lecture', '0689'); ?></button>
                <?php
            } else {
                $lectureElement = LectureElement::model()->findByPk($page->video);
                $lectureElement->setScenario('videoLink');
                $this->widget('editable.EditableField', array(
                    'type' => 'textarea',
                    'model' => $lectureElement,
                    'attribute' => 'html_block',
                    'emptytext' => Yii::t('config', '0575'),
                    'url' => $this->createUrl('lesson/updateLectureElementAttribute'),
                    'placement' => 'right',
                ));
                ?>
                <div class="videoDeleteButton">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png'); ?>"
                         class="editIco"
                         onclick="deleteVideo(<?php echo $page->id_lecture; ?>, <?php echo $page->page_order; ?>);">
                </div>
            <?php } ?>
            <br>
            <br>
            <fieldset>
                <legend><?php echo Yii::t('lecture', '0690'); ?></legend>
                <div id="blockList">
                    <?php $this->renderPartial('/editor/_blocks_list_CKE', array('dataProvider' => $dataProvider,
                        'countBlocks' => count($dataProvider), 'editMode' => 1, 'user' => $user)); ?>
                </div>
                <div id="addBlock">
                    <div ng-class="{lessonInstr: instructionStyle,  lessonBG: instructionStyle}">
                        <div ng-show="instructionStyle" class="instrTaskImg" >
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'instr.png'); ?>">
                        </div>
                        <div ng-class="{content: instructionStyle}" >
                            <?php
                            $this->renderPartial('/editor/_addBlockCKE', array('lecture' => $lecture, 'editMode' => 1,
                                'teacher' => $user, 'pageOrder' => $page->page_order));
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div style="display: block; clear: both">
                    <?php echo Yii::t('lecture', '0691'); ?>
                    <br>
                    <button selected-button ng-click="addTextBlock('1')"><?php echo Yii::t('lecture', '0692'); ?></button>
                    <button selected-button ng-click="addTextBlock('3')"><?php echo Yii::t('lecture', '0693'); ?></button>
                    <button selected-button ng-click="addTextBlock('4')"><?php echo Yii::t('lecture', '0694'); ?></button>
                    <button selected-button ng-click="addTextBlock('7')"><?php echo Yii::t('lecture', '0695'); ?></button>
                </div>
            </fieldset>
            <h3><label for="pageQuiz"><?php echo Yii::t('lecture', '0696'); ?></label></h3>
            <?php
            if ($page->quiz != null) {
                $data = LecturePage::getPageQuiz($page->id);

                switch (LectureElement::getQuizType($data['id_block'])) {
                    case '5':
                        $this->renderPartial('/editor/_editTaskCKE', array('idBlock' => $data['id_block'],
                            'pageId' => $page->id, 'lecture' => $lecture->id));
                        break;
                    case '6':
                        $this->renderPartial('/editor/_editPlainTaskCKE', array('data' => $data,
                            'pageId' => $page->id));
                        break;
                    case '9' :
                        $this->renderPartial('/editor/_editSkipTaskCKE', array('data' => $data,
                            'pageId' => $page->id));
                        break;
                    case '12':
                    case '13':
                        $this->renderPartial('/editor/_editTestCKE', array('idBlock' => $data['id_block'],
                            'pageId' => $page->id));
                        break;
                    default:
                        break;
                }
            } else {
                ?>
            <div id="buttonsPanel">
                <button onclick="showAddTestFormCKE('plain')"><?php echo Yii::t('lecture', '0697'); ?></button>
                <button onclick="showAddPlainTaskFormCKE('plainTask')"><?php echo Yii::t('lecture', '0698'); ?></button>
                <button onclick="showAddTaskFormCKE('plain')"><?php echo Yii::t('lecture', '0699'); ?></button>
                <button onclick="showAddSkipTaskFormCKE()"><?=Yii::t('editor', '0789');?></button>
            </div>
                <?php
            }
            ?>
            <?php if ($page->quiz == null) {
            $this->renderPartial('/editor/_addTestCKE', array('lecture' => $lecture->id, 'author' => $user, 'pageId' => $page->id));
            $this->renderPartial('/editor/_addTaskCKE', array('pageId' => $page->id,'lecture' => $lecture->id));
            $this->renderPartial('/editor/_addPlainTaskCKE', array('lecture' => $lecture->id, 'author' => $user, 'pageId' => $page->id));
            $this->renderPartial('/editor/_addSkipTaskCKE', array('pageId' => $page->id, 'lecture' => $lecture->id, 'author' => $user));
            }?>
        </div>
    </div>
</div>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'lessonEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'LecturePageEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tasks.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tests.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'skipTask.js'); ?>"></script>

