<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:36
 */
//echo $data;
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/loadRedactor.js"></script>
<div class="text" id="<?php echo $order;?>" onclick="loadRedactor('<?php echo '#'.$order?>')">
    <?php echo $data;?>
    <?php $idValue = "#" . $order?>
</div>

<script type="text/javascript">
    $(function()
    {
        $('<?php echo $idValue;?>').on('click', loadRedactor(<?php echo '#'.$order;?>));
    });
</script>