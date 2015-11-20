<?php
/**
 * @var $agreement UserAgreements
 */
?>
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
            <span class="searchCriteria">
                <label for="numberCriteria">
                    <input type="checkbox" name="1" id="1"> Номер договора
                </label>
            </span>
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
            <br>

            <span class="searchCriteria">
                <label for="userCriteria">
                    <input type="checkbox" name="2" id="2">Користувач
                </label>
            </span>
            <select id="userCriteriaValue">
                <option value="">Виберіть користувача</option>
                <?php
                foreach ($agreementList as $agreement) {
                    ?>
                    <option value="<?php echo $agreement->id; ?>">
                        <?php echo StudentReg::getUserName($agreement->user_id); ?>
                    </option>
                <?php
                }
                ?>
            </select>
            <br>

            <span class="searchCriteria">
                 <label>
                    <input type="checkbox" name="3" id="3"> Курс
                 </label>
            </span>
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
            <br>

            <span class="searchCriteria">
                 <label>
                    <input type="checkbox" name="4" id="4"> Модуль
                 </label>
            </span>
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
            <br>
            <br>
            <input type="submit" value="Шукати" onclick="getAgreementsList()">
        </fieldset>
            </form>

        <!--Operation form-->
        <form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByAgreement'); ?>"
              method="POST" name="newOperation" class="formatted-form">
            <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
            <input type="number" name="type" value="1" hidden="hidden">
            <input type="number" name="source" value="1" hidden="hidden">
            <fieldset>
                <legend>Операція:</legend>
        Результати пошуку:
        <br/>
        <div id="searchResult">
            <input type="radio" name="agreement" value="245"><a href="#">Договір 245</a><br>
            <input type="radio" name="agreement" value="248"><a href="#">Договір 248</a>
        </div>
        <br/>
        <label> Введіть суму операції:
            <br/>
            <input type="number" name="summa" value=""/>
        </label>
        <br/>
            <br/>
        <button type="submit">Додати</button>
                </fieldset>
        </form>
    </div>


<script>
    function getAgreementsList(){
        number = "";
        user = "";
        course = "";
        module = "";
        if($('#1').prop('checked')) {
            number = $("#numberCriteriaValue option:selected").val();
        }
        if($('#2').prop('checked')) {
            user = $('#userCriteriaValue option:selected').val() ;
        }
        if($('#3').prop('checked')) {
            course = $('#courseCriteriaValue option:selected').val();
        }
        if($('#4').prop('checked')) {
            module = $('#moduleCriteriaValue option:selected').val();
        }
        $.ajax({
            type: "POST",
            url: "/IntITA/operation/getSearchAgreements",
            data: {
                'number': number,
                'user': user,
                'course': course,
                'module': module
            },
            cache: false,
            success: function (data) {
                alert(1);
                    alert(data);
            }
        });
    }
</script>