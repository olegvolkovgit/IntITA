<div class="panel panel-primary">
    <div class="panel-body">
        <form role="form" method="post" onclick="load(<?php echo Yii::app()->createUrl('/_teacher/_admin/users/createAdmin'); ?>)">

            <div class="form-group" id="receiver">
                <label>Користувач</label>
                <br>
                <input id="typeahead" type="text" class="form-control" name="user" placeholder="Виберіть користувача"
                       size="90" required>
                <br>
                <br>
                <em>Зверніть увагу, що деяких користувачів може не бути в списку. В списку немає користувачів, в
                    яких вже є права адміністратора.</em>
                <br>
            </div>

            <button type="submit" class="btn btn-primary">
                Призначити адміністратором
            </button>

            <button type="reset" class="btn btn-default"
                    onclick="load('<?=Yii::app()->createUrl("/_teacher/_admin/users/index")?>')">
                Скасувати
            </button>
        </form>
    </div>
</div>

<script src="<?= StaticFilesHelper::fullPathTo('js', 'typeahead.js'); ?>"></script>
<script>
    users = <?=StudentReg::usersEmailArray(Yii::app()->user->getId());?>;
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