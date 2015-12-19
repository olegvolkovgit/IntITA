<? $css_version = 1; ?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'courses.css'); ?>" />
<?php
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0050'),
);

$user = StudentReg::model()->findByPk(39);
$message = $user->generateMessage(array('topic' => 'new topic', 'body' => 'new subject', 'receivers' => array('2', '40')));
$user = StudentReg::model()->findByPk(51);
if ($message->send($user)){
    $message->deleteMessage($user);
    echo 'Success mail!';
} else {
    echo 'Error!';
}
var_dump($user->receivedMessages());
die;

$courseList = $dataProvider->getData();
?>

<div id='coursesMainBox'>
    <?php $this->renderPartial('_menuLine', array('total'=>$total));?>
    <table>
        <tr>
            <td>
            <?php $this->renderPartial('_coursesPart1', array('courseList' => $courseList, 'coursesLangs' => $coursesLangs));?>
            <?php $this->renderPartial('_coursesPart2', array('courseList' => $courseList, 'coursesLangs' => $coursesLangs));?>
            </td>
        </tr>
    </table>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerBlock.js'); ?>"></script>
<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('courses', '0066').'. '.Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>


