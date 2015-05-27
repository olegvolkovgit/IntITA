<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:20
 */
?>
<img class="courseImg" style="display: inline-block" src="<?php echo Yii::app()->request->baseUrl.$model->course_img ?>" />
<div class="courseShortInfoTable">
    <table class="courseLevelLine">
        <tr>
            <td>
                <p><span class="colorP"><b><?php echo Yii::t('course', '0193'); ?></b></span>&nbsp;<?php echo Yii::t('courses', '0234'); ?></p>

            </td>
            <td class="courseLevel">
                <?php
                for ($i=0; $i<3; $i++)
                {
                    ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png');?>" >
                <?php
                }
                for ($j=0; $j<2; $j++)
                {
                    ?>
                    <img src="<?php echo  StaticFilesHelper::createPath('image', 'common', 'ratIco0.png');?>" >
                <?php
                }
                ?>
            </td>
        </tr>
    </table>
    <div class="courseDetail">
        <div> <span class="colorP"><?php echo Yii::t('course', '0194'); ?> </span> <span class="colorGrey"><b><?php echo $model->course_duration_hours;?> <?php echo Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('course', '0209'); ?> - <b><?php echo ceil($model->course_duration_hours/36);?> <?php echo Yii::t('module', '0218'); ?></b> (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)</span></div>
        <div> <span class="colorP"><?php echo Yii::t('course', '0196'); ?> </span></div>
        <div id="spoilerPay">
            <div> <span> &nbsp;<?php echo Yii::t('course', '0197'); ?> </span> <span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> <b>16500.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 25%)</div>
            <div> <span> &nbsp;<?php echo Yii::t('course', '0198'); ?> </span> <span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> 9000.00 <?php echo Yii::t('module', '0222'); ?> х 2 проплати = <b>18000.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 8%)</div>
            <div> <span> &nbsp;<?php echo Yii::t('course', '0199'); ?> </span>  <span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> 5000.00 <?php echo Yii::t('module', '0222'); ?> х 4 проплати = <b>20000.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 9%)</div>
            <div> <span> &nbsp;<?php echo Yii::t('course', '0200'); ?> </span> <span>1000.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 24 проплати = <b>24000.00 <?php echo Yii::t('module', '0222'); ?>.</b></span></div>
            <div> <span> &nbsp;<?php echo Yii::t('course', '0201'); ?> </span> <span>800.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 36 проплат = <b>28800.00 <?php echo Yii::t('module', '0222'); ?></b>.</span></div>
        </div>
        <div> <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
                    <span>
                        <?php
                        for ($i=0; $i<10; $i++)
                        {
                            ?>
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>"/>
                        <?php
                        }
                        ?>
                    </span>
        </div>
    </div>
</div>
