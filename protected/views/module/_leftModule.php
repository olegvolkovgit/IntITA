<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:06
 */
?>
<div class="leftModule">
    <div class="headerLeftModule">
        <table>
            <tr>
                <td>
                    <img class="moduleImg" src="<?php echo StaticFilesHelper::createPath('image', 'module', $post->module_img);?>" />
                </td>
                <td style="padding-left: 15px;">

                    <span id="titleModule"><?php echo Yii::t('module', '0211'); ?></span>
                    <?php echo $post->module_name;?>
                    <div>
                        <span id="titleModule"><?php echo Yii::t('module', '0214'); ?></span>
                        <?php echo "сильний початківець"?>
                        <div class="ratico">
                            <?php
                            for ($i=0; $i<3; $i++)
                            {
                                ?><span>
                                <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>"/>
                                </span><?php
                            }
                            for ($i=0; $i<2; $i++)
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
                        <b> <?php echo $post->lesson_count." ".Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('module', '0217'); ?> - <b>2 <?php echo Yii::t('module', '0218'); ?></b> (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)
                    </div>
                    <div>
                        <span id="titleModule"><?php echo Yii::t('module', '0221'); ?></span>
                        <span id="oldPrice"> <?php echo $post->module_price; ?> <?php echo Yii::t('module', '0222'); ?></span> <?php echo ModuleHelper::getDiscountedPrice($post->module_price, 50).Yii::t('module', '0222'); ?> (<?php echo Yii::t('module', '0223'); ?>)
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
        <table>
            <tr>
                <td style="padding-left: 110px;">
                    <div id="enter_button_2" href="#" ><?php echo Yii::t('module', '0279');?></div>
                </td>
                <td style="padding-left: 100px;">
                    <div id="enter_button_2" href="#" ><?php echo Yii::t('module', '0280');?></div>
                </td>
            </tr>
        </table>
        <?php $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' =>$post));?>
    </div>
</div>