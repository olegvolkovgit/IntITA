<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 05.08.2017
 * Time: 17:50
 */
$date_arr = $params[0][0];
$teacher_name = $params[0][1];
$date_length = count($date_arr);
?>
<h4>Увага!</h4>
<h3>Замовлену тобою консультацію було скасовано!</h3>

    <?php for($i=0; $i<$date_length; $i++){
        echo $date_arr[$i] . "\n\t";
    } ?>

    Викладач: <?= $teacher_name; ?>