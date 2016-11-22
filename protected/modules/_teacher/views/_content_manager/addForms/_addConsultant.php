E:\xampp\htdocs\IntITA\protected\modules\_teacher\views\_content_manager\addForms\_addConsultant.php
<!--<div class="panel panel-primary">-->
<!--    <div class="panel-body">-->
<!--        <form role="form">-->
<!--            <div class="form-group" id="receiver">-->
<!--                <input type="number" hidden="hidden" id="userId" value="0"/>-->
<!--                <label>Користувач</label>-->
<!--                <br>-->
<!--                <input id="typeahead" type="text" class="form-control" name="user" placeholder="Виберіть користувача"-->
<!--                       size="90" required>-->
<!--                <br>-->
<!--                <br>-->
<!--                <em>* Зверніть увагу, що деяких користувачів може не бути в списку. В списку немає користувачів, в-->
<!--                    яких вже є права консультанта.</em>-->
<!--                <br>-->
<!--            </div>-->
<!---->
<!--            <button class="btn btn-primary"-->
<!--                    onclick="assignRoleCM('--><?php //echo Yii::app()->createUrl("/_teacher/_content_manager/contentManager/assignRole"); ?><!--',-->
<!--                        'consultant', '9'); return false;">-->
<!--                Призначити консультанта-->
<!--            </button>-->
<!---->
<!--            <button type="reset" class="btn btn-default"-->
<!--                    onclick="load('--><?//= Yii::app()->createUrl("/_teacher/_content_manager/contentManager/consultants") ?><!--')">-->
<!--                Скасувати-->
<!--            </button>-->
<!--        </form>-->
<!--        <br>-->
<!--        <div class="alert alert-info">-->
<!--            --><?php //if (Yii::app()->user->model->isAdmin()) { ?>
<!--                Консультантом можна призначити лише зареєтрованого співробітника.-->
<!--                Якщо потрібного користувача немає в списку авторів, то призначити роль автора можна на сторінці-->
<!--                <a href="#" class="alert-link" onclick="load('--><?php //echo Yii::app()->createUrl('/_teacher/_admin/teachers/create');?>//', 'Призначити автора')">
<!--                    Призначити співробітника</a>.-->
<!--            --><?php //} else { ?>
<!--            Призначити консультантом можна тільки вже зареєстрованого співробітника. Додати нового співробітника можна-->
<!--            за посиланням:-->
<!--            <a href="#" class="alert-link"-->
<!--               onclick="load('--><?php //echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/sendCoworkerRequest'); ?><!--',-->
<!--                   'Запит на призначення співробітника')">Надіслати запит</a>.-->
<!--            --><?php //} ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<script>-->
<!--    var users = new Bloodhound({-->
<!--        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),-->
<!--        queryTokenizer: Bloodhound.tokenizers.whitespace,-->
<!--        remote: {-->
<!--            url: basePath + '/_teacher/_content_manager/contentManager/usersAddForm?role=consultant&query=%QUERY',-->
<!--            wildcard: '%QUERY',-->
<!--            filter: function (users) {-->
<!--                return $jq.map(users.results, function (user) {-->
<!--                    return {-->
<!--                        id: user.id,-->
<!--                        name: user.name,-->
<!--                        email: user.email,-->
<!--                        url: user.url-->
<!--                    };-->
<!--                });-->
<!--            }-->
<!--        }-->
<!--    });-->
<!---->
<!--    users.initialize();-->
<!---->
<!--    $jq('#typeahead').on('typeahead:selected', function (e, item) {-->
<!--        $jq("#userId").val(item.id);-->
<!--    });-->
<!---->
<!--    $jq('#typeahead').typeahead(null, {-->
<!--        name: 'users',-->
<!--        display: 'email',-->
<!--        limit: 10,-->
<!--        source: users,-->
<!--        templates: {-->
<!--            empty: [-->
<!--                '<div class="empty-message">',-->
<!--                'немає користувачів з таким іменем або email\`ом',-->
<!--                '</div>'-->
<!--            ].join('\n'),-->
<!--            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")-->
<!--        }-->
<!--    });-->
<!--</script>-->