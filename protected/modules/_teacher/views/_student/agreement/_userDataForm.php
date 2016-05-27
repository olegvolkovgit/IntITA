<?php
/**
 * @var $user RegisteredUser
 * @var $module integer
 * @var $course integer
 * @var $schemaNum integer
 * @var $educationForm
 * @var $type string
 * @var $offerScenario string
 */
?>
<div class="col col-md-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <form role="form">
                <div class="form-group col-md-12">
                    <label for="passport">Серія/номер паспорта</label>
                    <input type="text" class="form-control" id="passport" required maxlength="30">
                </div>
                <div class="form-group col-md-12">
                    <label for="document_type">Тип документа</label>
                    <input type="text" class="form-control" id="document_type" value="паспорт" required maxlength="30">
                    <em>
                        Тип документа, серія і номер якого вказані у полі паспорт
                    </em>
                    <br>
                    <br>
                </div>
                <div class="form-group col-md-12">
                    <label for="passport_issued">Ким виданий (паспорт)</label>
                    <input type="text" class="form-control" id="passport_issued" required maxlength="255">
                </div>

                <div class="form-group col-md-12">
                    <label for="document_issued_date">Дата видачі паспорта</label>
                    <input size="16" type="text" id="document_issued_date"/>
                </div>

                <div class="form-group col-md-12">
                    <label for="inn">Ідентифікаційний код</label>
                    <input type="text" class="form-control" id="inn" required maxlength="30">
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary"
                            onclick="saveUserDataAndSignAccount(
                                '<?=Yii::app()->createUrl("/_teacher/_student/student/saveUserData");?>',
                                '<?=$type?>',
                                '<?=$course?>',
                                '<?=$module?>',
                                '<?=$schemaNum?>',
                                '<?=$educationForm?>'
                                ); return false;">
                        Підписати договір</button>
                    <button type="reset" class="btn btn-default" onclick="back();">Назад</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        $jq("#document_issued_date").datepicker(lang);
    });
</script>
