<?php
/**
 * @var $lecture Lecture
 * @var $page LecturePage
 */
$lecture = Lecture::model()->findByPk($idLecture);
$pagesList = $lecture->pagesList();
$module = $idModule;
if ($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        Course::getCourseName($idCourse) => Yii::app()->createUrl('course/index', array('id' => $idCourse)),
        $lecture->module->getTitle() => Yii::app()->createUrl('module/index', array('idModule' => $module, 'idCourse' => $idCourse)),
        $lecture->title() =>
            Yii::app()->createUrl('lesson/index', array('id' => $idLecture, 'idCourse' => $idCourse)),
    );
} else {
    $this->breadcrumbs = array(
        $lecture->module->getTitle() => Yii::app()->createUrl('module/index', array('idModule' => $module)),
        $lecture->title() =>
            Yii::app()->createUrl('lesson/index', array('id' => $idLecture, 'idCourse' => $idCourse)),
    );
}
?>
<script type="text/javascript">
    basePath = '<?php echo  Config::getBaseUrl(); ?>';
</script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'LecturePageEditor.js'); ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'editPage.css'); ?>"/>


<div name="lecturePage" class="pagesList">
    <div class="lessonTheme"><?php echo $lecture->title(); ?></div>
    <h3 class="lessonPartEdit">
        <?php
        foreach ($pagesList as $page) {
            ?>
            <div class="labelBlock">
                <p>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco"
                         onclick="upPage(<?php echo $idLecture;?>, <?php echo $page->page_order;?>);">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>"
                         class="editIco"
                         onclick="downPage(<?php echo $idLecture;?>, <?php echo $page->page_order;?>);">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>"
                         class="editIco"
                         onclick="deletePage(<?php echo $idLecture;?>, <?php echo $page->page_order;?>, <?php echo $idCourse;?>);">
                    <a href="<?php echo Yii::app()->createURL('lesson/editPage', array('pageId' => $page->id, 'idCourse' => $idCourse, 'cke' => 0));?>">
                        <?php echo Yii::t('lecture', '0615') . ' ' . $page->page_order . '. ' . $page->page_title;
                        ?>
                    </a></p></div>
        <?php } ?>
    </h3>
    <br>

    <h3 class="lessonPartEdit"><p>
            <a href="<?php echo Yii::app()->createUrl('lesson/addNewPage', array('lecture' => $idLecture, 'page' => $i)); ?>"> <?php echo Yii::t('lecture', '0711'); ?></a>
        </p></h3>
</div>