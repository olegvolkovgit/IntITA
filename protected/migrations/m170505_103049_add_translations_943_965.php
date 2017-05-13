<?php

class m170505_103049_add_translations_943_965 extends CDbMigration
{
    private function addTranslate($id, $category, $message, $translates) {
        $this->insert('sourcemessages', [
            'id' => $id,
            'category' => $category,
            'message' => $message
        ]);

        foreach ($translates as $lang => $translation) {
            $this->insert('translate',
                [
                    'id' => $id,
                    'language' => $lang,
                    'translation' => $translation
                ]);
        }
    }

    public function safeUp() {

        $this->addTranslate(943, 'course', '0943',
            [
                'ua' => 'Офлайн-статус',
                'ru' => 'Офлайн-статус',
                'en' => 'Status offline'
            ]);
        $this->addTranslate(944, 'courses', '0944',
            [
                'ua' => 'Стан офлайн:',
                'ru' => 'Состояние офлайн',
                'en' => 'Offline status'
            ]);
        $this->addTranslate(945, 'courses', '0945',
            [
                'ua' => 'Усi нашi курси',
                'ru' => 'Все наши курсы',
                'en' => 'All our courses'
            ]);
        $this->addTranslate(946, 'courses', '0946',
            [
                'ua' => 'Курси партнерiв',
                'ru' => 'Курсы партнёров',
                'en' => 'Partners courses'
            ]);
        $this->addTranslate(947, 'courses', '0947',
            [
                'ua' => 'Усi рiвнi',
                'ru' => 'Все уровни',
                'en' => 'All levels'
            ]);
        $this->addTranslate(948, 'lecture', '0948',
            [
                'ua' => 'Будь-ласка, допоможи нам зробити заняття кращими! Поясни, чому саме ти поставив(ла) таку оцінку:',
                'ru' => 'Пожалуйста, помоги нам сделать занятия лучше! Поясни, почему ты поставил(ла) такую оценку:',
                'en' => 'Please help us make the lessons better! Explain why did you put such an assessment:'
            ]);
        $this->addTranslate(949, 'rating', '0949',
            [
                'ua' => 'заняття викладене зрозуміло',
                'ru' => 'занятия изложенны понятно',
                'en' => 'the lessons stated clearly'
            ]);
        $this->addTranslate(950, 'rating', '0950',
            [
                'ua' => 'матеріал подано цікаво',
                'ru' => 'материал подан интерестно',
                'en' => 'material filed interestingly'
            ]);
        $this->addTranslate(951, 'rating', '0951',
            [
                'ua' => 'завдання в міру вимогливі',
                'ru' => 'задачи в меру требовательны',
                'en' => 'tasks as demanding'
            ]);
        $this->addTranslate(952, 'module', '0952',
            [
                'ua' => 'Вітаємо з закінченням модуля! На основі Твоїх оцінок кожного з занять ми склали середню оцінку модуля. Будь-ласка,                                               підтверди її або відкоригуй.',
                'ru' => 'Поздравляем с завершением модуля! На основе Твоих оценок каждого занятия мы составили среднюю оценку модуля. Пожалуйста, 
                            подтверди их или откоректируй.',
                'en' => 'Congratulations on completing the module! Based on Your assessments of each lesson, we have compiled an average evaluation of
                            the module. Please, verify them or correct them.'
            ]);
        $this->addTranslate(953, 'rating', '0953',
            [
                'ua' => 'модуль викладений зрозуміло',
                'ru' => 'модуль изложен понятно',
                'en' => 'the module stated clearly'
            ]);
        $this->addTranslate(954, 'modul', '0954',
            [
                'ua' => 'Для доступу оплати курс або модуль',
                'ru' => 'Для доступа оплати курс или модуль',
                'en' => 'To access, pay a course or module'
            ]);
        $this->addTranslate(955, 'modul', '0955',
            [
                'ua' => 'Для доступу до модуля спочатку пройди модуль',
                'ru' => 'Для доступа к модулу сначала пройди модуль',
                'en' => 'To access the module first complete module'
            ]);
        $this->addTranslate(956, 'module', '0956',
            [
                'ua' => 'ПРОДОВЖИТИ МОДУЛЬ',
                'ru' => 'ПРОДОЛЖИТЬ МОДУЛЬ',
                'en' => 'CONTINUE MODULE'
            ]);
        $this->addTranslate(957, 'module', '0957',
            [
                'ua' => 'ПРОДОВЖИТИ КУРС',
                'ru' => 'ПРОДОЛЖИТЬ КУРС',
                'en' => 'CONTINUE COURSE'
            ]);
        $this->addTranslate(958, 'course', '0958',
            [
                'ua' => 'ОТРИМАТИ СХЕМУ',
                'ru' => 'ПРОЛУЧИТЬ СХЕМУ',
                'en' => 'GET SCHEMA'
            ]);
        $this->addTranslate(959, 'course', '0959',
            [
                'ua' => 'Спеціальні пропозиції',
                'ru' => 'Специальные предложения',
                'en' => 'Special offers'
            ]);
        $this->addTranslate(960, 'course', '0960',
            [
                'ua' => 'Якщо ти виконав усі умови для отримання даної акційної схеми, відправ запит для отримання схеми,
                            та чекай повідомлення про її активацію в найближчий час',
                'ru' => 'Если ты выполнил все условия для получения данной акционной схемы, отправь запрос для получения схемы, и жди сообщение о ее активации                          в ближайшее время',
                'en' => 'If you have fulfilled all the conditions for this promotional scheme, send a request for the circuit, and wait for notification of                             activation in the near future'
            ]);
        $this->addTranslate(961, 'course', '0961',
            [
                'ua' => 'Акція діє ',
                'ru' => 'Акция действует ',
                'en' => 'The promotion is valid '
            ]);
        $this->addTranslate(962, 'course', '0962',
            [
                'ua' => 'з ',
                'ru' => 'с ',
                'en' => 'from '
            ]);
        $this->addTranslate(963, 'course', '0963',
            [
                'ua' => 'по ',
                'ru' => 'по ',
                'en' => 'to '
            ]);
        $this->addTranslate(964, 'module', '0964',
            [
                'ua' => 'Всі модулі ',
                'ru' => 'Все модули ',
                'en' => 'All modules '
            ]);
        $this->addTranslate(965, 'module', '0965',
            [
                'ua' => 'Модуль № ',
                'ru' => 'Модуль № ',
                'en' => 'Module № '
            ]);

        return true;
    }


