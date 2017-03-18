<?php
/* @var $scenario */
?>
<div ng-controller="displayPromotionSchemesCtrl">
    <ul class="list-inline">
        <li>
            <a ng-href="#/accountant/paymentSchemas/schemas/template" class="btn btn-primary">
                Шаблони схем
            </a>
        </li>
        <li>
            <a ng-href="#/accountant/paymentSchemas/schemas/createTemplate" class="btn btn-primary">
                Додати шаблон схем
            </a>
        </li>
        <li>
            <a ng-href="#/accountant/paymentSchemas/schemas/apply" class="btn btn-primary">
                Застосувати шаблон схем
            </a>
        </li>
        <li>
            <a ng-href="#/accountant/paymentSchemas/schemas/appliedTemplates" class="btn btn-primary">
                Список застосованих шаблонів
            </a>
        </li>
        <li>
            <a ng-href="#/accountant/paymentSchemas/schemas/displaypromotionlist" class="btn btn-primary">
                Список застосованих акцій
            </a>
        </li>
    </ul>
    <div class="row m-b-20">
        <div class="col-md-4">
            <span class="control-label">Шаблон схем*</span>
        </div>
        <div class="col-md-8">
            <select
                required="required"
                class="form-control"
                ng-model="paymentSchema.template"
                ng-options="template as template.template_name_ua for template in templates">
                <option style="display:none" value="">--Виберіть шаблон схем--</option>
            </select>
        </div>
    </div>
    <div class="row m-b-20">
        <div class="col-md-4">
            <span class="control-label">Тип сервісів (застосовується на всі сервіси вказаного типу, якщо не вибрано конкретний сервіс)</span>
        </div>
        <div class="col-md-8">
            <select class="form-control" ng-model="paymentSchema.serviceType" 
                    ng-disabled="paymentSchema.moduleId || paymentSchema.courseId"
                    ng-init="paymentSchema.serviceType = services[0].value"
                    ng-options="service.value as service.name for service in services" >
            </select>
        </div>
    </div>

    <div class="row m-b-20">
        <div class="col-md-4">
            <span class="control-label">Курс</span>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <span ng-show="!course.loading && !noResultsCourse" class="input-group-addon">
                    <i class="glyphicon glyphicon-pencil"></i>
                </span>
                <span ng-show="course.loading" class="input-group-addon">
                    <i class="glyphicon glyphicon-refresh"></i>
                </span>
                <span ng-show="noResultsCourse" class="input-group-addon">
                    <i class="glyphicon glyphicon-remove"></i>
                </span>
                <input ng-disabled="!paymentSchema.template" type="text" size="135" ng-model="selectedCourse" ng-model-options="{ debounce: 1000 }"
                       placeholder="Назва курсу" uib-typeahead="item.title for item in getCourses($viewValue) | limitTo : 10"
                       typeahead-loading="course.loading"
                       typeahead-no-results="noResultsCourse"  typeahead-on-select="onSelectCourse($item)"
                       ng-change="reloadCourse()" class="form-control" />
            </div>
        </div>
    </div>

    <div class="row m-b-20">
        <div class="col-md-4">
            <span class="control-label">Модуль</span>
        </div>
        <div class="col-md-8">
            <div class=" input-group">
                <span ng-show="!module.loading && !noResultsModule" class="input-group-addon">
                    <i class="glyphicon glyphicon-pencil"></i>
                </span>
                <span ng-show="module.loading" class="input-group-addon">
                    <i class="glyphicon glyphicon-refresh"></i>
                </span>
                <span ng-show="noResultsModule" class="input-group-addon">
                    <i class="glyphicon glyphicon-remove"></i>
                </span>
                <input ng-disabled="!paymentSchema.template" type="text" size="135" ng-model="selectedModule" ng-model-options="{ debounce: 1000 }"
                       placeholder="Назва модуля" uib-typeahead="item.title for item in getModules($viewValue) | limitTo : 10"
                       typeahead-loading="module.loading"
                       typeahead-no-results="noResultsModule"  typeahead-on-select="onSelectModule($item)"
                       ng-change="reloadModule()" class="form-control" />
            </div>
        </div>
    </div>
    <div class="row m-d-20">
        <div class="col-md-4">
            <span class="control-label">Дата початку відображення акційної пропозиції</span>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-default" ng-click="startShowOptions.open()">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                </span>
                <input type="text"
                       class="form-control"
                       uib-datepicker-popup
                       ng-model="paymentSchema.showDate"
                       is-open="startShowOptions.popupOpened"
                       datepicker-options="openDateOptions"
                       clear-text='Очистити'
                       close-text='Закрити'
                       current-text='Сьогодні'>
            </div>
        </div>
    </div>
    <div class="row m-b-20">
        <div class="col-md-4">
            <span class="control-label">Дати початку і завершення</span>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-default" ng-click="startDateOptions.open()">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                </span>
                <input type="text"
                       class="form-control"
                       uib-datepicker-popup
                       ng-model="paymentSchema.startDate"
                       is-open="startDateOptions.popupOpened"
                       datepicker-options="openDateOptions"
                       clear-text='Очистити'
                       close-text='Закрити'
                       current-text='Сьогодні'>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-default" ng-click="endDateOptions.open()">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                </span>
                <input type="text"
                       class="form-control"
                       uib-datepicker-popup
                       ng-model="paymentSchema.endDate"
                       is-open="endDateOptions.popupOpened"
                       datepicker-options="endDateOptions"
                       clear-text='Очистити'
                       close-text='Закрити'
                       current-text='Сьогодні'>
            </div>
        </div>
    </div>

    <div class="row m-b-20">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <input type="button" class="btn btn-primary btn-block"
                   value="Застосувати акційний шаблон" ng-click="sendFormPromotion('<?php echo $scenario ?>');"
                   ng-disabled="!paymentSchema.template"/>
        </div>
    </div>
</div>

