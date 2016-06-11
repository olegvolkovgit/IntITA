<?php
/**
 * @var $model CorporateEntity
 *
 */
$representatives = $model->representativesList();
?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php if ($scenario == "update") { ?>
                <ul class="list-inline">
                    <li>
                        <a href="<?= Yii::app()->createUrl("course/index", array('id' => $model->course_ID)); ?>"
                           class="btn btn-outline btn-primary">
                            Редагувати список представників</a>
                    </li>
                    <li>
                        <button type="button" class="btn btn-outline btn-primary"
                                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/renderAddForm'); ?>',
                                    'Додати представника')">
                            Додати представника
                        </button>
                    </li>
                </ul>
            <?php } ?>

            <div class="col-md-12">
                <div class="row">
                    <?php if (!empty($representatives)) { ?>
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="representativesTable">
                                <thead>
                                <tr>
                                    <th>Номер</th>
                                    <th>ПІБ</th>
                                    <th width="10%">Порядок</th>
                                    <th width="15%">Посада</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    <?php } else {
                        echo "Представниківв у даному курсі ще немає.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

