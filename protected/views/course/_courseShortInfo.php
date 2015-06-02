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
    <table>
        <tr>
            <td>
                <p><span class="colorP"><b><?php echo Yii::t('course', '0193'); ?></b></span>&nbsp;<?php echo Yii::t('courses', '0234'); ?></p>
            </td>
            <td class="courseLevel">
                <div>
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
                </div>
            </td>
        </tr>
    </table>
    <div class="courseDetail">
        <div class="colorP"><?php echo Yii::t('course', '0194'); ?></div>
        <div><b><?php echo $model->course_duration_hours;?> <?php echo Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('course', '0209'); ?> - <b><?php echo ceil($model->course_duration_hours/36);?> <?php echo Yii::t('module', '0218'); ?></b> (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)</div>

        </span><span class="spoilerLinks"><span class="spoilerClick">Розгорнути схеми проплат</span><span class="spoilerTriangle"> &#9660;</span></span>
        <div><?php echo Yii::t('course', '0197'); ?></div>
        <div class="numbers"><span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> <b>16500.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 25%)</div>
        <div class="spoilerBody">
            <div><?php echo Yii::t('course', '0198'); ?></div>
            <div class="numbers"><span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> 9000.00 <?php echo Yii::t('module', '0222'); ?> х 2 проплати = <b>18000.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 8%)</div>
            <div><?php echo Yii::t('course', '0199'); ?></div>
            <div class="numbers"><span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> 5000.00 <?php echo Yii::t('module', '0222'); ?> х 4 проплати = <b>20000.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 9%)</div>
            <div><?php echo Yii::t('course', '0200'); ?></div>
            <div class="numbers"><span>1000.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 24 проплати = <b>24000.00 <?php echo Yii::t('module', '0222'); ?>.</b></span></div>
            <div><?php echo Yii::t('course', '0201'); ?></div>
            <div class="numbers"><span>800.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 36 проплат = <b>28800.00 <?php echo Yii::t('module', '0222'); ?></b>.</span></div>
        </div>
        </br>
        <div>
            <div class="markCourse"> <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
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
            <div class="startCourse">
                <?php $labelButton = 'ПОЧАТИ КУРС />'?>
                <?php echo CHtml::link($labelButton, '#'); ?>
            </div>
        </div>
    </div>
</div>
