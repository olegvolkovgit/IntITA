<?php
/**
 * @var $model Module
 * @var $lectures array
 * @var $scenario string
 * @var $item Lecture
 */
$lectures = $model->lectures;
?>
<div class="panel panel-default">
    <div class="panel-body">

<!--        --><?php  //todo
        //if ($scenario == "update"){?>
<!--            <ul class="list-inline">-->
<!--                <li>-->
<!--                    <button type="submit" class="btn btn-outline btn-primary">-->
<!--                        Редагувати список модулів</button>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <button type="button" class="btn btn-outline btn-primary">-->
<!--                        Додати існуючий модуль до курса</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--        --><?php //}?>

        <div class="col-md-12">
            <div class="row">
                <?php if (!empty($lectures)){ ?>
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="modulesListTable">
                        <thead>
                        <tr>
                            <th>Лекція</th>
                            <th width="10%">Порядок</th>
                            <th width="15%">Безкоштовна</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($lectures as $item) { ?>
                        <tr>
                            <td>
                                <a href="<?= Yii::app()->createUrl('lesson/index', array('id' => $item["id"],
                                    'idCourse' => '0')); ?>"
                                   target="_blank">
                                    <?= $item->title(); ?>
                                </a>
                            </td>
                            <td>
                                <?= $item->order; ?>
                            </td>
                            <td>
                                <?= $item->freeLabel(); ?>
                            </td>
                            <?php
                            } ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} else {
    echo "Лекцій у даному модулі ще немає.";
}
?>
