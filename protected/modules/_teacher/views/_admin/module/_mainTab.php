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
                <td><?=$model->alias;?></td>
            </tr>
            <tr>
                <td>Ціна (якщо не входить у курс), USD: </td>
                <td><?=$model->module_price;?></td>
            </tr>
            <tr>
                <td>Номер модуля: </td>
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
            </tbody>
        </table>
    </div>
</div>
