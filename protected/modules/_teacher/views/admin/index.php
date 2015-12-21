<div class="row" >
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Дизайн
            </div>
            <div class="panel-body">
                <ul>
                    <li><a  href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/translate/index'); ?>')">
                            Інтерфейсні повідомлення</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/carousel/index'); ?>">Слайдер на головній
                            сторінці</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/index'); ?>">Слайдер на
                            сторінці <i>Про нас</i></a></li>
                    <br>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Інтерфейс сайта</em>
            </div>
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Контент
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/admin/verifyContent'); ?>')">
                            Контент лекцій</a>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/graduate/index'); ?>">Випускники</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index'); ?>">Курси</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/module/index'); ?>">Модулі</a></li>
                </ul>
            </div>
            <div class="panel-footer">
                Навчальні матеріали
            </div>
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Викладачі
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#" ng-click='ngLoad("<?php echo Yii::app()->createUrl('/_admin/tmanage/index')?>")'>
                            Викладачі</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/shareLink/index'); ?>">Ресурси для
                            викладачів</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/response/index'); ?>">Відгуки про
                            викладачів</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/trainer/index'); ?>">Тренери</a></li>
                </ul>
            </div>
            <div class="panel-footer">
                Автори модулів, тренери, etc.
            </div>
        </div>
    </div>
    <!-- /.col-lg-4 -->
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Доступ
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/admin/freeLectures'); ?>',
                            'Безкоштовні лекції')">
                            Безкоштовні лекції</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/permissions/index'); ?>">Права
                            доступа</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/pay/index'); ?>">Сплатити курс/модуль</a>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/pay/cancelCourseModule'); ?>">Скасувати
                            курс/модуль</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                Права доступу до курсів/модулів
            </div>
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Налаштування сайта
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="<?php echo Yii::app()->createUrl('/_admin/config/index'); ?>">
                            Налаштування
                        </a>
                    </li>
                    <br>
                    <br>
                    <br>
                </ul>
            </div>
            <div class="panel-footer">
                Адміністрування сайта
            </div>
        </div>
    </div>
    <!-- /.row -->
<div class="row">


