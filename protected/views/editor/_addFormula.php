<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 30.07.2015
 * Time: 14:01
 */
?>
<div id="divAddFormula">
    <form id="addFormula" action="<?php echo Yii::app()->createUrl('lesson/addFormula'); ?>" method="post">
        <input name="idLecture" value="<?php echo $idLecture; ?>" type="hidden">
        <input name="page" value="<?php echo $pageOrder; ?>" type="hidden">
        <input name="type" value="10" type="hidden">
        <div id="toolbar">toolbar</div>
        <textarea name="newFormula" id="newFormula" cols="108" rows="10" required onclick='buttonFormulaEnabled()'></textarea>
        <img id="equation" align="middle" />img
        <br>
        <input id="addFormulaButton" type="submit" value="Додати формулу" onclick='fieldValidation()' >
        <br>
    </form>
    <button onclick='cancelAddFormula()'>Скасувати</button>
</div>


