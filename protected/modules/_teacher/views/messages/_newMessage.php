<script src="<?= StaticFilesHelper::fullPathTo('js', 'typeahead.js'); ?>"></script>

<div class="panel panel-primary">
    <div class="panel-heading">
        Написати листа
    </div>
    <div class="panel-body">
        <form role="form">

            <div class="form-group" id="receiver">
                <label>Кому</label>
                <input class="typeahead" type="text" placeholder="Отримувач">
            </div>

            <div class="form-group">
                <label>Тема</label>
                <input class="form-control" placeholder="Тема листа">
            </div>
            <div class="form-group">
                <label>Лист</label>
                <textarea class="form-control" rows="6" placeholder="Лист"></textarea>
            </div>

            <button type="submit" class="btn btn-primary"
                    onclick="send('<?php echo Yii::app()->createUrl('messages/sendUserMessage'); ?>')">Написати
            </button>
            <button type="reset" class="btn btn-default">Скасувати</button>
        </form>
    </div>
</div>

<script>

    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
        'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
        'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
        'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
        'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
        'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
        'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
        'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
        'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
    ];

    $('#receiver .typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            source: substringMatcher(states)
        });
</script>