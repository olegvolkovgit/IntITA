<?php
/* @var $user integer */
?>

<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>"/>


<div class="panel panel-primary">
    <div class="panel-heading">
        Написати листа
    </div>
    <div class="panel-body">
        <form role="form" method="post" onclick="load(<?php echo Yii::app()->createUrl('/_teacher/messages/sendUserMessage'); ?>)">

            <input class="form-control" name="id" id="hidden" value="<?=$user?>">
            <input class="form-control" name="scenario" id="hidden" value="new">

            <div class="form-group" id="receiver">
                <label>Кому</label>
                <br>
                <input id="typeahead" type="text" class="form-control" name="receiver" placeholder="Отримувач" size="90"
                required>
            </div>

            <div class="form-group">
                <label>Тема</label>
                <input class="form-control" name="subject" placeholder="Тема листа" required>
            </div>

            <div class="form-group">
                <label>Лист</label>
                <textarea class="form-control" rows="6" name="text" placeholder="Лист" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Написати
            </button>

            <button type="reset" class="btn btn-default"
                    onclick="load('<?=Yii::app()->createUrl("/_teacher/messages/index")?>')">
                Скасувати
            </button>
        </form>
    </div>
</div>

<script src="<?= StaticFilesHelper::fullPathTo('js', 'typeahead.js'); ?>"></script>
<script>
    users = <?=StudentReg::usersEmailArray($user);?>;
</script>
<script src="<?= StaticFilesHelper::fullPathTo('js', 'messages.js'); ?>"></script>

<script>
    var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var matches, substrRegex;

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
            name: 'receiver',
            source: substringMatcher(users)
        }
    );
</script>