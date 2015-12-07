<?php

$footNavSize='960px'; // Ширина блоку
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonFooter.css'); ?>" />

<div class="subViewLessons" id="subViewLessons"	>
    <?php
    if (  $lecture->order > 1)
    {
        $prevId = LectureHelper::getPreId($lecture->order, $lecture->idModule);

        ?>
        <div class="preLessons">
            <p class="lesname"><?php echo Yii::t('lecture','0073'); ?> <?php echo ($lecture->order - 1); ?>: <b><?php echo LectureHelper::getLectureTitle($prevId); ?></b></p>
            <table class="typeLesson">
                <tr>
                    <td><p><?php echo Yii::t('lecture','0074'); ?></p></td>
                    <td><span><?php echo $lecture->getPreType()['text'] ?></span></td>
                    <td><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->getPreType()['image']); ?>" style="width:<?php echo $footNavSize*0.02 . 'px'; ?>"></td>
                    <td><p><?php echo Yii::t('lecture','0075'); ?></p></td>
                    <td><span><?php echo LectureHelper::getLectureDuration($prevId); ?></span></td>
                    <td><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>" style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
                </tr>
            </table>
            <table class="ratingLeson">

            </table>
            <div class="preLesonLink">
                <p><a href="<?php echo Yii::app()->createUrl('lesson/index', array('id' => $prevId, 'idCourse'=>$idCourse));?>">&#171 <?php echo Yii::t('lecture','0087'); ?></a></p>
            </div>
        </div>
    <?php
    }

    if ( $lecture->order < $lecture->getModuleInfoById($idCourse)['countLessons'])
    {
        $nextId = LectureHelper::getNextId($lecture['id']);
    ?>
    <div class="nextLessons">
        <p class="lesname"><?php echo Yii::t('lecture','0073'); ?> <?php echo $lecture->order+1 ?>: <b><?php echo LectureHelper::getLectureTitle($nextId); ?></b></p>
        <table class="typeLesson">
            <tr>
                <td><p><?php echo Yii::t('lecture','0074'); ?></td>
                <td><span><?php echo $lecture->getPostType()['text']; ?></span></td>
                <td><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->getPostType()['image']); ?>"style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
                <td><p><?php echo Yii::t('lecture','0075'); ?></p></td>
                <td><span><?php echo LectureHelper::getLectureDuration($nextId); ?></span></td>
                <td><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>" style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
            </tr>
        </table>
        <table class="ratingLeson">

        </table>
        <?php
        if($finishedLecture || $editMode || StudentReg::isAdmin()) { ?>
            <div class="nextLessonLink">
                <p><a href="<?php echo Yii::app()->createUrl('lesson/index', array('id' => $nextId, 'idCourse'=>$idCourse));?>"><input class="nextLessButt" type="submit" value="<?php echo Yii::t('lecture','0088'); ?>"></a></p>
            </div>
        <?php  }?>
    </div>

<?php
    }
?>
</div>

