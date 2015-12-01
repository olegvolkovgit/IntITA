<?php
/* @var $this ConsultantController */


?>
<br>
<h1>Управління консультаціями</h1>
<p>
    <?php

    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'response-grid',
        'summaryText' => '',
        'dataProvider'=>$answer->search(),
        'filter'=>$answer,
        'columns'=>array(
            array(
                'name' => 'id_student',
                'header' => 'Від кого відповідь',
                'value' => '$data->getStudentName()',
            ),
            array(
                'header' => 'Умова задачі',
                'value' =>  'substr($data->getCondition(),0,30)',
            ),
            array(
                'name' => 'answer',
                'header' => 'Відповідь',
                'value' => '$data->answer',
            ),
            'date',
            array(
                'name' => 'consultant',
                'header' => 'Консультант',
                'value' => '$data->getConsultant()',
            ),


            array(
                'template'=>'{addConsult}',
                'class'=>'CButtonColumn',
                'buttons'=>array(
                'addConsult' => array
                    (
                        'label'=>'Додати консультанта',
                        'url' => 'Yii::app()->createUrl("/_admin/consultant/addConsult", array("idAnswer"=>$data->id))',
                        'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'plus.jpg'),
                        'options'=>array(
                            'class'=>'controlButtons;',
                        )
                    ),
                ),
            ),
        ),
    ));
    ?>

</p>

