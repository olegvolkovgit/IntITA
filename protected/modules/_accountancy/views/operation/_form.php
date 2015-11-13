<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $type OperationType*/
/* @var $form CActiveForm */

?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/formattedForm.css"/>
    <div id="newOperation">
        <br>
        <form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/create');?>"
              method="POST" name="newOperation" class="formatted-form">
            <fieldset>
                <legend id="label">Нова операція:</legend>
                Тип операції:<br>
                <select name="type" id="type" autofocus onchange="selectType()">
                    <?php
                    $listValues = OperationType::getTypesList();
                    foreach($listValues as $type){
                        ?>
                        <option value="<?php echo $type->id;?>"><?php echo $type->description;?></option>
                    <?php
                     }
                    ?>
                </select>
                <br>
                <br>
<!--                <select name="course1" placeholder="(Виберіть курс)" onchange="selectModule1();">-->
<!--                    <option value="">Всі курси</option>-->
<!--                    <optgroup label="Виберіть курс">-->
<!--                        --><?php //$courses = AccessHelper::generateCoursesList();
//                        $count = count($courses);
//                        for($i = 0; $i < $count; $i++){
//                            ?>
<!--                            <option value="--><?php //echo $courses[$i]['id'];?><!--">-->
<!--                                --><?php //echo $courses[$i]['alias']." (".$courses[$i]['language'].")";?>
<!--                            </option>-->
<!--                        --><?php
//                        }
//                        ?>
<!--                </select>-->
<!--                <br>-->
<!--                <br>-->
<!---->
<!--                Модуль:<br>-->
<!--                <div name="selectModule1" style="float:left;"></div>-->
<!--                <br>-->
<!--                <br>-->

                <input type="submit" value="Додати">
        </form>
    </div>

<!--    <div class="row">-->
<!--        --><?php //echo $form->labelEx($model,'type_id'); ?>
<!--        --><?php //echo $form->dropDownList($model, 'type_id', $listValues);?>
<!--        --><?php //echo $form->error($model,'type_id'); ?>
<!--    </div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'invoice_id'); ?>
<!--		--><?php //echo $form->textField($model,'invoice_id'); ?>
<!--		--><?php //echo $form->error($model,'invoice_id'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'summa'); ?>
<!--		--><?php //echo $form->textField($model,'summa',array('size'=>10,'maxlength'=>10)); ?>
<!--		--><?php //echo $form->error($model,'summa'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row buttons">-->
<!--		--><?php //echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
<!--	</div>-->

<script>
    function selectType(){
        $( "#type" ).click(function() {
            $("#type:checked").val();
        });
    }
</script>
