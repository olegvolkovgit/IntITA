<?php
/**
 * @var $model Course
 * @var $levels array
 * @var $level Level
 * @var $scenario string
 */
?>
<br>
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label class="control-label col-sm-2" for="lang">Мова *:</label>
        <div class="col-sm-10">
            <select class="form-control" id="lang">
                <option value="ua" <?php if($model->language == "ua") echo "selected"; ?>>Українська</option>
                <option value="ru" <?php if($model->language == "ru") echo "selected"; ?>>Російська</option>
                <option value="en" <?php if($model->language == "en") echo "selected"; ?>>Англійська</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="alias">Псевдонім *:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="alias" placeholder="псевдонім" required value="<?=$model->alias;?>"
                   pattern="[a-z0-9]{1,20}" title="Псевдонім може містити тільки англійські літери і цифри.">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="num">Номер *:</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="num" placeholder="номер" required
                   value="<?=$model->course_number;?>" min="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="level">Pівень *:</label>
        <div class="col-sm-10">
            <select class="form-control" id="level" required>
                <?php foreach ($levels as $level) {?>
                    <option value="<?=$level->id?>" <?php if($model->level == $level->id) echo "selected"; ?>>
                        <?=$level->title_ua;?>
                    </option>
                    <?php
                }?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label class="radio-inline"><input type="radio" name="status" value="develop" checked>В розробці</label>
                <label class="radio-inline"><input type="radio" name="status" value="ready">Готовий</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label class="radio-inline"><input type="radio" name="isCancel" value="available">Доступний</label>
                <label class="radio-inline"><input type="radio" name="isCancel" value="cancelled" checked>Видалений</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="image">Зображення:</label>
        <div class="col-sm-10">
            <input type="file" id="image" data-fv-file-maxfiles="1" data-fv-file-maxsize="5242880"
                   data-fv-file-type="image/jpeg,image/png,image/gif">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary"
                    onclick="createCourse('<?=Yii::app()->createUrl("/_teacher/_admin/coursemanage/newCourse")?>'); return false;">
                Зберегти</button>
        </div>
    </div>
</form>
<script>

    function createCourse(url){
        data = getFormData();
        bootbox.confirm(message, function(result) {
            if (result) {
                $jq.ajax({
                    url: url,
                    type: "POST",
                    data: {data : data},
                    success: function () {
                        bootbox.alert("Операцію успішно виконано.");
                    },
                    error:function () {
                        showDialog("Операцію не вдалося виконати.");
                    }
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    }

    function getFormData(){
        titleUa = $jq("#titleUa").val();
        if(!titleUa){
            showDialog("Введіть назву курса українською мовою.");
            $jq('.nav-tabs a[href="#ua"]').tab('show');
            $jq('#titleUa').focus();
        }
        titleRu = $jq("#titleRu").val();
        if(!titleRu){
            bootbox.alert("Введіть назву курса російською мовою.");
            $jq('.nav-tabs a[href="#ru"]').tab('show');
            $jq('#titleRu').focus();
        }
        titleEn = $jq("#titleEn").val();
        if(!titleEn){
            showDialog("Введіть назву курса англійською мовою.");
            $jq('.nav-tabs a[href="#en"]').tab('show');
            $jq('#titleEn').focus();
        }

        return data =
        {
            lang: $jq("#lang").val(),
            level: $jq("#level").val(),
            number: $jq("#num").val(),
            alias: $jq("#alias").val(),
            image : $jq("#image").val(),
            titleUa : titleUa,
            titleRu : titleRu,
            titleEn : titleEn,
            forWhomUa : $jq("#forWhomUa").val(),
            forWhomRu : $jq("#forWhomRu").val(),
            forWhomEn : $jq("#forWhomEn").val(),
            whatYouLearnUa : $jq("#whatYouLearnUa").val(),
            whatYouLearnRu : $jq("#whatYouLearnRu").val(),
            whatYouLearnEn : $jq("#whatYouLearnEn").val(),
            whatYouGetUa : $jq("#whatYouGetUa").val(),
            whatYouGetRu : $jq("#whatYouGetRu").val(),
            whatYouGetEn : $jq("#whatYouGetEn").val(),
            status: $jq( "input:radio[name=status]:checked" ).val(),
            isCancel: $jq( "input:radio[name=isCancel]:checked" ).val()
        };
    }
</script>

