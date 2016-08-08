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
                    <li><a href="#/content_manager/authors">Автори модулів</a>
                    </li>
                    <li><a href="#/content_manager/consultants">Консультанти для модулів</a>
                    </li>
                    <li><a href="#/content_manager/teacherConsultants">Викладачі</a>
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
                    <li><a href="#admin/verifycontent">
                            Контент лекцій</a>
                    </li>
                    <li><a href="#/modulemanage">
                            Модулі</a></li>
                    <li>
                        <a href="#/admin/coursemanage">
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