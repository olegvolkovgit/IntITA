<?php
/**
 * @var $model Course
 * @var $modules array
 * @var $item CourseModules
 * @var $scenario string
 */ ?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if ($scenario == "update") { ?>
            <ul class="list-inline">
                <li>
                    <a href="<?= Yii::app()->createUrl("course/index", array('id' => $model->course_ID)); ?>"
                       class="btn btn-outline btn-primary">
                        Редагувати список модулів</a>
                </li>
            </ul>
        <?php } ?>

        <div class="col-md-12">
            <div class="row">
                <?php if (!empty($modules)) { ?>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="modulesListTable">
                            <thead>
                            <tr>
                                <th>Модуль</th>
                                <th width="10%">Порядок</th>
                                <th width="15%">Ціна у курсі</th>
                                <th width="20%">Попередній модуль</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($modules as $item) { ?>
                            <tr>
                                <td>
                                    <a ng-href="#/module/id/<?= $item["id_module"] ?>" target="_blank">
                                        <?= $item->moduleInCourse->getTitle(); ?>
                                    </a>
                                    <a href="<?= Yii::app()->createUrl('module/index', array('idModule' => $item["id_module"])); ?>"
                                       target="_blank">
                                        (переглянути контент)
                                    </a>
                                </td>
                                <td>
                                    <?= $item["order"]; ?>
                                </td>
                                <td>
                                    <?php
                                        $priceInCourse=$item->moduleInCourse->module_price*Config::getCoeffDependentModule();
                                        echo ($priceInCourse == 0) ? "безкоштовно" : $priceInCourse;
                                    ?>
                                </td>
                                <td>
                                    <?php if ($scenario == "update") { ?>
                                        <a href="#/module/mandatory/id/<?= $item->moduleInCourse->module_ID ?>/course/<?= $item->id_course ?>">
                                            <?= ($item->mandatory_modules != null) ? $item->mandatory->getTitle() . " (ред.)" : "редагувати"; ?>
                                        </a>
                                    <?php } else {
                                        echo ($item->mandatory_modules != null) ? $item->mandatory->getTitle() : "";
                                    } ?>
                                </td>
                                <?php
                                } ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                <?php } else {
                    echo "Модулів у даному курсі ще немає.";
                }
                ?>
            </div>
        </div>
    </div>
</div>

