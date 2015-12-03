<h2>Задачі до перевірки</h2>
<?php
if (!empty($answers)) {
    for ($i = 0, $count = count($answers); $i < $count; $i++) {
        echo "<br>".($i+1).". ".PlainTaskAnswer::model()->findByPk($answers[$i]['id_plain_task_answer'])->answer." - ".
        Teacher::getFullName($answers[$i]['id_teacher']);
    }
}
?>