<?php
/**
 * @var $model Teacher
 * @var $roles array
 * @var $role UserRoles
 * @var $attributes array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <?php
            foreach ($roles as $role) {
                ?>
                <li><a href="#<?= $role; ?>" data-toggle="tab"><?= $role; ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
        <div class="tab-content">
            <?php
            foreach ($roles as $role) {
            ?>
            <form name="add-access">
                <div class="tab-pane fade in active" id="<?= $role; ?>">
                    Атрибути:<br>
                    <div class="form-group">
                        <?php if (!empty($attributes)) {
                            foreach ($attributes as $attribute) { ?>
                                <label><?php echo $attribute[]["title"]; ?></label>
                                <?php
                                if ($attribute[]["type"] == "list") {
                                    ?>

                                <?php } else { ?>
                                    <input type='text' class="form-control" name='attributeValue' id='inputValue'>
                                <?php }

                            }
                        } ?>

                    </div>
                </div>
                <?php
                }
                ?>
                <input type="submit" class="btn btn-default"
                       onclick="addTeacherAttr('<?php echo Yii::app()->createUrl("/_teacher/_admin/teachers/setTeacherRoleAttribute"); ?>')"
                       value="Призначити атрибут">
            </form>
        </div>
    </div>
</div>

