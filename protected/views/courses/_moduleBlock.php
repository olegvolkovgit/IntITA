<?php
/**
 * @var $data Module
 */
?>
<?php $price = $data->modulePrice(); ?>
<?php if($index==0){ ?>
    <div id="miniConcept">
        <?php $this->renderPartial('_conceptBlock'); ?>
    </div>
<?php } ?>
<?php if($index==1){ ?>
    <div id="largeConcept">
        <?php $this->renderPartial('_conceptBlock'); ?>
    </div>
<?php } ?>
<div class='courseBox'>
    <div class="displayMini">
        <img class="courseLogo" src='<?php echo StaticFilesHelper::createPath('image', 'module', $data->module_img); ?>'>
        <div class='courseNameMini'><a
                href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $data->module_ID)); ?>"><?php
                echo $data->getTitle(); ?></a>
        </div>
    </div>
    <div class="courseInfo">
        <div class='courseName'><a
                href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $data->module_ID)); ?>"><?php
                echo $data->getTitle(); ?></a>
        </div>
        <!--Рівень модуля-->
        <div class="courseLevelBox">
            <?php echo Yii::t('module', '0214'); ?>
            <span class="courseLevel">
                <?php echo $data->level(); ?>
            </span>
            <div class='courseLevelIndex'>
                <?php $rate = $data->rate();
                for ($i = 0; $i < $rate; $i++) {?>
                    <span class="courseLevelImage">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>">
                    </span>
                <?php } for ($i = $rate; $i < Course::MAX_LEVEL; $i++) { ?>
                    <span class="courseLevelImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>">
                    </span>
                <?php } ?>
            </div>
        </div>
        <!--Стан модуля-->
        <div class="courseStatusBox">
            <?php echo Yii::t('courses', '0094'); ?>
            <span id="courseStatus<?php echo $data->status_online; ?>">
                <?php if ($data->status_online == Module::DEVELOP) { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'disabled.png'); ?>">
                    <?php echo Yii::t('courses', '0230');
                } else { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'enable.png'); ?>">
                    <?php echo Yii::t('courses', '0231');
                } ?>
            </span>
        </div>
        <div class="courseStatusBox">
            <?php echo Yii::t('courses', '0944'); ?>:
            <span id="courseStatus<?php echo $data->status_offline; ?>">
                <?php if ($data->status_offline == Module::DEVELOP) { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'disabled.png'); ?>">
                    <?php echo Yii::t('courses', '0230');
                } else { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'enable.png'); ?>">
                    <?php echo Yii::t('courses', '0231');
                } ?>
            </span>
        </div>
        <div class="courseLang">
            <?php echo Yii::t('course', '0400'); ?>:
            <a id="coursesLangs" href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $data->module_ID)); ?>">
                <?php echo $data->language; ?>
            </a>
        </div>
        <div class="coursePriceBox">
            <span id="titleModule"><?php echo Yii::t('module', '0221'); ?></span>
            <?php $this->renderPartial('/courses/_modulePrice', array('price'=>$price)); ?>
        </div>
        <div class="moduleRating">
            <span id="titleModule"><?php echo Yii::t('module', '0224'); ?></span>
            <?php echo CommonHelper::getRating($data->getAverageRating()); ?>
        </div>
    </div>
</div>