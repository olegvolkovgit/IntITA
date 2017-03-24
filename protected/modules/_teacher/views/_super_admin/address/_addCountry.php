<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/address">
            Країни, міста
        </a>
    </li>
</ul>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form name="addCountryForm" onsubmit="addCountry('<?php echo Yii::app()->createUrl('/_teacher/_super_admin/address/newCountry')?>');return false;">
                    <div class="form-group">
                        <label>Назва українською*</label>
                        <input name="titleUa" class="form-control" required maxlength="50" size="50">
                    </div>

                    <div class="form-group">
                        <label>Назва російською*</label>
                        <input name="titleRu" class="form-control" required maxlength="50" size="50">
                    </div>

                    <div class="form-group">
                        <label>Назва англійською*</label>
                        <input name="titleEn" class="form-control" required maxlength="50" size="50">
                    </div>

                    <div class="form-group">
                        <label>Геокод(двосимвольний)*</label>
                        <input name="geocode" class="form-control" pattern="[A-Z]{2}"
                               oninput="validateComments(this,'Геокод країни - дві великі латинські літери')" required maxlength="2" size="50">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Зберегти</button>
                        <a type="reset" class="btn btn-outline btn-default" ng-href="#/address" >Скасувати
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function validateComments(input, text) {
        var rgx = new RegExp(input.pattern);
        if (!rgx.test(input.value)) {
            input.setCustomValidity(text);
            $jq(input).addClass('errorValidation');
        }
        else {
            input.setCustomValidity("");
            $jq(input).removeClass('errorValidation');
        }
    }
</script>