<?php
/**
 * @var $page LecturePage;
 */
?>
<?php
if (isset($_GET['page'])) $thisPage = $_GET['page'];
else $thisPage = 1;
if (!($passedPages[$thisPage-1]['isDone'] ||
    TeacherHelper::isTeacherAuthorModule($user, LectureHelper::getModuleByLecture($page->id_lecture)) ||
    LectureHelper::isLectureFree($page->id_lecture))
){
    throw new CHttpException(403, 'В доступі відмовлено. Ви не пройшли попередні кроки');
}
?>
<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/cjuitabs.css"/>
<div name="lecturePage">
    <?php $this->renderPartial('_lectureProgress', array('page'=>$page,'passedLecture'=>$passedLecture, 'passedPages'=>$passedPages,'user'=>$user, 'thisPage'=>$thisPage, 'edit'=>0)); ?>
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
