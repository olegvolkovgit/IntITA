<?php
/**
 * @var $page LecturePage;
 */
?>
<?php
if(isset($_GET['page'])) $thisPage=$_GET['page'];
else $thisPage=1;
?>
<div name="lecturePage">
    <link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/cjuitabs.css" />
    <h1 class="lessonPart" >
        <div class="labelBlock" id="labelBlock">
            <p>Частина <?php echo $page->page_order.'. '.$page->page_title;?></p>
            <img id="pointer" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pointer.png') ?>">
        </div>
        <div id="tooltip"></div>
        <img id="arrowCursor" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'arrow.png') ?>">
    </h1>
    <div class="progress">
<?php
for ($i = 0, $count = count($passedPages); $i < $count;$i++) {
    if ($passedPages[$i]['isDone'] ||
        TeacherHelper::isTeacherAuthorModule($user, LectureHelper::getModuleByLecture($page->id_lecture)) ||
        LectureHelper::isLectureFree($page->id_lecture)) {
        ?>
        <a class="pageDone pageTitle" id="<?php echo LectureHelper::pressedPageIco($passedPages[$i]['order'],$thisPage)?>" href="<?php $args = $_GET;
             $args['page'] = $passedPages[$i]['order'];
            echo $this->createUrl('', $args);?>"
            title="Частина <?php echo $passedPages[$i]['order'].'. '.$passedPages[$i]['title'];?>"></a>
    <?php } else {
        ?>
        <a class="pageNoAccess pageTitle" title="Частина <?php echo $passedPages[$i]['order'].'. '.$passedPages[$i]['title'];?>"></a>
    <?php }
}?>
    <img style="margin-left: 10px" src="<?php if(LectureHelper::isPassedLecture($user,$page->id_lecture)) echo StaticFilesHelper::createPath('image', 'common', 'medal1.png');
    else echo StaticFilesHelper::createPath('image', 'common', 'medal0.png');?>">
    </div>
<div class="tabsWidget">
<?php
//if($page->video == null){
//    $this->widget('zii.widgets.jui.CJuiTabs', array(
//        'tabs' => array(
//            'Текст' => array('id' => 'text', 'content' => $this->renderPartial(
//                '_textListTab',
//                array('dataProvider' => $dataProvider, 'countBlocks' => $countBlocks, 'editMode' => 0, 'user' => $user), true
//            )),
//        ),
//        // additional javascript options for the tabs plugin
//        'options' => array(
//            'collapsible' => true,
//        ),
//        'id' => 'MyTab-Menu',
//    ));
//}else {
    $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
            'Відео' => array('id' => 'video', 'content' => $this->renderPartial(
                '_videoTab',
                array('page' => $page), true
            )),
            'Текст' => array('id' => 'text', 'content' => $this->renderPartial(
                '_textListTab',
                array('dataProvider' => $dataProvider, 'editMode' => 0, 'user' => $user), true
            )),
        ),
        // additional javascript options for the tabs plugin
        'options' => array(
            'collapsible' => true,
        ),
        'id' => 'MyTab-Menu',
    ));
//}
?>
</div>

<?php
if (!is_null($page->quiz)) {
    switch (lectureHelper::getQuizType($page->quiz)) {
        case '5':
            $this->renderPartial('_taskBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
            break;
        case '6':
            $this->renderPartial('_taskBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
            break;
        case '12':
            $this->renderPartial('_testBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
            break;
        case '13':
            $this->renderPartial('_testBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
            break;
        default:
            break;
    }
}
?>
</div>
<br>
<br>
<script async src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/lectureProgress.js"></script>
