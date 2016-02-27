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
                <input type="number" hidden="hidden" value="<?= $model->id; ?>" id="user">
                <input type="text" hidden="hidden" value="<?= (string)$role; ?>" id="role">
                <div class="tab-pane fade in active" id="<?= $role; ?>">
                    <div class="form-group">
                        <?php
                        if (!empty($attributes)) {
                            foreach ($attributes as $attribute) {
                                ?>
                                <input type="text" hidden="hidden" value="<?= $attribute["key"]; ?>" id="attr">
                                <br>
                                <label><?php echo $attribute["title"]; ?></label>
                                <?php
                                if ($attribute["type"] == "module-list") {
                                    foreach ($attribute["value"] as $item) {
                                        ?>
                                        <br>
                                        <a href="<?= Yii::app()->createUrl('module/index', array('idModule' => $item["id"])); ?>">
                                            <?= $item["title"]; ?>
                                        </a>   <button type="button" class="btn btn-warning btn-xs">Скасувати</button>
                                        <?php
                                    } ?>
                                    <br>
                                    <br>
<!--                                    <form role="form" name="message">-->
<!--                                        <input type="number" hidden="hidden" id="receiverId" value="0"/>-->
<!---->
<!--                                        <div class="form-group col-md-8">-->
<!--                                            <label>Модуль:</label>-->
<!--                                            <br>-->
<!--                                            <input id="typeahead" type="text" class="form-control" name="module"-->
<!--                                                   placeholder="Назва модуля" size="135" required autofocus>-->
                                            <button type="button" class="btn btn-success btn-sm">Додати модуль</button>
<!--                                        </div>-->
<!--                                    </form>-->
                                    <?php
                                } else { ?>
                                    <input type="number" class="form-control col col-md-4" name="attributeValue"
                                           id="value"
                                           value="<?= $attribute["value"] ?>">
                                    <br>
                                <?php }
                            }
                        } else { ?>
                            Атрибутів для даної ролі не задано.
                        <?php } ?>
                    </div>

                    <?php
                    if (!empty($attributes)) { ?>
                        <br>
                        <br>
                        <input type="submit" class="btn btn-primary"
                               onclick="addTeacherAttr('<?php echo Yii::app()->createUrl("/_teacher/_admin/teachers/setTeacherRoleAttribute"); ?>'); return false;"
                               value="Редагувати">
                        <input type="reset" class="btn btn-default"
                               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>', 'Викладачі'); return false;"
                               value="Скасувати">
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

