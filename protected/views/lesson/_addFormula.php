<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 30.07.2015
 * Time: 14:01
 */
?>
<script async src="http://latex.codecogs.com/editor3.js"></script>
<div id="divAddFormula">
    <form id="addFormula" action="<?php echo Yii::app()->createUrl('lesson/addFormula'); ?>" method="post">
        <input name="idLecture" value="<?php echo $idLecture; ?>" hidden="hidden">
        <textarea name="newFormula" id="newFormula" cols="108" rows="10"></textarea>
        <br>
        <input type="submit" value="Додати формулу">
        <br>
    </form>
    <button onclick='cancelAddFormula()'>Скасувати</button>
</div>