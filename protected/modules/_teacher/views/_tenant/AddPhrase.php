
<div class="panel panel-primary">
    <div class="panel-body">
        <form role="forme">
            <div class="form-group" id="receiver">
                <input type="number" hidden="hidden" id="userId" value="0"/>
                <label>Фраза</label>
                <br>
                <br>
                <input id="typeahead" type="text" class="form-control" name="user" placeholder="Введіть фразу"
                       size="90" required>
                <br>
                <br>

            </div>

            <button class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/showPhrases'); ?>')">
Створити фразу
</button>

            <button type="reset" class="btn btn-default"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/showPhrases'); ?>')">
Скасувати
            </button>
        </form>
        <br>

    </div>
</div>
