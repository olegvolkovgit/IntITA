<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 12.08.2015
 * Time: 11:36
 */
?>
<div class="editTask">
    <br>
    <form name="add-task">
        <fieldset>
            <legend id="label">Редагувати:</legend>
            Мова програмування:<br>
            <select id="programLang" name="lang" placeholder="(Виберіть мову програмування)" form="add-task">
                <option value="c++">С++</option>
                <option value="java">Java</option>
                <option value="js">JavaScript</option>
            </select>
            <br>
            <br>
            Назва:
            <input type="text" name="name" id="name" placeholder="назва задачі"/>
            <br>
            <br>
            Умова задачі*:<textarea name="condition" id="condition" cols="105" form="add-task" rows="10"><?php echo TestsHelper::getTaskCondition($idBlock);?></textarea>
            <br>
            <br>
            Header*:<textarea name="header" id="header" cols="105" form="add-task" rows="5"></textarea>
            <br>
            Etalon*:<textarea name="etalon" id="etalon" cols="105" placeholder="Еталонна відповідь" form="add-task" rows="15"></textarea>
            <br>
            Footer*:<textarea name="taskFooter" id="taskFooter" cols="105" form="add-task" rows="5"></textarea>
            <br>
            <input type="text" name="idTaskBlock" hidden="hidden" value="<?php echo $idBlock;?>"/>
        </fieldset>
    </form>
    <button onclick='editTask()'>Додати задачу</button>
    <button onclick='cancelTask()'>Скасувати</button>
    <button onclick='unableTask(<?php echo $pageId;?>)'>Видалити задачу</button>
</div>



