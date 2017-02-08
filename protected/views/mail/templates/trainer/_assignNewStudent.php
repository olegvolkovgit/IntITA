<?php
/**
 * @var $params array
 * @var $student StudentReg
 */
$student = $params[0];
?>
<h4>Повідомлення</h4>
<span>Вам призначено нового студента для супроводу
    <a ng-href="#/users/profile/<?php echo $student->id ?>" target="_blank">
        <strong><?= $student->userNameWithEmail();?></strong>
        </a>
    .</span>
<br>
