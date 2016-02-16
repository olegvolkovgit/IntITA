<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 08.12.2015
 * Time: 15:46
 */
if($operations)
{?>
    <br>
    <br>
    <div class="col-md-8">
    <table class="table table-striped">
    <tr>
        <td>Хто створив</td><td>Сумма</td><td>Тип операції</td><td>Відмінити</td>
    </tr>
        <?php foreach($operations as $operation)
        {?>
            <tr>
                <td><?php echo $operation->findUser()?></td>
                <td><?php echo $operation->summa?></td>
                <td><?php echo OperationType::getDescription($operation->type_id)?></td>

            <td><a href="<?php echo Yii::app()->createUrl('/_accountancy/operation/deleteService',array('id' => $operation->id));?>">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" </a> </td>
            </tr>
        <?php } ?>

    </table>
    </div>
<?php }
else echo 'В данний момент немає проплат';
?>