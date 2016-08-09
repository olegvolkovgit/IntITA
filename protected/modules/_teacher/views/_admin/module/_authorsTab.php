<?php
/**
 * @var $model Module
 * @var $teachers array
 * @var $item array
 * @var $scenario string
 */
?>
<div class="panel panel-default" ng-controller="modulemanageCtrl">
    <div class="panel-body">
        <?php if ($scenario == "update") { ?>
            <ul class="list-inline">
                <li>
                    <button type="button" class="btn btn-outline btn-primary" ng-click="changeView('module/addAuchtor/<?= $model->module_ID ?>')">
                        Призначити автора
                    </button>
                </li>
            </ul>
        <?php } ?>

        <div class="col-md-12">
            <div class="row">
                <?php if (!empty($teachers)) { ?>
                    <input type="text" hidden="hidden" value="author" id="role">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="modulesListTable">
                            <thead>
                            <tr>
                                <th>Автор</th>
                                <th width="20%">Призначений</th>
                                <th width="20%">Відмінено</th>
                                <?php if ($scenario == 'update') { ?>
                                    <th width="10%">Відмінити</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($teachers as $item) { ?>
                            <tr>
                                <td>
                                    <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/showTeacher",
                                        array("id" => $item["id"])); ?>',  '<?="Викладач ".($item["secondName"]." ".$item["firstName"]." ".$item["middleName"]=='  ')?$item["email"]:$item["secondName"]." ".$item["firstName"]." ".$item["middleName"];?>');">
                                        <?= ($item["secondName"]." ".$item["firstName"]." ".$item["middleName"]=='  ')?$item["email"]:$item["secondName"]." ".$item["firstName"]." ".$item["middleName"]; ?>
                                    </a>
                                </td>
                                <td>
                                    <?= date("d.m.Y", strtotime($item["start_time"])); ?>
                                </td>
                                <td>
                                    <?= ($item["end_time"] == '')?"":date("d.m.Y", strtotime($item["end_time"])); ?>
                                </td>
                                <?php if ($scenario == 'update') { ?>
                                    <td>
                                        <?php
                                        if ($item["end_time"] == '') { ?>
                                            <input type="number" hidden="hidden" value="<?= $item["id"]; ?>" id="user">
                                            <a href="#"
                                               onclick="cancelModuleAttr('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/unsetTeacherRoleAttribute"); ?>',
                                                   '<?= $model->module_ID; ?>', 'module', 'author', '<?=$item["id"]?>',
                                                   '<?=Yii::app()->createUrl("/_teacher/_admin/module/update", array("id" => $model->module_ID));?>','5','Модуль <?php echo $model->getTitle() ?>');">
                                                скасувати
                                            </a>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                                <?php
                                } ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    echo "Авторів для даного модуля ще не призначено.";
                }
                ?>
            </div>
        </div>
    </div>
</div>