    public function safeDown()
    {
        $this->delete('translate', 'id=0943');
        $this->delete('sourcemessages', 'id=0943');
        $this->delete('translate', 'id=0944');
        $this->delete('sourcemessages', 'id=0944');
        $this->delete('translate', 'id=0945');
        $this->delete('sourcemessages', 'id=0945');
        $this->delete('translate', 'id=0946');
        $this->delete('sourcemessages', 'id=0946');
        $this->delete('translate', 'id=0947');
        $this->delete('sourcemessages', 'id=0947');
        $this->delete('translate', 'id=0948');
        $this->delete('sourcemessages', 'id=0948');
        $this->delete('translate', 'id=0949');
        $this->delete('sourcemessages', 'id=0949');
        $this->delete('translate', 'id=0950');
        $this->delete('sourcemessages', 'id=0950');
        $this->delete('translate', 'id=0951');
        $this->delete('sourcemessages', 'id=0951');
        $this->delete('translate', 'id=0952');
        $this->delete('sourcemessages', 'id=0952');
        $this->delete('translate', 'id=0953');
        $this->delete('sourcemessages', 'id=0953');
        $this->delete('translate', 'id=0954');
        $this->delete('sourcemessages', 'id=0954');
        $this->delete('translate', 'id=0955');
        $this->delete('sourcemessages', 'id=0955');
        $this->delete('translate', 'id=0956');
        $this->delete('sourcemessages', 'id=0956');
        $this->delete('translate', 'id=0957');
        $this->delete('sourcemessages', 'id=0957');
        $this->delete('translate', 'id=0958');
        $this->delete('sourcemessages', 'id=0958');
        $this->delete('translate', 'id=0959');
        $this->delete('sourcemessages', 'id=0959');
        $this->delete('translate', 'id=0960');
        $this->delete('sourcemessages', 'id=0960');
        $this->delete('translate', 'id=0961');
        $this->delete('sourcemessages', 'id=0961');
        $this->delete('translate', 'id=0962');
        $this->delete('sourcemessages', 'id=0962');
        $this->delete('translate', 'id=0963');
        $this->delete('sourcemessages', 'id=0963');
        $this->delete('translate', 'id=0964');
        $this->delete('sourcemessages', 'id=0964');
        $this->delete('translate', 'id=0965');
        $this->delete('sourcemessages', 'id=0965');

    }
}