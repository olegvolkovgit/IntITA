/**
 * Created by Wizlight on 06.01.2016.
 */
angular
    .module('lessonEdit')
    .run([
        '$ngBootbox',
        function ($ngBootbox) {
            $ngBootbox.addLocale('uk', { OK: 'Добре', CANCEL: 'Ні', CONFIRM: 'Так' });
            $ngBootbox.addLocale('ru', { OK: 'Хорошо', CANCEL: 'Нет', CONFIRM: 'Да' });
            $ngBootbox.addLocale('en', { OK: 'OK', CANCEL: 'Cancel', CONFIRM: 'Yes' });
            $ngBootbox.setLocale(lang);
        }
    ]);