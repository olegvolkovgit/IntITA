<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:20
 */
?>
<img class="courseImg" style="display: inline-block" src="<?php echo StaticFilesHelper::createPath('image', 'course', $model->course_img);?>" />
<div class="courseShortInfoTable">
    <table>
        <tr>
            <td>
                <p><span class="colorP"><b><?php echo Yii::t('course', '0193'); ?></b></span>&nbsp;
                 <span class="courseLevel">
                    <?php
                    $rate = 0;
                    switch ($model->level){
                        case 'intern':
                            echo Yii::t('courses', '0232');
                            $rate = 1;
                            break;
                        case 'junior':
                            echo Yii::t('courses', '0233');
                            $rate = 2;
                            break;
                        case 'strong junior':
                            echo Yii::t('courses', '0234');
                            $rate = 3;
                            break;
                        case 'middle':
                            echo Yii::t('courses', '0235');
                            $rate = 4;
                            break;
                        case 'senior':
                            echo Yii::t('courses', '0236');
                            $rate = 5;
                            break;
                    }
                    ?>
                 </span>
                </p>
            </td>
            <td class="courseLevel">
                <div>
                <?php
                for ($i=0; $i<$rate; $i++)
                {
                    ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png');?>" >
                <?php
                }
                for ($j=$rate; $j<5; $j++)
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
        <div class="numbers"><span class="redStrike">43200.00 <?php echo Yii::t('module', '0222'); ?></span> <b>33000.00 <?php echo Yii::t('module', '0222'); ?></b> <span class="colorP">(<?php echo Yii::t('course', '0210'); ?> - 25%)</span></div>
        <div class="spoilerBody">
            <div><?php echo Yii::t('course', '0198'); ?></div>
            <div class="numbers"><span class="redStrike">43200.00 <?php echo Yii::t('module', '0222'); ?></span> <b>36000.00 <?php echo Yii::t('module', '0222'); ?>  =</b> 18000.00 х 2 <?php echo Yii::t('course', '0323'); ?> <?php echo Yii::t('module', '0222'); ?> <span class="colorP">(<?php echo Yii::t('course', '0210'); ?> - 8%)</span></div>
            <div><?php echo Yii::t('course', '0199'); ?></div>
            <div class="numbers"><span class="redStrike">43200.00 <?php echo Yii::t('module', '0222'); ?></span> <b>40000.00 <?php echo Yii::t('module', '0222'); ?>  =</b> 10000.00 х 4 <?php echo Yii::t('course', '0323'); ?> <?php echo Yii::t('module', '0222'); ?> <span class="colorP">(<?php echo Yii::t('course', '0210'); ?> - 9%)</span></div>
            <div><?php echo Yii::t('course', '0200'); ?></div>
            <div class="numbers"><span>3600.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 12 <?php echo Yii::t('course', '0323'); ?> <b>=  43200.00 <?php echo Yii::t('module', '0222'); ?></b></span></div>
            <div class="italic">
                <div><?php echo Yii::t('course', '0201'); ?></div>
                <div class="numbers"><span>2000.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 24 <?php echo Yii::t('course', '0324'); ?> <b>= 48000.00 <?php echo Yii::t('module', '0222'); ?></b></span></div>
                <div><?php echo Yii::t('course', '0325') ?></div>
                <div class="numbers"><span>1600.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 36 <?php echo Yii::t('course', '0324'); ?> <b>= 57600.00 <?php echo Yii::t('module', '0222'); ?></b></span></div>
                <div><?php echo Yii::t('course', '0326') ?></div>
                <div class="numbers"><span>1300.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 48 <?php echo Yii::t('course', '0324'); ?> <b>= 62400.00 <?php echo Yii::t('module', '0222'); ?></b></span></div>
                <div><?php echo Yii::t('course', '0327') ?></div>
                <div class="numbers"><span>1150.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 60 <?php echo Yii::t('course', '0324'); ?> <b>= 69000.00 <?php echo Yii::t('module', '0222'); ?></b></span></div>
            </div>
        </div>
        </br>
        <div class="markAndButton">
            <div class="markCourse">
                <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
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
                <?php echo CHtml::link(Yii::t('course', '0328'), '#'); ?>
            </div>
        </div>
    </div>
</div>
