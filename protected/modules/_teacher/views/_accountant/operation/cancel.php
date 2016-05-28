<?php
if($operations)
{?>
    <br>
    <br>
    <div class="col-md-8">
    <table class="table table-striped">
    <tr>
        <td>Хто створив</td><td>Сума</td><td>Тип операції</td><td>Відмінити</td>
    </tr>
        <?php foreach($operations as $operation)
        {?>
            <tr>
                <td><?php echo $operation->findUser()?></td>
                <td><?php echo $operation->summa?></td>
                <td><?php echo OperationType::getDescription($operation->type_id)?></td>

            <td><a href="<?php echo Yii::app()->createUrl('/_teacher/_accountant/operation/deleteService',array('id' => $operation->id));?>">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" </a> </td>
            </tr>
        <?php } ?>

    </table>
    </div>
<?php }
else echo 'В данний момент немає проплат';
?>