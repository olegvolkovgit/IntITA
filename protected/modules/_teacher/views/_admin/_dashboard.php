<div class="row">
    <div class="col-lg-12">
        Адміністратор
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Дизайн
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/interfacemessages">
                           Інтерфейсні повідомлення</a>
                    </li>
                    <li><a href="#/admin/carousel">
                            Слайдер на головній сторінці</a>
                    </li>
                    <li><a href="#admin/aboutusSlider">
                            Слайдер на сторінці <i>Про нас</i></a>
                    </li>
                    <li><a href="#admin/address">
                            Адреса (країни, міста)</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Інтерфейс сайта</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Контент
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/admin/verifycontent">
                            Контент лекцій</a>
                    </li>
                    <li><a href="#/admin/coursemanage">
                            Курси</a></li>
                    <li><a href="#/modulemanage">
                            Модулі</a></li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Навчальні матеріали</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Співробітники / випускники
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/admin/teachers">Співробітники</a>
                    </li>
                    <li><a href="#/sharedlinks">Ресурси для викладачів</a>
                    </li>
                    <li><a href="#/response">Відгуки про викладачів</a>
                    </li>
                    <li><a href="#/graduate">Випускники</a></li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Автори модулів, випускники, etc.</em>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Доступ
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/admin/freelectures">Безкоштовні заняття</a>
<!--                    </li>-->
<!--                    <li><a href="#admin/pay">Сплатити курс/модуль</a>-->
<!--                    </li>-->
<!--                    <li><a href="#/admin/cancel">Скасувати курс/модуль</a>-->
<!--                    </li>-->
                </ul>
            </div>
            <div class="panel-footer">
                <em>Встановлення безкоштовних занять</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Користувачі
            </div>
            <div class="panel-body">
                <ul>
                    <li><a ng-href="#/admin/users">Користувачі
                        </a>
                    </li>
                    <br>
                    <br>
                    <br>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Управління користувачами</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Налаштування сайта
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/configuration/refreshcache">Оновити кеш </a>
                    </li>
                    <li><a href="#/configuration/levels">Рівні курсів, модулів
                        </a>
                    </li>
                    <li><a href="#/configuration/siteconfig">Налаштування
                        </a>
                    </li>
                    <li><a href="#/configuration/careers">Перелік кар'єр
                        </a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Адміністрування сайта</em>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php $this->renderPartial('application.modules._teacher.views.newsletter._newsletterDashboardItem');?>
    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Атрибути ролей
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/admin/authorAttributes">Призначити/скасувати модулі автора контента</a>
                    </li>
                    <li><a href="#/admin/teacherAttributes">Призначити/скасувати модулі викладача</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Призначення/скасування модулів по ролях</em>
            </div>
        </div>
    </div>
    <?php $this->renderPartial('application.modules._teacher.views.schedulerTasks._schedulerDashboardItem');?>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Схеми проплат
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#/accountant/paymentSchemas/default">Стандартні схеми проплат</a>
                    </li>
                    <li>
                        <a href="#/accountant/paymentSchemas/course">Курси</a>
                    </li>
                    <li>
                        <a href="#/accountant/paymentSchemas/module">Модулі</a>
                    </li>
                    <li>
                        <a href="#/accountant/paymentSchemas/user">Користувачі</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Схеми оплат(індивідуальні скидки, акції тощо)</em>
            </div>
        </div>
    </div>
</div>


