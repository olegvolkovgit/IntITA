<?php
/**
 * @var $page LecturePage;
 */
?>
<?php
if (is_string($_GET['page'])) $thisPage = $_GET['page'];
else if($editMode) $thisPage = 1;
else $thisPage = $lastAccessPage;

if (!($passedPages[$thisPage-1]['isDone'] || $editMode)
){
    throw new CHttpException(403, 'В доступі відмовлено. Ви не пройшли попередні кроки');
}
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'cjuitabs.css'); ?>"/>
<div name="lecturePage">
    <?php $this->renderPartial('_lectureProgress', array('page'=>$page, 'finishedLecture' => $finishedLecture, 'passedLecture'=>$passedLecture, 'passedPages'=>$passedPages,'user'=>$user, 'thisPage'=>$thisPage, 'edit'=>0,  'editMode' => $editMode)); ?>
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
                Yii::t('lecture', '0613') => array('id' => 'video', 'content' => $this->renderPartial(
                    '_videoTab',
                    array('page' => $page), true
                )),
                Yii::t('lecture', '0614') => array('id' => 'text', 'content' => $this->renderPartial(
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
