<?php
/**
 * @var $data PayModules
 * @var $module Module
 */
$module = $data->module;
?>
<div class="courseData">
    <?php if($module->cancelled==Module::DELETED) { ?>
        <span>
            <?php echo $module->getTitle().'('.Yii::t('course', '0741').')' ?>
        </span>
    <?php } else { ?>
        <a class="coursename" href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $module->module_ID)); ?>">
            <?php echo $module->getTitle(); ?>
        </a>
    <?php } ?>
    <p class="courseLevLang"><?php echo Yii::t('module', '0214'); ?> <span class="colorP"><?php echo $module->level(); ?></span></p>
    <p class="courseLevLang"><?php echo Yii::t('course', '0400'); ?>: <span class="colorP"><?php echo $module->language; ?></span></p>
</div>