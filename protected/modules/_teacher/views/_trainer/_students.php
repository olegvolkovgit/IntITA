<?php
/**
 * @var $attribute array
 * @var $item array
 */
?>
<div class="col-md-12" ng-controller="trainerStudentsCtrl">
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="trainerStudentsTable">
            <thead>
            <tr>
                <th>Студент</th>
                <th width="20%">Призначено</th>
                <th>Переглянути</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($attribute["value"] as $item) {
                if (!$item["end_date"]) {
                    ?>
                    <tr>
                        <td>
                            <a href="#" name="<?= trim($item["title"]." (".$item["email"].")"); ?>"
                               onclick='load("<?= Yii::app()->createUrl("/_teacher/_trainer/trainer/viewStudent", array("id" => $item["id"])); ?>",
                                   "<?= CHtml::encode($item['title']); ?>");'>
                                <?= $item["title"]." (".$item["email"].")"; ?>
                            </a>
                        </td>
                        <td>
                            <?= date("d.m.Y", strtotime($item["start_date"])); ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline btn-success btn-sm"
                                    onclick="load('<?=Yii::app()->createUrl("/_teacher/user/index", array("id" => $item["id"]));?>')">
                                Переглянути
                            </button>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>
