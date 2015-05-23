<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 23.05.2015
 * Time: 13:32
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/access.css" />

<form id="add">
    <label for="idUser">Користувач</label>
    <select form="add" name="idUser">
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="mercedes">Mercedes</option>
        <option value="audi">Audi</option>
    </select>

    <label for="idResource">Лекція</label>
    <select form="add" name="idResource">
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="mercedes">Mercedes</option>
        <option value="audi">Audi</option>
    </select>

    <label for="read">READ</label>
    <input type="checkbox" name="read"><br>

    <label for="edit">EDIT</label>
    <input type="checkbox" name="edit"><br>

    <label for="create">CREATE</label>
    <input type="checkbox" name="create"><br>

    <label for="delete">DELETE</label>
    <input type="checkbox" name="delete"><br>

    <input type="submit">
</form>