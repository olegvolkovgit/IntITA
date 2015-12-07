<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 20.11.2015
 * Time: 14:58
 */
if(!empty($agreements)){
    ?>
    <fieldset form="newOperation" class="ajax-formatted-form" title="Список договорів">
        Список договорів
    <?php

    foreach($agreements as $agreement)
    {?>
        <div>
        <input type="radio" name="agreement" onchange="getInvoicesList()"
               value="<?php echo $agreement->id ?>"> Номер договору :  <?php echo $agreement->number ?>
        Дата створення : <?php echo $agreement->create_date ?>
        </div>
<?php }?>

    </fieldset>
<?php }
else
echo 'Рахунків не знайдено'
?>

