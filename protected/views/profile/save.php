<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 25.04.2015
 * Time: 2:01
 */
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/teacherProfile.css" />
<div class="TeacherProfilename">
    <?php
if (isset($_POST['id'])) {
    if ( !empty($_POST['firstText'])){
        Teacher::updateFirstText($_POST['id'], $_POST['firstText']);
    }
    if ( !empty($_POST['secondText'])){
        Teacher::updateSecondText($_POST['id'], $_POST['secondText']);
    }

    echo '<br><br>Your profile is successfully updated!<br>
    Return to <a href="'.Yii::app()->createUrl('profile/index', array('idTeacher' => $_POST['id'])).'">your</a> profile.';

    }
    else {
        echo 'Sorry, you can\'t update your profile ((';
    }
?>
</div>
