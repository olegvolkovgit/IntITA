
<div class="panel panel-primary">
    <div class="panel-body">
        <form >
            <div class="form-group" id="receiver">
                <label>Фраза</label>
                <br>
                <br>
                <input id="phrase" type="text" class="form-control" name="user" placeholder="Введіть фразу"
                       size="90" required>
                <br>
                <br>

            </div>

            <button class="btn btn-primary"
                    onclick="updatePhrase(<?=$id?>);return false;">
                Зберегти фразу
            </button>

            <button type="reset" class="btn btn-default"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/showPhrases'); ?>')">
                Скасувати
            </button>
        </form>
        <br>

    </div>
</div>
<script>

    editPhrase('<?=$phrase?>');

    function editPhrase(phrase){

        $jq('#phrase').val(phrase);
        return true;
    }
    function updatePhrase(id){
        var phrase = document.getElementById('phrase').value;

        $jq.ajax({
            url: basePath + "/_teacher/_tenant/tenant/updatePhrase?phrase="+phrase+"&id="+id,
            success: function () {
                load(basePath + '/_teacher/_tenant/tenant/showPhrases');
            },

        });}
    </script>
