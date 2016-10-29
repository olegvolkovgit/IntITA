<?php
/**
 * @var $aboutUsDataProvider CActiveDataProvider
 */
?>
<div class="mainAboutBlock">
    <div class="mainAbout">
        <div class="header">
            <?php echo Yii::t('mainpage','0002'); ?>
            <p>
                <?php echo Yii::t('mainpage', '0006'); ?>
            </p>
        </div>

        <div class="line1">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'line1.png');?>">
        </div>

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$aboutUsDataProvider,
            'itemView'=>'_aboutusBlock',
            'summaryText' => '',
        ));
        ?>
    </div>
</div>


