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
        <div class="col-sm-8"> <h3>Список договорів</h3></div>
        <div class="col-sm-8">
            <table class="table table-bordered">
                <thead>
                <tr class="bg-primary">
                    <th class="glyphicon glyphicon-ok col-sm-1"></th>
                    <th class="col-sm-3">Номер договору</th>
                    <th class="col-sm-3">Дата</th>
                </tr>
                </thead>
                <tbody>
    <?php

    foreach($agreements as $agreement)
    {?>

<!--        <input type="radio" name="agreement" onchange="getInvoicesList()" value="--><?php //echo $agreement->id ?><!--">-->
<!--            Номер договору:  --><?php //echo $agreement->number; ?>
<!--            Дата: --><?php //echo $agreement->create_date ?>

          <tr>
            <td class="col-sm-1"><input type="radio" name="agreement"
               onchange="getInvoicesList('<?php echo Yii::app()->createUrl('/_accountancy/operation/getInvoicesList');?>')"
                                        value="<?php echo $agreement->id ?>"></td>
            <td class="col-sm-3"><?php echo $agreement->number; ?></td>
            <td class="col-sm-3"><?php echo $agreement->create_date ?></td>
          </tr>

<?php }?>
                </tbody>
            </table>
        </div>
    </fieldset>
<?php }
else
echo 'Рахунків не знайдено'
?>

