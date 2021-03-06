<?php
/**
 * @var $modules array
 * @var $item array
 */
?>
<div class="col-md-12" ng-controller="consultantModulesCtrl">
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="consultantModulesTable">
            <thead>
            <tr>
                <th>Модуль</th>
                <th width="20%">Призначено</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($modules as $item) { ?>
                <tr>
                    <td>
                        <a href="<?= Yii::app()->createUrl('module/index', array('idModule' => $item["id"])); ?>"
                           target="_blank">
                            <?= $item["title"]." (".$item["lang"].")";; ?>
                        </a>
                    </td>
                    <td>
                        <?= date("d.m.Y", strtotime($item["start_time"])); ?>
                    </td>
                </tr>
                <?php
            } ?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>
