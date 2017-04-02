<li>
    <a href="#/content_manager"  ng-click="changeView('content_manager')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Контент менеджер
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#/content_manager/authors">
                Автори контента
            </a>
        </li>
        <li>
            <a href="#/content_manager/teacherConsultants">
                Викладачі
            </a>
        </li>
        <li>
            <a href="#/admin/verifycontent">
                Контент лекцій</a>
        </li>
        <li>
            <a href="#/organization/modules">
                Модулі</a>
        </li>
        <li>
        <li>
            <a href="#/organization/courses">
                Курси</a></li>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('revision/index'); ?>" target="_blank">
            Всі ревізії занять</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('moduleRevision/index'); ?>" target="_blank">
                Всі ревізії модулів</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('courseRevision/index'); ?>" target="_blank">
                Всі ревізії курсів</a>
        </li>
        <li>
            <?php $p=45?>
            <a href="#/content_manager/statusOfModules/all">
                Стан модулів
            </a>
        </li>
        <li>
            <a href="#content_manager/statusOfCourses">
                Стан курсів
            </a>
        </li>
    </ul>
</li>