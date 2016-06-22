<?php
/**
 * @var $model CorporateEntity
 */
?>
<div class="row">
    <div class="col-md-10">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td width="40%">Назва: </td>
                <td><?=CHtml::encode($model->title);?></td>
            </tr>
            <tr>
                <td>ЄДРПОУ: </td>
                <td><?=$model->EDPNOU?></td>
            </tr>
            <tr>
                <td>Дата видачі ЄДРПОУ: </td>
                <td><?=date("d.m.Y", strtotime($model->edpnou_issue_date));?></td>
            </tr>
            <tr>
                <td>Свідоцтво платника ПДВ: </td>
                <td><?=$model->certificate_of_vat;?></td>
            </tr>
            <tr>
                <td>Дата видачі свідоцтва платника ПДВ: </td>
                <td><?=date("d.m.Y", strtotime($model->certificate_of_vat_issue_date));?></td>
            </tr>
            <tr>
                <td>Свідоцтво платника податку: </td>
                <td><?=$model->tax_certificate;?></td>
            </tr>
            <tr>
                <td>Дата видачі свідоцтва платника податку: </td>
                <td><?=date("d.m.Y", strtotime($model->tax_certificate_issue_date));?></td>
            </tr>
            <tr>
                <td>Юридична адреса: </td>
                <td><?=$model->legalCity->title_ua.", ".$model->legal_address;?></td>
            </tr>
            <tr>
                <td>Фактична адреса: </td>
                <td><?=$model->actualCity->title_ua.", ".$model->actual_address;?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>