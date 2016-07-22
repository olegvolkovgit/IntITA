<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#/content_manager"  ng-click="changeView('content_manager')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Контент менеджер
        <span class="fa arrow"></span >
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#/content_manager/authors">
                Автори модулів
            </a>
        </li>
        <li>
            <a href="#/content_manager/consultants">
                Консультанти
            </a>
        </li>
        <li>
            <a href="#/content_manager/teacherConsultants">
                Викладачі
            </a>
        </li>
        <li>
            <a href="/revision/index/">
            Всі ревізії</a>
        </li>
        <li>
            <?php $p=45?>
            <a href="#/content_manager/statusOfModules">
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