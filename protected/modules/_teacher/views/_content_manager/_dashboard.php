<div class="row">
    <div class="col-lg-12">
        Контент менеджер
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Співробітники
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/authors'); ?>',
                               'Автори модулів')">Автори модулів</a>
                    </li>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/consultants'); ?>',
                               'Консультанти для модулів')">Консультанти для модулів</a>
                    </li>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/teacherConsultants'); ?>',
                               'Викладачі')">Викладачі</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Автори модулів, консультанти, etc.</em>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Наповнення контенту
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('revision/index'); ?>">
                            Всі ревізії</a>
                    </li>
                </ul>
                <br>
                <br>
            </div>
            <div class="panel-footer">
                <em>Ревізії курсів/модулів, etc.</em>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Курси/модулі
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/statusOfModules', array('id' => 0)); ?>',
                               'Стан модулів')">Стан модулів</a>
                    </li>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/statusOfCourses'); ?>',
                               'Стан курсів')">Стан курсів</a>
                    </li>
                </ul>
                <br>
            </div>
            <div class="panel-footer">
                <em>Статистика курсів/модулів, etc.</em>
            </div>
        </div>
    </div>
</div>