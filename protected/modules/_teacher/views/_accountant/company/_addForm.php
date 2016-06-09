<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/index'); ?>',
                    'Компанії')">
            Компанії
        </button>
    </li>
</ul>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form>
                    <div class="form-group">
                        <label>Назва</label>
                        <input name="title" class="form-control" required maxlength="255" size="50">
                    </div>

                    <div class="form-group">
                        <label>ЄДРПОУ</label>
                        <input type="number" name="edpnou" class="form-control" required maxlength="12" size="12">
                    </div>

                    <div class="form-group">
                        <label>Дата видачі  ЄДРПОУ</label>
                        <input size="16" type="text" id="edpnou_issue_date" value=""/>
                    </div>

                    <div class="form-group">
                        <label>Свідоцтво платника ПДВ</label>
                        <input type="number" name="certificate_of_vat" class="form-control" required maxlength="12" size="12">
                    </div>

                    <div class="form-group">
                        <label>Дата видачі свідоцтва платника ПДВ</label>
                        <input size="16" type="text" id="certificate_of_vat_issue_date" value=""/>
                    </div>

                    <div class="form-group">
                        <label>Свідоцтво платника податку</label>
                        <input type="number" name="tax_certificate" class="form-control" required maxlength="12" size="12">
                    </div>

                    <div class="form-group">
                        <label>Дата видачі свідоцтва платника податку</label>
                        <input size="16" type="text" id="tax_certificate_issue_date" value=""/>
                    </div>

                    <div class="form-group">
                        <label>Місто (юридична адреса)</label>
                        <input id="typeaheadCityLegal" type="text" class="typeahead form-control" name="cityLegal"
                               placeholder="виберіть місто"
                               size="90" required>
                        <input type="number" hidden="hidden" id="cityLegal" value="0"/>
                        <p class="help-block"><em>* якщо немає потрібного міста, можна просто ввести назву (українською мовою)</em></p>
                    </div>

                    <div class="form-group">
                        <label>Юридична адреса</label>
                        <input name="legal_address" class="form-control" required maxlength="50" size="50">
                    </div>

                    <div class="form-group">
                        <label>Місто (фактична адреса)</label>
                        <input id="typeaheadCityActual" type="text" class="typeahead form-control" name="cityActual"
                               placeholder="виберіть місто"
                               size="90" required>
                        <input type="number" hidden="hidden" id="cityActual" value="0"/>
                        <p class="help-block"><em>* якщо немає потрібного міста, можна просто ввести назву (українською мовою)</em></p>
                    </div>

                    <div class="form-group">
                        <label>Фактична адреса</label>
                        <input name="actual_address" class="form-control" required maxlength="50" size="50">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" onclick="addCompany('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/newCompany')?>');
                            return false;">Зберегти</button>
                        <button type="reset" class="btn btn-outline btn-default" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/index'); ?>',
                            'Компанії')">Скасувати
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        $jq("#edpnou_issue_date").datepicker(lang);
        $jq("#certificate_of_vat_issue_date").datepicker(lang);
        $jq("#tax_certificate_issue_date").datepicker(lang);
    });
</script>