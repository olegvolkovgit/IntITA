<?php
/**
 * @var $params array
 * @var $student StudentReg
 */
$student = $params[0];
$organization = Organization::model()->findByPk($params[1]);
?>
<h4>Повідомлення</h4>
<span>Вам призначено нового студента/ як тренеру, для супроводу
    <a ng-href="#/users/profile/<?php echo $student->id ?>" target="_blank">
        <strong><?= $student->userNameWithEmail();?></strong>
        </a>
    .</span>
<?php if($organization){ echo 'В межах організації <em>"'.$organization->name.'"</em>'; } ?></span>
<br>
