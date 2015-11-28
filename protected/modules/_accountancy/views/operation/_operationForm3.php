<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 23.11.2015
 * Time: 16:34
 */
?>
<label for="operation2a_1" class="operationMargin"><?php echo OperationType::getDescription(1);?></label>

<h3 class="operationMargin">Користувач:</h3>
<div id="operationForm3">
    <!--Search form by agreement criteria-->
    <form method="POST" name="newOperation" class="formatted-form">
        <fieldset form="newOperation" title="Пошук договора">
            <legend>Пошук рахунку по користувачу:</legend>
            <br>
            Введіть e-mail користувача:
            <br>

            <span class="searchCriteria">
                <label for="numberCriteria">
                    <input type="text" name="userEmail" id="userEmail" onkeyup="getUserList()">
                </label>
            </span>
        </fieldset>
    </form>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <div name="userList" id="userList" >
        <?php $this->renderPartial('_ajaxUser', array('users'=>'')); ?>
    </div>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <div name="userAgreement" id="userAgreement" >
        <?php $this->renderPartial('_ajaxAgreement', array('agreements'=>'')); ?>
    </div>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <!--Operation form-->
    <form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByInvoice'); ?>"
          method="POST" name="newOperation" class="formatted-form" onsubmit="return checkInvoices();">
        <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
        <input type="number" name="type" value="1" hidden="hidden">
        <input type="number" name="source" value="1" hidden="hidden">
        <fieldset>
            Результати пошуку:
            <br/>
            <div name="selectUserInvoices" id="selectUserInvoices">
                <?php $this->renderPartial('_ajaxInvoices', array('invoices'=>'')); ?>
            </div>
            <br/>
            <label> Введіть суму оплати:
                <br/>
                <input type="number" name="user" value="<?php echo Yii::app()->user->getId();?>" hidden="hidden">
                <input type="number" name="type" value="1" hidden="hidden">
                <input type="number" name="source" value="1" hidden="hidden">
                <input type="number" name="summa" value="" required="true"/>
            </label>
            <br/>
            <br/>
            <button type="submit">Додати</button>
        </fieldset>
    </form>
</div>
