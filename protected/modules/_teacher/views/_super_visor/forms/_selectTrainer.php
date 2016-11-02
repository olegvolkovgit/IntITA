<input class="form-control" name="userId" id="trainer" type="hidden" value="0">
<input id="typeahead" type="text" class="typeahead form-control" name="user" placeholder="Виберіть тренера" size="90"
       autofocus required>


<script>
    var trainers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_super_visor/superVisor/trainers?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        url: user.url
                    };
                });
            }
        }
    });

    trainers.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'trainers',
        display: 'email',
        limit: 10,
        source: trainers,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає тренерів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#trainer").val(item.id);
    });
</script>