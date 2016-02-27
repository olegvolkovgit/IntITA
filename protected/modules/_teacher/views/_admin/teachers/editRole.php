<?php
/**
 * @var $model StudentReg
 * @var $roles array
 * @var $role UserRoles
 * @var $attributes array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li><a href="#<?= $role; ?>" data-toggle="tab"><?= $role; ?></a>
            </li>
        </ul>
        <div class="tab-content col col-md-6">
            <form name="add-access">
                <input type="number" hidden="hidden" value="<?=$model->id;?>" id="user">
                <input type="text" hidden="hidden" value="<?=(string)$role;?>" id="role">
                <div class="tab-pane fade in active" id="<?= $role; ?>">
                    <br>
                    <div class="form-group">
                        <?php
                        if (!empty($attributes)) {
                            foreach ($attributes as $attribute) {
                                ?>
                                <input type="text" hidden="hidden" value="<?=$attribute["key"];?>" id="attr">
                                <br>
                                <label><?php echo $attribute["title"]; ?></label>
                                <?php

                                if ($attribute["type"] == "list") {
                                    ?>

                                <?php } else { ?>
                                    <input type="number" class="form-control col col-md-4" name="attributeValue" id="value"
                                           value="<?= $attribute["value"] ?>">
                                    <br>
                                <?php }
                            }
                        } else { ?>
                            Атрибутів ролі для даного викладача не задано.
                        <?php } ?>
                    </div>

                <?php
                if (!empty($attributes)) { ?>
                    <br>
                    <br>
                    <input type="submit" class="btn btn-primary"
                           onclick="addTeacherAttr('<?php echo Yii::app()->createUrl("/_teacher/_admin/teachers/setTeacherRoleAttribute"); ?>'); return false;"
                           value="Редагувати">
                <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

