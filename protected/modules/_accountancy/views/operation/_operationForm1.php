<?php
/**
 * @var $agreement UserAgreements
 */
?>
<label for="operation2a_1"><?php echo OperationType::getDescription(1);?></label>

<h3>Договір:</h3>
    <div id="operationForm1">
        <!--Search form by agreement criteria-->
        <form method="POST" name="newOperation" class="formatted-form" action="#"
        <?php //echo Yii::app()->createUrl('/_accountancy/operation/getSearchAgreements');?>>
        <fieldset form="newOperation" title="Пошук договора">
            <legend>Пошук договора за критеріями:</legend>
            <br>
            Виберіть критерії пошуку:
            <br>
<!--            <div class="operationLabel">-->
            <span class="searchCriteria">
                <label for="numberCriteria">
                    <input type="radio" name="find"  onclick="showList(1)"> Номер договора
                </label>
            </span>
<!--            </div>-->
            <div class="list" id="1">
                <select id="numberCriteriaValue">
                    <option value="">Виберіть номер договора</option>
                    <?php
                    $agreementList = UserAgreements::getAllAgreements();
                    foreach ($agreementList as $agreement) {
                        ?>
                        <option value="<?php echo $agreement->id; ?>"><?php echo $agreement->number; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>
<!--            <div class="operationLabel">-->
            <span class="searchCriteria">
                <label for="userCriteria">
                    <input type="radio" name="find"  onclick="showList(2)">Користувач
                </label>
            </span>
<!--            </div>-->
            <div class="list" id="2">
            <select id="userCriteriaValue">
                    <option value="">Виберіть користувача</option>
                    <?php
                    foreach ($agreementList as $agreement) {
                        ?>
                        <option value="<?php echo $agreement->id; ?>">
    <!--                        --><?php //echo StudentReg::getUserName($agreement->user_id); ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>
<!--            <div class="operationLabel">-->
            <span class="searchCriteria">
                 <label>
                    <input type="radio" name="find"  onclick="showList(3)"> Курс
                 </label>
            </span>
<!--            </div>-->
            <div class="list" id="3">
                <select id="courseCriteriaValue">
                    <option value="">Виберіть курс</option>
                    <?php
                    $coursesList = CourseService::getAllCoursesList();
                    foreach ($coursesList as $courseService) {
                        ?>
                        <option value="<?php echo $courseService->course_id; ?>">
                            <?php echo CourseHelper::getCourseName($courseService->course_id); ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>
<!--            <div class="operationLabel">-->
            <span class="searchCriteria">
                 <label>
                    <input type="radio" name="find" onclick="showList(4)"> Модуль
                 </label>
            </span>
<!--            </div>-->
            <div class="list" id="4">
                <select id="moduleCriteriaValue">
                    <option value="">Виберіть модуль</option>
                    <?php
                    $modulesList = ModuleService::getAllModulesList();
                    foreach ($modulesList as $moduleService) {
                        ?>
                        <option value="<?php echo $moduleService->module_id; ?>">
                            <?php echo ModuleHelper::getModuleName($moduleService->module_id); ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>
            <br>
            <input type="button" value="Шукати" onclick="getAgreementsList()">
        </fieldset>
            </form>

        <div name="selectAgreement" >
            <?php $this->renderPartial('_ajaxAgreement', array('agreements'=>'')); ?>
        </div>

        <!--Operation form-->
        <form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByAgreement'); ?>"
              method="POST" name="newOperation" class="formatted-form" onsubmit="return checkInvoices();">
            <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
            <input type="number" name="type" value="1" hidden="hidden">
            <input type="number" name="source" value="1" hidden="hidden">
            <fieldset>
                <legend>Операція:</legend>
        Результати пошуку:
        <br/>
                <div name="selectInvoices" id="selectInvoices">
                    <?php $this->renderPartial('_ajaxInvoices', array('invoices'=>'')); ?>
                </div>
        <br/>
        <label> Введіть суму операції:
            <br/>
            <input type="number" name="summa" value="" required="true"/>
        </label>
        <br/>
            <br/>
        <button type="submit">Додати</button>
                </fieldset>
        </form>
    </div>



