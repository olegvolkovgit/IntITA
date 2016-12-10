<div class="panel panel-default">
    <div class="panel-body">
            <ul class="list-inline">
                <li>
                    <a type="button" class="btn btn-primary" href="#/supervisor/users">Зареєстровані користувачі</a>
                </li>
                <li>
                    <a type="button" class="btn btn-primary" href="#/supervisor/students">Усі студенти</a>
                </li>
                <li>
                    <a type="button" class="btn btn-primary" href="#/supervisor/studentsWithoutGroup">Офлайн студенти(без групи)</a>
                </li>
                <li>
                    <a type="button" class="btn btn-primary" href="#/supervisor/offlineStudents">Студенти в підгрупах</a>
                </li>
            </ul>
    </div>
    <div class="panel panel-default" ng-controller="userProfileCtrl">
        <div class="panel-body">
            <uib-tabset>
                <uib-tab index="0" heading="Головне">
                    <?php $this->renderPartial('/user/_mainTab', array('model' =>$model, 'trainer' => $trainer));?>
                </uib-tab>
                <?php if ($model->isStudent()){?>
                    <uib-tab index="1" heading="Доступні курси">
                        <?php $this->renderPartial('/user/_coursesTab');?>
                    </uib-tab>
                    <uib-tab index="2" heading="Доступні модулі">
                        <?php $this->renderPartial('/user/_modulesTab');?>
                    </uib-tab>
                <?php }?>
            </uib-tabset>
        </div>
    </div>
</div>