<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 04.08.2017
 * Time: 13:59
 * @var $params array
 * @var $date string
 */

$date_arr = $params[0][0];
$teacher_name = $params[0][1];
$date_length = count($date_arr);
?>
<h4>Вітаємо!</h4>
<span>Замовлена тобою консультація підтверджена!</span>

    <?php for($i=0; $i<$date_length; $i++){
        echo $date_arr[$i] . "\n\t";
    } ?>

    Викладач: <?= $teacher_name; ?>