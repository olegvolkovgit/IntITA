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
        'columns'=>array(
            array(
                'header'=>'Тип',
                'value'=>'"К"',
            ),
            array(
                'name'=>'date_cons',
                'header'=>'Дата',
            ),
            array(
                'name'=>'start_cons',
                'header'=>'Час',
                'value'=>'$data->start_cons."-".$data->end_cons',
            ),
//            array(
//                'header'=>'Викладач',
//                'value'=>'Teacher::model()->findByPk($data->teacher_id)->first_name." ".Teacher::model()->findByPk($data->teacher_id)->last_name',
//            ),
//            array(
//                'header'=>'Тема',
//                'value'=>'Lecture::model()->findByPk($data->lecture_id)->title',
//            ),
            array(
                'class'=>'CButtonColumn',
                'updateButtonOptions'=> array('style'=>'display:none'),
                'viewButtonOptions'=> array('style'=>'display:none'),
            ),
        ),
    )); ?>
<!--</table>-->