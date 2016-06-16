<?php
/**
 * @var $model CorporateRepresentative
 */
?>
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td width="30%">Номер:</td>
                <td><?= $model->id ?></td>
            </tr>
            <tr>
                <td>Прізвище, ім'я та по-батькові:</td>
                <td><?= CHtml::encode($model->full_name); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>