<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 21.11.2015
 * Time: 10:23
 */
if(!empty($invoices)){
    ?>
       Список рахунків-фактур
        <?php

        foreach($invoices as $invoice)
        {?>
            <div>
                <input type="checkbox" name="invoices[]"   value="<?php echo $invoice->id ?>"> Ким :<?php echo $invoice->getUsername() ?>
                Пояснення : <?php echo $invoice->getServiceDescription() ?>
                Дата створення : <?php echo date("d.m.y", strtotime($invoice->date_created))  ?>
            </div>
        <?php }?>

<?php } ?>