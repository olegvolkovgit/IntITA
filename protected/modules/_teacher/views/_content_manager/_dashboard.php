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
                    <li><a href="#/contentAuthors">Автори контента</a>
                    </li>
                    <li><a href="#/teacherConsultants">Викладачі</a>
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
                    <li><a href="#/lectures/verifycontent">
                            Контент лекцій</a>
                    </li>
                    <li><a href="#/organization/modules">
                            Модулі</a></li>
                    <li>
                        <a href="#/organization/courses">
                            Курси</a></li>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('revision/index'); ?>">
                            Всі ревізії занять</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('moduleRevision/index'); ?>">
                            Всі ревізії модулів</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('courseRevision/index'); ?>">
                            Всі ревізії курсів</a>
                    </li>
                </ul>
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
                    <li><a href="#/content_manager/statusOfModules/all">Стан модулів</a>
                    </li>
                    <li><a href="#/content_manager/statusOfCourses">Стан курсів</a>
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

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Призначити модулі
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/content_manager/authorAttributes">Модуль для автора контента</a>
                    </li>
                    <li><a href="#/content_manager/teacherConsultantAttributes">Модуль для викладача</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Автори модулів, консультанти, etc.</em>
            </div>
        </div>
    </div>

</div>