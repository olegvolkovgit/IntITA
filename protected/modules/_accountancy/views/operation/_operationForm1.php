<?php
/**
 * @var $agreement UserAgreements
 */
?>
<h3>Договір:</h3>
<form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByAgreement');?>"
      method="POST" name="newOperation" class="formatted-form">
<div id="operationForm1">
    <select name="agreement">
        <option value="">Виберіть договір</option>
            <?php
            $agreementList = UserAgreements::getAllAgreements();
            foreach($agreementList as $agreement){
                ?>
                <option value="<?php echo $agreement->id;?>"><?php echo $agreement->number;?></option>
            <?php
            }
            ?>
    </select>
    <br/>
    <br/>
    <button type="submit">Додати</button>
</div>
</form>