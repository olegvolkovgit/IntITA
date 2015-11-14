<?php
/**
 * @var $agreement UserAgreements
 */
?>
<h3>Договір:</h3>
<form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByAgreement');?>"
      method="POST" name="newOperation" class="formatted-form">
<div id="operationForm1">
    <input type="number" name="user" value="<?php echo Yii::app()->user->getId();?>" hidden="hidden">
    <input type="number" name="type" value="1" hidden="hidden">
    <label>Договір:
    <br/>
    <select name="agreement">
        <option value="">Виберіть договір</option>
            <?php
            $agreementList = UserAgreements::getAllAgreements();
            foreach($agreementList as $agreement){
                ?>
                <option value="<?php echo $agreement->id;?>"><?php echo $agreement->number.", (".
                        $agreement->user_id.", ".$agreement->summa.")";?></option>
            <?php
            }
            ?>
    </select>
    </label>
    <br/>
    <label> Введіть суму операції:
        <br/>
    <input type="number" name="summa" value="" />
    </label>
    <br/>
    <button type="submit">Додати</button>
</div>
</form>