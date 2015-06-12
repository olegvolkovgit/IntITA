<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 05.06.2015
 * Time: 10:23
 */
?>
<div class="moduleTitle">
    <h1>
        <?php echo $post->module_name;?>
    </h1>
</div>
<table>
    <tr>
        <td>
            <img class="moduleImg" src="<?php echo StaticFilesHelper::createPath('image', 'module', $post->module_img);?>" />
        </td>
        <td style="padding-left: 15px;">
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0214'); ?></span>
                <?php
                $rate = 0;
                switch ($post->level){
                    case 'intern':
                        $level=Yii::t('courses', '0232');
                        $rate = 1;
                        break;
                    case 'junior':
                        $level=Yii::t('courses', '0233');
                        $rate = 2;
                        break;
                    case 'strong junior':
                        $level=Yii::t('courses', '0234');
                        $rate = 3;
                        break;
                    case 'middle':
                        $level=Yii::t('courses', '0235');
                        $rate = 4;
                        break;
                    case 'senior':
                        $level=Yii::t('courses', '0236');
                        $rate = 5;
                        break;
                }
                if(isset($level))
                echo $level;
                ?>
                <div class="ratico">
                    <?php
                    for ($i=0; $i<$rate; $i++)
                    {
                        ?><span>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>"/>
                        </span><?php
                    }
                    for ($i=$rate; $i<5; $i++)
                    {
                        ?><span>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>"/>
                        </span><?php
                    }
                    ?>
                </div>
            </div>
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0215'); ?></span>
                <b> <?php echo $post->lesson_count." ".Yii::t('module', '0216'); ?></b><?php echo ModuleHelper::getModuleDuration($post->lesson_count,$post->module_duration_hours,$post->hours_in_day,$post->days_in_week) ?>
            </div>
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0221'); ?></span>
                <?php echo ModuleHelper::getModulePrice($post->module_price) ?>
            </div>
            </br>
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0224'); ?></span>
                <?php
                for ($i = 0; $i < 9; $i++) {
                    ?><span>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>">
                    </span><?php
                }
                for ($i = 0; $i < 1; $i++) {
                    ?><span>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>">
                    </span><?php
                }
                ?>
            </div>
        </td>
</tr>
</table>