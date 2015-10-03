<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 06.09.2015
 * Time: 18:12
 */
?>
<?php if(!isset($editMode)) $editMode=1; ?>
<span class="listTheme"><?php echo Yii::t('lecture', '0321');?> </span><span class="spoilerLinks" onclick="chapterSpoiler(this,'<?php echo Yii::t('lecture', '0641') ?>','<?php echo Yii::t('lecture', '0642') ?>');"><span class="spoilerClick" ><?php echo Yii::t('lecture', '0641') ?></span><span class="spoilerTriangle"> &#9660;</span></span>
<div class="spoilerBody">
    <?php

    $summary =  Lecture::getLessonCont($idLecture);

    for($i=0; $i<count($summary);$i++){
        ?>
        <p>
            <a href="<?php $args = $_GET;

            $args['page'] = $passedPages[$i]['order'];
            $args['idCourse'] = ($idCourse)?$idCourse:'0';
            echo $this->createUrl('', $args);?>" class="<?php if($passedPages[$i]['isDone'] || $editMode) echo 'pageAccess' ?>"
               title="<?php echo Yii::t('lecture', '0615')." ".$passedPages[$i]['order'].'. '.strip_tags($summary[$i]);?>">
                <?php echo Yii::t('lecture', '0615')." ".$passedPages[$i]['order'].'. '.strip_tags($summary[$i]);?>
            </a>
        </p>
        <?php
    }

    ?>
</div>
<!-- Spoiler -->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'chaptersSpoiler.js'); ?>"></script>
<!-- Spoiler -->