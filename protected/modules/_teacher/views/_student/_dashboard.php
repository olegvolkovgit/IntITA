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
                &nbsp;
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/student/courses">Доступні курси/модулі</a>
                    </li>
                    <li><a href="#/student/consultations">Консультації</a>
                    </li>
                    <li><a href="#/student/finances">Фінанси</a>
                    </li>
                    <li>
                        <a href="#/student/plainTasks">Завдання з розгорнутою відповідю
                            <span ng-cloak class="label label-success" ng-if="countOfNewPlainTasksMarks > 0">{{countOfNewPlainTasksMarks}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#/student/contacts">
                            Контакти
                        </a>
                    </li>
                    <?php if(UserStudent::studentHasSubgroup(Yii::app()->user->getId())) { ?>
                    <li>
                        <a href="#/student/offlineEducation">
                            Офлайн навчання
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="panel-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>