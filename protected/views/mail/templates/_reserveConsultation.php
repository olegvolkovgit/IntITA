<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 04.08.2017
 * Time: 13:55
 * @var $params array
 * @var $role string
*/

$dates = $params[0][0];
$student = $params[0][1];
?>
<h4>Замовлено консультацію!</h4>
<h3>Студент: <?=$student ?></h3>

    <?php for($i=0; $i<count($dates); $i++){
        echo $dates[$i] . "\n\t";
    } ?>


<span>Переглянути детальну інформацію можна у кабінеті:</span>
<a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>">Кабінет</a>