<?php
/**
 * @var $attribute array
 * @var $item array
 */
?>
<div class="col-md-12">
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="modulesListTable">
            <thead>
            <tr>
                <th>Студент</th>
                <th width="20%">Призначено</th>
                <th width="20%">Відмінено</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($attribute["value"] as $item) { ?>
            <tr>
                <td>
                    <a href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $item["id"])); ?>" target="_blank">
                        <?= $item["title"]; ?>
                    </a>
                </td>
                <td>
                    <?= date("d.m.Y",strtotime($item["start_date"])); ?>
                </td>
                <td>
                    <?= ($item["end_date"] != "")?date("d.m.Y",strtotime($item["end_date"])):""; ?>
                </td>
                <?php
                } ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>
