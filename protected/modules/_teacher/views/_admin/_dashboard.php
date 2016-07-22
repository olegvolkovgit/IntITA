<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Дизайн
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/messages">
                           Інтерфейсні повідомлення</a>
                    </li>
                    <li><a href="#/admin/mainslider">
                            Слайдер на головній сторінці</a>
                    </li>
                    <li><a href="#admin/aboutusslider">
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
                    <li><a href="#/admin/modulemanage">
                            Модулі</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('revision/index'); ?>">
                            Всі ревізії занять</a></li>
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
                    <li><a href="#/admin/sharedlinks">Ресурси для викладачів</a>
                    </li>
                    <li><a href="#/admin/response">Відгуки про викладачів</a>
                    </li>
                    <li><a href="#/admin/graduate">Випускники</a></li>
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
                    </li>
                    <li><a href="#/admin/permissions">Права доступа</a>
                    </li>
                    <li><a href="#admin/pay">Сплатити курс/модуль</a>
                    </li>
                    <li><a href="#/admin/cancel">Скасувати курс/модуль</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Права доступу до курсів/модулів</em>
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
                    <li><a href="#/admin/users"
                           onclick="load('<?php echo Yii::app()->createUrl(''); ?>',
                               'Користувачі')">Користувачі
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
                    <li><a href="#/admin/refreshcache">Оновити кеш </a>
                    </li>
                    <li><a href="#/admin/levels">Рівні курсів, модулів
                        </a>
                    </li>
                    <li><a href="#/admin/config">Налаштування
                        </a>
                    </li>
                    <li><a href="#/admin/old">Функціонал попередньої версії</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Адміністрування сайта</em>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/graduatesList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/requestsList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/configList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/responsesList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/translatesList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/coursesList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/aboutUsSliderList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/mainSliderList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/teachersList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/shareLinks.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/usersManage.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/freeLectures.js'); ?>"></script>

