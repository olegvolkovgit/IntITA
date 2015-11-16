<?php
/**
 * @var $agreement UserAgreements
 */
?>
<h3>Договір:</h3>
    <div id="operationForm1">
        <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
        <input type="number" name="type" value="1" hidden="hidden">
        <!--Search form by agreement criteria-->
        <form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByAgreement'); ?>"
              method="POST" name="newOperation" class="formatted-form">
        <fieldset form="newOperation" title="Пошук договора">
            <legend>Пошук договора за критеріями:</legend>
            <br>
            Виберіть критерії пошуку:
            <br>
            <span class="searchCriteria">
                <label for="numberCriteria">
                    <input type="checkbox" name="numberCriteria" checked> Номер договора
                </label>
            </span>
            <select name="numberCriteriaValue">
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
                    <input type="checkbox" name="userCriteria">Користувач
                </label>
            </span>
            <select name="userCriteriaValue">
                <option value="">Виберіть користувача</option>
                <?php
                $agreementList = UserAgreements::getAllAgreements();
                foreach ($agreementList as $agreement) {
                    ?>
                    <option value="<?php echo $agreement->id; ?>"><?php echo $agreement->user_id; ?></option>
                <?php
                }
                ?>
            </select>
            <br>

            <span class="searchCriteria">
                 <label>
                    <input type="checkbox" name="courseCriteria"> Курс
                 </label>
            </span>
            <select name="courseCriteriaValue">
                <option value="">Виберіть курс</option>
                <?php
                $agreementList = UserAgreements::getAllAgreements();
                foreach ($agreementList as $agreement) {
                    ?>
                    <option value="<?php echo $agreement->id; ?>"><?php echo $agreement->user_id; ?></option>
                <?php
                }
                ?>
            </select>
            <br>

            <span class="searchCriteria">
                 <label>
                    <input type="checkbox" name="moduleCriteria"> Модуль
                 </label>
            </span>
            <select name="moduleCriteriaValue">
                <option value="">Виберіть модуль</option>
                <?php
                $agreementList = UserAgreements::getAllAgreements();
                foreach ($agreementList as $agreement) {
                    ?>
                    <option value="<?php echo $agreement->id; ?>"><?php echo $agreement->user_id; ?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <br>
            <input type="submit" value="Шукати">
        </fieldset>
            </form>

        <!--Operation form-->
        <form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByAgreement'); ?>"
              method="POST" name="newOperation" class="formatted-form">
            <fieldset>
                <legend>Операція:</legend>
        Результати пошуку:
        <br/>
        <div id="searchResult"></div>
        <br/>
        <label> Введіть суму операції:
            <br/>
            <input type="number" name="summa" value=""/>
        </label>
        <br/>
            <br/>
        <button type="submit">Додати</button>
                </fieldset>
    </div>
</form>