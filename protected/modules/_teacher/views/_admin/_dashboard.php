<div class="row">
    <div class="col-lg-12">
        Адміністратор
    </div>
</div>
<hr>
<div class="row">
<!--    <div class="col-lg-4">-->
<!--        <div class="panel panel-yellow">-->
<!--            <div class="panel-heading">-->
<!--                Контент-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <ul>-->
<!--                    <li><a href="#/admin/verifycontent">-->
<!--                            Контент лекцій</a>-->
<!--                    </li>-->
<!--                    <li><a href="#/admin/coursemanage">-->
<!--                            Курси</a></li>-->
<!--                    <li><a href="#/modulemanage">-->
<!--                            Модулі</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <div class="panel-footer">-->
<!--                <em>Навчальні матеріали</em>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Користувачі
            </div>
            <div class="panel-body">
                <ul>
                    <li><a ui-sref="users.registeredUsers">Користувачі</a></li>
                    <li><a ui-sref="graduate">Випускники</a></li>
                    <li><a ui-sref="users.coworkers">Співробітники</a></li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Користувачі та їх ролі</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Контент
            </div>
            <div class="panel-body">
                <ul>
                    <li><a ui-sref="courses">Курси</a></li>
                    <li><a ui-sref="modules">Модулі</a></li>
                    <li><a ui-sref="lectures">Заняття</a></li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Навчальні матеріали</em>
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
                    <li>
                        <a ng-href="#/admin/users">Користувачі</a>
                    </li>
                    <li>
                        <a ng-href="#/admin/usersemail">База email'ів</a>
                    </li>
                    <li>
                        <a ng-href="#/admin/emailscategory">Категорії email</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Управління користувачами</em>
            </div>
        </div>
    </div>
</div>
<div class="row">
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
</div>


