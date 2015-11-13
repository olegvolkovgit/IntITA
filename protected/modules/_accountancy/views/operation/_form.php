<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $type OperationType*/
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/formattedForm.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/operation.css"/>

<div class="notebook2">
    <input type="radio" name="notebook2a" id="notebook2a_1" checked="checked">
    <input type="radio" name="notebook2a" id="notebook2a_2">
    <input type="radio" name="notebook2a" id="notebook2a_3">
    <input type="radio" name="notebook2a" id="notebook2a_4">

    <div>
        <label for="notebook2a_1">Оплата по договору</label>
        <?php echo $this->renderPartial('_operationForm1');?>
    </div>
    <div>
        <label for="notebook2a_2">Оплата по счету</label>
        <?php echo $this->renderPartial('_operationForm2');?>
    </div>
    <div>
        <label for="notebook2a_3">Оплата по</label>
    </div>
</div>
<br>
<br>

<script>
    $(document).ready(function(){
        $('#type').change(function(){
            type = $('#type option:selected').val();
            id = 'operationForm' + type;
            document.getElementById(id).style.display = 'block';
        });
    });
    function getOperationForm(type){
        $.ajax({
            type: "POST",
            url: "/IntITA/_accountancy/operation/getForm",
            data: {
                'type': type
            },
            cache: false,
            success: function (data) {
                 $("#operationForm").text(data);
            }
        });
    }
</script>
