<?php
/**
 * @var $modules array
 * @var $module array
 */
if(!empty($modules["value"])){?>
    <label>Модулі:</label>
    <br>
    <select class="form-control" name="modules">
        <?php foreach($modules["value"] as $module){
            if(!$module["end_date"]) {
                ?>
                <option value="<?= $module["id"] ?>"><?= $module["title"] . ", " . $module["lang"]; ?></option>
                <?php
            }
        }?>
    </select>
<?php
} else {
    echo "Даний викладач не має прав на редагування жодного модуля.";
}