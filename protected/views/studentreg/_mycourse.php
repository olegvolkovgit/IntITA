<?php
/* @var $user RegisteredUser
 * @var $owner
 */
$lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
$title = "title_" . $lang;
$level = "level_" . $lang;
if($user->isStudent()){
    $courses = $user->getAttributesByRole(UserRoles::STUDENT)[1]["value"];
    $modules = $user->getAttributesByRole(UserRoles::STUDENT)[0]["value"];
}else{
    $courses=$modules=array();
}
?>

<p class="tabHeader"><?php echo ($owner) ? Yii::t('profile', '0108') : Yii::t('profile', '0822'); ?></p>
<div class="profileCourse">
    <table class="currentCourseTitle">
        <tr>
            <td>
                <p style="margin-left: 35px"><?php echo Yii::t('profile', '0118'); ?></p>
            </td>
            <td>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/actualcourse.png"/>
            </td>
        </tr>
    </table>
    <?php $this->renderPartial('_currentCourse', array('user'=>$user,'courses'=>$courses,'title'=>$title, 'level'=>$level)); ?>

    <table class="currentCourseTitle">
        <tr>
            <td>
                <p style="margin-left: 35px"><?php echo Yii::t('course', '0330'); ?>:</p>
            </td>
            <td>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/actualcourse.png"/>
            </td>
        </tr>
    </table>
    <?php $this->renderPartial('_currentModules', array('user'=>$user,'modules'=>$modules,'title'=>$title, 'level'=>$level)); ?>
</div>