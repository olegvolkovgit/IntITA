<div ng-controller="paymentsSchemaTemplateApplyCtrl">
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
            <a ng-href="#/accountant/paymentSchemas/schemas/appliedTemplates" class="btn btn-primary">
                Список застосованих шаблонів
            </a>
        </li>
    </ul>
    <div class="row m-b-20">
        <div class="col-md-10">
            <h4>Сервіси курсів:</h4>
            <span class="control-label">Шаблон схем по замовчуванню для курсів:</span>
            <b><?php echo PaymentScheme::model()->findByPk(PaymentScheme::DEFAULT_COURSE_SCHEME)->schemesTemplate->template_name ?></b>
        </div>
        <div class="col-md-10">
            <span class="control-label">Актуальний шаблон схем на всі курси:</span>
            <b><?php echo PaymentScheme::getCourseActualSchemeTemplate()->schemesTemplate->template_name; ?></b>
            <span class="control-label"><br>Діє до: <?php echo PaymentScheme::getCourseActualSchemeTemplate()->endDate ?></span>
        </div>
        <br>
        <div class="col-md-10">
            <h4>Сервіси модулів:</h4>
            <span class="control-label">Шаблон схем по замовчуванню для модулів:</span>
            <b><?php echo PaymentScheme::model()->findByPk(PaymentScheme::DEFAULT_MODULE_SCHEME)->schemesTemplate->template_name ?></b>
        </div>
        <div class="col-md-10">
            <span class="control-label">Актуальний шаблон схем на всі модулі:</span>
            <b><?php echo PaymentScheme::getModuleActualSchemeTemplate()->schemesTemplate->template_name; ?></b>
            <span class="control-label"><br>Діє до: <?php echo PaymentScheme::getModuleActualSchemeTemplate()->endDate ?></span>
        </div>
    </div>
    <div class="row m-b-20">
        <div class="col-md-4">
            <span class="control-label">Шаблон схем*</span>
        </div>
        <div class="col-md-8">
            <select
                required="required"
                class="form-control"
                ng-model="paymentSchema.template"
                ng-options="template as template.template_name for template in templates">
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
    <!--user typeahead -->
    <div class="row m-b-20">
        <div class="col-md-4">
            <span class="control-label">Користувач</span>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <span ng-show="!user.loading && !noResultsStudent" class="input-group-addon">
                    <i class="glyphicon glyphicon-pencil"></i>
                </span>
                <span ng-show="user.loading" class="input-group-addon">
                    <i class="glyphicon glyphicon-refresh"></i>
                </span>
                <span ng-show="noResultsStudent" class="input-group-addon">
                    <i class="glyphicon glyphicon-remove"></i>
                </span>
                <input ng-disabled="!paymentSchema.template" type="text" name="student" size="50" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                       placeholder="Користувач" uib-typeahead="item.email for item in getUsers($viewValue) | limitTo : 10"
                       typeahead-loading="user.loading"
                       typeahead-no-results="noResultsStudent"  typeahead-template-url="customTemplate.html"
                       typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control"/>
            </div>
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

    <div class="row m-b-20">
        <div class="col-md-4">
            <span class="control-label">Дати початку і завершення</span>
        </div>
        <div class="col-md-4">
            <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default" ng-click="startDateOptions.open()"><i
                        class="glyphicon glyphicon-calendar"></i></span>
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
                <span class="btn btn-default" ng-click="endDateOptions.open()"><i
                        class="glyphicon glyphicon-calendar"></i></span>
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
            <input type="button" class="btn btn-primary btn-block" value="Застосувати шаблон" ng-click="applyTemplate()" ng-disabled="!paymentSchema.template"/>
        </div>
    </div>
    <div style="border-radius: 5px; border:1px solid #ccc;padding: 5px">
        <em>
            *Якщо застосувати шаблон схем без вибору користувача, курсу та модуля - буде замінено стандартний шаблон схем на вибраний.<br>
            Якщо застосувати шаблон схем до конкретного користувача без вибору курса або модуля - буде застосовано цей шаблон до усіх курсів та модулів
            для цього користувача.
            Якщо застосувати шаблон схем до курсу або модуля - шаблон схем буде діяти для вибраного курсу або модуля.
            <br>
            Приорітет відображення схем для користувача:
            <br>
            <b>1.Індивідуальні схеми на конкретний курс/модуль 2.Індивідуальні схеми на всі курси/модулі 3.Схеми на конкретний курс/модуль 4.Схеми за замовчуванням</b>
        </em>
    </div>
    <pre>{{paymentSchema}}</pre>
</div>

