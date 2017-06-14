<div class="row">
    <div class="col-lg-12">
        Студент
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                &nbsp;Курси/модулі та фінанси
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#/student/courses">Доступні курси/модулі</a>
                    </li>
                    <li>
                        <a href="#/student/finances">Фінанси</a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                Інформація про доступний контент та договора і рахунки
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Завдання з розгорнутою відповідю
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#/student/plainTasks">Завдання з розгорнутою відповідю
                            <span ng-cloak class="label label-success" ng-if="countOfNewPlainTasksMarks > 0">{{countOfNewPlainTasksMarks}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                Відповіді на завдання та оцінки
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Консультації та контакти
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#/student/consultations">Консультації</a>
                    </li>
                    <li>
                        <a href="#/student/contacts">
                            Контакти
                        </a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Консультації та корисні для студента контакти</em>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <?php if(UserStudent::studentHasSubgroup(Yii::app()->user->getId())) { ?>
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Офлайн навчання
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#/student/offlineEducation">
                            Офлайн навчання
                        </a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Ревізії курсів/модулів, etc.</em>
            </div>
        </div>
    </div>
    <?php } ?>
</div>