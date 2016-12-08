<?php
/* @var $level string
 * @var $title string
 */
?>
<?php foreach ($modules as $module){
    $moduleTitle=$module[$title]==""?$module['title_ua']:$module[$title];
    ?>
<div class="courseData">
    <?php if($module['cancelled']==Module::DELETED) { ?>
        <span>
            <?php echo $moduleTitle.'('.Yii::t('course', '0741').')' ?>
        </span>
    <?php } else { ?>
        <a class="coursename" href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $module['id'])); ?>">
            <?php echo $moduleTitle; ?>
        </a>
    <?php } ?>
    <p class="courseLevLang"><?php echo Yii::t('module', '0214'); ?> <span class="colorP"><?php echo $module[$level]; ?></span></p>
    <p class="courseLevLang"><?php echo Yii::t('course', '0400'); ?>: <span class="colorP"><?php echo $module['lang']; ?></span></p>
</div>
<?php } ?>