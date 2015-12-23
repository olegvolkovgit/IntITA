<?php
/* @var $user integer*/
?>
<script src="<?= StaticFilesHelper::fullPathTo('js', 'typeahead.js'); ?>"></script>

<div class="panel panel-primary">
    <div class="panel-heading">
        Написати листа
    </div>
    <div class="panel-body">
        <form role="form" method="post" action="<?php echo Yii::app()->createUrl('messages/sendUserMessage'); ?>">

            <input class="form-control" name="id" style="display: none" value="<?=$user?>">

            <div class="form-group" id="receiver">
                <label>Кому</label>
                <input id="typeahead" type="text" class="form-control" name="user" placeholder="Отримувач">
            </div>

            <div class="form-group">
                <label>Тема</label>
                <input class="form-control" name="subject" placeholder="Тема листа">
            </div>

            <div class="form-group">
                <label>Лист</label>
                <textarea class="form-control" rows="6" name="text" placeholder="Лист"></textarea>
            </div>

            <button type="submit" class="btn btn-primary"
                    onclick="send('<?php echo Yii::app()->createUrl('messages/sendUserMessage'); ?>')">Написати
            </button>

            <button type="reset" class="btn btn-default">Скасувати</button>
        </form>
    </div>
</div>

<script>
    users = <?=StudentReg::usersEmailArray();?>;
</script>

<script>
    var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function (i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    $('#typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            source: substringMatcher(users)
        }
    );
</script>