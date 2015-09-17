<p class="tabHeader"><?php echo Yii::t('profile', '0110'); ?></p>
<table class="exmCons">
    <tr>
        <td>
            <img src="<?php echo StaticFilesHelper::createImagePath('lecture', 'exam.png');?>"/>
        </td>
        <td>
            <span class='selectedTab' onclick="changeTabs(this)"><?php echo Yii::t('profile', '0111'); ?></span>
        </td>
        <td>
            <img src="<?php echo StaticFilesHelper::createImagePath('lecture', 'consultation.png');?>"/>
        </td>
        <td>
            <span class='selectedTab' onclick="changeTabs(this)"><?php echo Yii::t('profile', '0110'); ?></span>
        </td>
        <td>
            <img src="<?php echo StaticFilesHelper::createImagePath('lecture', 'imp.png');?>"/>
        </td>
        <td>
            <span class='selectedTab' onclick="changeTabs(this)"><?php echo Yii::t('profile', '0124'); ?></span>
        </td>
        <td>
            <img src="<?php echo StaticFilesHelper::createImagePath('lecture', 'kdp.png');?>"/>
        </td>
        <td>
            <span class='selectedTab' onclick="changeTabs(this)"><?php echo Yii::t('profile', '0125'); ?></span>
        </td>
    </tr>
</table>
<?php
$alert = 'Ви впевнені, що хочите відмінити консультацію?';
?>
<div class="consult">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'consultation-grid',
        'dataProvider'=>$dataProvider,
        'emptyText' => 'Запланованих консультацій немає.',
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
                'header'=>ConsultationsHelper::getUserTitle($user->id),
                'value'=>'ConsultationsHelper::getUserName(' . $user->id . ',$data)',
            ),
            array(
                'header'=>Yii::t('profile', '0130'),
                'value'=>'ConsultationsHelper::getTheme($data)',
            ),
            array(
                'class'=>'CButtonColumn',
                'headerHtmlOptions'=>array('style'=>'width:20px;'),
                'htmlOptions' => array('style'=>'width:20px'),
                'buttons'=>array
                (
                    'htmlOptions'=>array('display' => 'none'),
                    'delete' => array(
                        'url' => 'Yii::app()->createUrl("consultationscalendar/deleteconsultation", array("id"=>$data->id))',
                        'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                        'label' => 'Відмінити консультацію',
                    ),
                ),
                'updateButtonOptions'=> array('style'=>'display:none'),
                'viewButtonOptions'=> array('style'=>'display:none'),
                'deleteConfirmation'=>$alert,
            ),
        ),
    )); ?>
</div>
<script>
    function changeTabs(n){
        if (n.innerHTML=="<?php echo Yii::t('profile', '0111'); ?>"){
            $('.exm').toggle('fast');
            if(n.className=='selectedTab')
                n.className='unselectedTab';
            else n.className='selectedTab';
        }

        if (n.innerHTML=="<?php echo Yii::t('profile', '0110'); ?>"){
            $('.consult').toggle('fast');
            if(n.className=='selectedTab')
                n.className='unselectedTab';
            else n.className='selectedTab';
        }

        if (n.innerHTML=="<?php echo Yii::t('profile', '0124'); ?>"){
            $('.imp').toggle('fast');
            if(n.className=='selectedTab')
                n.className='unselectedTab';
            else n.className='selectedTab';
        }

        if (n.innerHTML=="<?php echo Yii::t('profile', '0125'); ?>"){
            $('.kdp').toggle('fast');
            if(n.className=='selectedTab')
                n.className='unselectedTab';
            else n.className='selectedTab';
        }
    }
</script>