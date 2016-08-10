<?php
/**
 * @var $post Module
 */
?>
<div class="moduleTitle">
    <h1>
        <?php echo $post->getTitle(); ?>
    </h1>
</div>
<table>
    <tr>
        <td>
            <img class="moduleImg"
                 src="<?php echo StaticFilesHelper::createPath('image', 'module', $post->module_img); ?>"/>
        </td>
        <td style="padding-left: 15px; border-left: 1px solid #cccccc;">
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0214'); ?></span>
                <?php
                $level = $post->level();
                $rate = $post->rate();
                if (isset($level)) echo $level;
                ?>
                <div class="ratico">
                    <?php
                    for ($i = 0; $i < $rate; $i++) {
                        ?><span>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>"/>
                        </span><?php
                    }
                    for ($i = $rate; $i < 5; $i++) {
                        ?><span>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>"/>
                        </span><?php
                    }
                    ?>
                </div>
            </div>
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0215'); ?></span>
                <b> <?php echo $post->getLecturesCount() . " " . Yii::t('module', '0216'); ?></b><?php
                if ($post->lesson_count != 0) {?>
                    <?=", " . Yii::t('module', '0217')?> - <b><?=$post->monthsCount() . " " . Yii::t('module', '0218');?></b> (
                <?=$post->hours_in_day . " " . Yii::t('module', '0219') . ", " . $post->days_in_week . " " .
                        Yii::t('module', '0220') . ")";
                }
                ?>
            </div>
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0893'); ?>: </span>
                <?php if ($post->status == Module::DEVELOP) { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'disabled.png'); ?>">
                    <?php echo Yii::t('courses', '0230');
                } else { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'enable.png'); ?>">
                    <?php echo Yii::t('courses', '0231');
                }
                ?>
            </div>
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0221'); ?></span>
                <?php
                $course = (!isset($_GET['idCourse']) || ($_GET['idCourse'] == 0)) ? 0 : $_GET['idCourse'];
                $this->renderPartial('_price', array('idCourse' => $course, 'model' => $post,'price'=>$price)); ?>
            </div>
            <br>

            <div class="moduleRating">
                <span id="titleModule"><?php echo Yii::t('module', '0224'); ?></span>
                <?php echo CommonHelper::getRating($post->rating); ?>
            </div>
        </td>
    </tr>
</table>