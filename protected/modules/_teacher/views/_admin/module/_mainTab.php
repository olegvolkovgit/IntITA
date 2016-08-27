<?php
/**
 * @var $model Module
 */
?>
<div class="row">
    <div class="col-md-2">
        <a href="<?=Yii::app()->createUrl("module/index", array("idModule" => $model->module_ID));?>" target="_blank">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'module', $model->module_img); ?>"
             class="img-thumbnail">
        </a>
    </div>
    <div class="col-md-10">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td width="35%">Мова: </td>
                <td><?=$model->language;?></td>
            </tr>
            <tr>
                <td>Псевдонім: </td>
                <td><?=CHtml::encode($model->alias);?></td>
            </tr>
            <tr>
                <td><div data-toggle="tooltip" data-placement="top" title="Ціна використовується при розрахунку ціни курса
                (якщо не вказана ціна модуля в конкретному курсі - вкладка <У курсах>)
                і при розрахунку вартості самостійного модуля.">
                        Ціна модуля базова, USD:
                    </div>
                </td>
                <td><?=($model->module_price == 0)?"безкоштовно":$model->module_price;?></td>
            </tr>
            <tr>
                <td><div data-toggle="tooltip" data-placement="top" title="Ціна модуля в курсі однакова в будь-якому курсі.
                Визначається за допомогою коефіцієнта ціни модуля в курсі.">
                        Ціна модуля в курсі:
                    </div>
                </td>
                <td>
                    <?php
                    $priceInCourse=$model->module_price*Config::getCoeffDependentModule();
                    echo ($priceInCourse == 0) ? "безкоштовно" : $priceInCourse;
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div data-toggle="tooltip" data-placement="top" title="Унікальний ідентифікатор, використовується
                    при генерації номера договора про оплату модуля.">
                    Номер модуля:
                    </div>
                </td>
                <td><?=$model->module_number;?></td>
            </tr>
            <tr>
                <td>Рівень: </td>
                <td><?=$model->level();?></td>
            </tr>
            <tr>
                <td>Статус: </td>
                <td><?=$model->statusLabel();?></td>
            </tr>
            <tr>
                <td>Видалений: </td>
                <td><?=$model->cancelledLabel();?></td>
            </tr>
            <tr>
                <td>Категорії:</td>
                <td>
                    <div class="tags">
                        <ul>
                            <?php foreach($model->moduleTags as $tag){ ?>
                                <li><span class="select-search-list-item_selection-remove">
                                        <?php echo $tag->tag['tag_ua'] ?>
                                    </span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $jq(document).ready(function(){
        $jq('[data-toggle="tooltip"]').tooltip();
    });
</script>
