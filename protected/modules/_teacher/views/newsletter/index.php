<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 13.11.2016
 * Time: 22:43
 */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Написати листа
    </div>
    <div class="panel-body" ng-controller="newsletterCtrl">
        <form ng-app="myApp" name="newsletterForm" novalidate>

            <div class="row">
                <div class="form-group col-md-8" id="receiver">
                    <label>
                        Тип розсилки
                    </label>
                    <br>
                    <label>
                        <input type="radio" ng-model="newsletterType" value="allUsers"
                               ng-click="selectedRecipients = null">
                        Всі активні користувачі
                    </label>
                    <br>
                    <label>
                        <input type="radio" ng-model="newsletterType" value="roles"
                               ng-click="selectedRecipients = null">
                        Розсилка по ролях
                    </label>
                    <br>
                    <label>
                        <input type="radio" ng-model="newsletterType" value="groups"
                               ng-click="selectedRecipients = null">
                        Розсилка по групах
                    </label>
                    <br>
                    <label>
                        <input type="radio" ng-model="newsletterType" value="subGroups"
                               ng-click="selectedRecipients = null">
                        Розсилка по підгрупах
                    </label>
                    <br>
                    <label>
                        <input type="radio" ng-model="newsletterType" value="users"
                               ng-click="selectedRecipients = null">
                        Розсилка по окремих користувачах
                    </label>
                    <br>
                    <label>
                        <input type="radio" ng-model="newsletterType" value="modules"
                               ng-click="selectedRecipients = null">
                        Розсилка по користувачах, які мають доступ до певних модулів
                    </label>
                    <br>
                    <label>
                        <input type="radio" ng-model="newsletterType" value="courses"
                               ng-click="selectedRecipients = null">
                        Розсилка по користувачах, які мають доступ до певних курсів
                    </label>
                    <br>
                    <?php if (Yii::app()->user->model->isAdmin()
                    || Yii::app()->user->model->isAccountant()
                    || Yii::app()->user->model->isTrainer()
                    || Yii::app()->user->model->isAuthor()
                    || Yii::app()->user->model->isContentManager()
                    || Yii::app()->user->model->isTeacherConsultant()
                    || Yii::app()->user->model->isSuperVisor()) {?>
                    <label>
                        <input type="radio" ng-model="newsletterType"  value="emailsFromDatabase"
                               ng-click="selectedRecipients = null">
                        Розсилка по базі email'ів
                        <br>
                        <div ng-show="newsletterType=='emailsFromDatabase'" class="form-group">
                            <label>Категорія*:</label>
                            <select class="form-control" ng-options="item.id as item.title for item in emailsCategory track by item.id"
                                    ng-model="selectedRecipients">
                                <option name="emailCategory" value="" disabled selected>(Виберіть категорію)</option>
                            </select>
                        </div>
                    </label>
                    <?php } ?>
                </div>
                <div class="form-group col-md-8" id="receiver" ng-show="newsletterType=='roles'">
                    <label>Кому</label>
                    <br>
                    <oi-select
                        oi-options="role.name for role in getRoles($query, $selectedAs)"
                        ng-model="selectedRecipients"
                        multiple
                        placeholder="Кому"
                    ></oi-select>
                </div>

                <div class="form-group col-md-8" id="receiver" ng-show="newsletterType=='groups'">
                    <label>Групи</label>
                    <br>
                    <oi-select
                        oi-options="group.name for group in getGroups($query, $selectedAs) track by group.id"
                        ng-model="selectedRecipients"
                        multiple
                        placeholder="Групи"
                    ></oi-select>
                </div>
                <div class="form-group col-md-8" id="receiver" ng-show="newsletterType=='subGroups'">
                    <label>Підгрупи</label>
                    <br>
                    <oi-select
                        oi-options="subgroup.groupName for subgroup in getSubGroups($query) track by subgroup.id"
                        ng-model="selectedRecipients"
                        multiple
                        placeholder="Назва групи"
                        oi-select-options="{
                      debounce: 200,
                      dropdownFilter: 'subgroupsFilter',
                      searchFilter: 'subgroupsSearchFilter',
                     }"
                    ></oi-select>
                </div>

                <div class="form-group col-md-8" id="receiver" ng-show="newsletterType=='modules'">
                    <label>Модулі</label>
                    <br>
                    <oi-select
                            oi-options="courses.name for courses in getModules($query) track by courses.id"
                            ng-model="selectedRecipients"
                            multiple
                            placeholder="Оберіть модулі"
                            oi-select-options="{
                      debounce: 200,
                      dropdownFilter: 'coursesModulesFilter',
                      searchFilter: 'coursesModulesSearchFilter',
                     }"
                    ></oi-select>
                </div>

                <div class="form-group col-md-8" id="receiver" ng-show="newsletterType=='courses'">
                    <label>Курси</label>
                    <br>
                    <oi-select
                            oi-options="modules.name for modules in getCourses($query) track by modules.id"
                            ng-model="selectedRecipients"
                            multiple
                            placeholder="Оберіть курси"
                            oi-select-options="{
                      debounce: 200,
                      dropdownFilter: 'coursesModulesFilter',
                      searchFilter: 'coursesModulesSearchFilter',
                     }"
                    ></oi-select>
                </div>


                <div class="form-group col-md-8" id="receiver" ng-show="newsletterType=='users'">
                    <label>Кориcтувачі</label>
                    <br>
                    <oi-select
                        oi-options="user.email for user in getUsers($query, $selectedAs)"
                        ng-model="selectedRecipients"
                        multiple
                        placeholder="Кому"
                        oi-select-options="{
                      debounce: 200,
                      dropdownFilter: 'usersFilter',
                      searchFilter: 'usersSearchFilter',
                     }"
                    ></oi-select>
                </div>
                <div class="form-group col-md-8">
                    <label for="selectSchedulerType">Електронна пошта для розсилки</label>
                    <select class="form-control" id="selectSchedulerType"
                            ng-model="emailSelected"
                            ng-options="emailSelected.email for emailSelected in userEmails track by emailSelected.email">
                    </select>
                </div>
                <div class="form-group col-md-8" id="receiver">
                </div>
                <div class="form-group col-md-8">
                    <label>Тема</label>
                    <input class="form-control" name="subject" placeholder="Тема листа" ng-model="subject" required>
                    <span style="color:red" ng-show="newsletterForm.subject.$dirty && newsletterForm.subject.$invalid">
                <span ng-cloak ng-show="newsletterForm.subject.$error.required">Заповніть поле!</span>
                </div>

                <div class="form-group col-md-8">
                    <label>Лист</label>
                    <textarea ckeditor="editorOptions" class="form-control" rows="6" name="message" id="message"
                              placeholder="Лист" required ng-model="message"></textarea>
                    <span style="color:red" ng-show="newsletterForm.message.$dirty && newsletterForm.message.$invalid">
                <span ng-cloak ng-show="newsletterForm.message.$error.required">Заповніть поле!</span>
                </div>
                <div class="form-group col-md-8">
                    <label for="selectSchedulerType">Відправка</label>
                    <select class="form-control" id="selectTaskType"
                            ng-model="taskType"
                            ng-options="taskType.value as taskType.name for taskType in taskTypes">
                    </select>
                </div>
                <div ng-show="taskType > 0">
                <div class="form-group col-md-8">
                    <label for="selectSchedulerType">Повтор завдання</label>
                    <select class="form-control" id="selectSchedulerType"
                            ng-model="taskRepeat"
                            ng-options="taskRepeat.value as taskRepeat.name for taskRepeat in taskRepeatTypes">
                    </select>
                </div>
                    <div class="form-group col-md-8" ng-show="taskRepeat==6">
                        <label for="selectSchedulerType">По днях тижня</label>
                        <label ng-repeat="weekday in weekdays" style="display: block">
                            <input type="checkbox" checklist-model="weekdaysList" checklist-value="weekday.id"> {{weekday.name}}
                        </label>

                    </div>
                <div class="form-group col-md-8">
                    <label for="selectSchedulerType">Дата</label>
                    <p class="input-group col-md-3">
                        <input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="date"
                               is-open="open" datepicker-options="dateOptions" ng-required="true" close-text="Закрити"
                               alt-input-formats="altInputFormats"/>
                        <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="open1()"><i
                    class="glyphicon glyphicon-calendar"></i></button>
          </span>   </p>
                    <label for="selectSchedulerType">Час</label>
                    <span uib-timepicker ng-model="time" ng-change="changed()" hour-step=1 minute-step=1 show-meridian="false"></span>
                </div>
                </div>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary"
                            ng-click="send();">
                        Надіслати
                    </button>
                    <button type="reset" class="btn btn-default"
                            ng-click="clearForm()">
                        Очистити форму
                    </button>
                    <button type="reset" class="btn btn-default"
                            ng-click="cancel()">
                        Скасувати
                    </button>
                    <button class="btn btn-default"
                            ng-bootbox-title="Оберіть шаблон повідомлення"
                            ng-bootbox-custom-dialog
                            ng-bootbox-class-name="mailTemplate"
                            ng-bootbox-custom-dialog-template="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/templates/mailTemplate.html'); ?>">
                        Завантажити шаблон
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>