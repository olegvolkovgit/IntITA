<p class="tabHeader"><?php echo Yii::t('profile', '0110'); ?></p>

<!--<table class="timeTable">-->
<!--    <tr>-->
<!--        <td>-->
<!--            <div>--><?php //echo Yii::t('profile', '0126'); ?><!--</div>-->
<!--        </td>-->
<!--        <td>-->
<!--            <div>--><?php //echo Yii::t('profile', '0127'); ?><!--</div>-->
<!--        </td>-->
<!--        <td>-->
<!--            <div>--><?php //echo Yii::t('profile', '0128'); ?><!--</div>-->
<!--        </td>-->
<!--        <td>-->
<!--            <div>--><?php //echo Yii::t('profile', '0129'); ?><!--</div>-->
<!--        </td>-->
<!--        <td>-->
<!--            <div>--><?php //echo Yii::t('profile', '0130'); ?><!--</div>-->
<!--        </td>-->
<!--    </tr>-->
<!--        --><?php
//        $this->widget('zii.widgets.CListView', array(
//            'dataProvider'=>$dataProvider,
//            'itemView'=>'_lineconsultation',
//            'template'=>'{items}{pager}',
//            'pager' => array(
//                'firstPageLabel'=>'<<',
//                'lastPageLabel'=>'>>',
//                'header'=>'',
//            ),
//        ));
//        ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'consultation-grid',
        'dataProvider'=>$dataProvider,
//        'filter'=>$model,
        'summaryText' => '',
        'columns'=>array(
            array(
                'header'=>Yii::t('profile', '0126'),
                'value'=>'Yii::t(\'profile\', \'0132\')',
            ),
            array(
                'name'=>'date_cons',
                'header'=>Yii::t('profile', '0127'),
            ),
            array(
                'name'=>'start_cons',
                'header'=>Yii::t('profile', '0128'),
                'value'=>'date("H:i", strtotime($data->start_cons))."-".date("H:i", strtotime($data->end_cons))',
            ),
            array(
                'header'=>Yii::t('profile', '0129'),
                'value'=>'Teacher::model()->findByPk($data->teacher_id)->first_name." ".Teacher::model()->findByPk($data->teacher_id)->last_name',
            ),
            array(
                'header'=>Yii::t('profile', '0130'),
                'value'=>'Lecture::model()->findByPk($data->lecture_id)->title',
            ),
            array(
                'class'=>'CButtonColumn',
                'buttons'=>array
                (
                    'htmlOptions'=>array('display' => 'none'),
                    'delete' => array(
                        'url' => 'Yii::app()->createUrl("studentreg/deleteconsultation", array("id"=>$data->id))',
                        'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                        'label' => 'Відмінити консультацію',
                    ),
                ),
                'updateButtonOptions'=> array('style'=>'display:none'),
                'viewButtonOptions'=> array('style'=>'display:none'),
//                'deleteButtonOptions'=> array('style'=>'text-align:center;margin:0'),
            ),
        ),
    )); ?>
<!--</table>-->