<?php
$footNavSize='960px'; // Ширина блоку
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lessonFooter.css" />

<div class="subViewLessons" id="subViewLessons"	>
    <?php
    if (  $lecture->order > 1)
    {
        ?>
        <div class="preLessons">
            <p class="lesname"><?php echo Yii::t('lecture','0073'); ?> <?php echo ($lecture->order - 1); ?>: <b><?php echo $lecture->getPreName(); ?></b></p>
            <table class="typeLesson">
                <tr>
                    <td><p><?php echo Yii::t('lecture','0074'); ?></p></td>
                    <td><span><?php echo $lecture->getPreType()['text'] ?></span></td>
                    <td><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->getPreType()['image']); ?>" style="width:<?php echo $footNavSize*0.02 . 'px'; ?>"></td>
                    <td><p><?php echo Yii::t('lecture','0075'); ?></p></td>
                    <td><span><?php echo $lecture->getPreDur(); ?></span></td>
                    <td><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>" style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
                </tr>
            </table>
            <table class="ratingLeson">
                <tr>
                    <?php
                    for ($i=0; $i<$lecture->getPreRait(); $i++)
                    {
                        ?>
                        <td>	<img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>" style="width:<?php echo $footNavSize*0.015 . 'px';?>; padding:0px;"></td>
                    <?php
                    }
                    for ($j=0; $j<Lecture::MAX_RAIT-$lecture->getPreRait(); $j++)
                    {
                        ?>
                        <td>	<img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>" style="width:<?php echo $footNavSize*0.015 . 'px';?>; padding:0px;"></td>
                    <?php
                    }
                    ?>
                    <td><img src="<?php
                        if ($lecture->getPreMedal()=='Зараховано')
                        {
                            echo StaticFilesHelper::createPath('image', 'lecture', 'medalIco.png');
                        } else {
                            echo StaticFilesHelper::createPath('image', 'lecture', 'medalIcoFalse.png');
                        }
                        ?> " style="width:<?php echo $footNavSize*0.035 . 'px'; ?>"></td>
                </tr>
            </table>
            <div class="preLesonLink">
                <p><a href="<?php echo Yii::app()->createUrl('lesson/index', array('id' => $lecture->getPreId()));?>">&#171 <?php echo Yii::t('lecture','0087'); ?></a></p>
            </div>
        </div>
    <?php
    }
    if (  $lecture->order < $lecture->getModuleInfoById()['countLessons'])
    {
        ?>
        <div class="nextLessons">
            <p class="lesname"><?php echo Yii::t('lecture','0073'); ?> <?php echo $lecture->order+1 ?>: <b><?php echo $lecture->getPostName() ?></b></p>
            <table class="typeLesson">
                <tr>
                    <td><p><?php echo Yii::t('lecture','0074'); ?></td>
                    <td><span><?php echo $lecture->getPostType()['text']; ?></span></td>
                    <td><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->getPostType()['image']); ?>"style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
                    <td><p><?php echo Yii::t('lecture','0075'); ?></p></td>
                    <td><span><?php echo $lecture->getPostDur() ?></span></td>
                    <td><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>" style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
                </tr>
            </table>
            <table class="ratingLeson">
                <tr>
                    <?php
                    for ($i=0; $i<$lecture->getPostRait(); $i++)
                    {
                        ?>
                        <td>	<img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>" style="width:<?php echo $footNavSize*0.015 . 'px';?>; padding:0px;"></td>
                    <?php
                    }
                    for ($j=0; $j<Lecture::MAX_RAIT-$lecture->getPostRait(); $j++)
                    {
                        ?>
                        <td>	<img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>" style="width:<?php echo $footNavSize*0.015 . 'px';?>; padding:0px;"></td>
                    <?php
                    }
                    ?>
                    <td><img src="<?php
                        if ($lecture->getPostMedal()=='Зараховано')
                        {
                            echo StaticFilesHelper::createPath('image', 'lecture', 'medalIco.png');
                        } else {
                            echo StaticFilesHelper::createPath('image', 'lecture', 'medalIcoFalse.png');
                        }
                        ?> " style="width:<?php echo $footNavSize*0.035 . 'px';?>"></td>
                </tr>
            </table>
            <?php if($lecture->getThisMedal()=='Зараховано') { ?>
                <div class="nextLesonLink">
                    <p><a href="<?php echo Yii::app()->createUrl('lesson/index', array('id' => $lecture->getPostId()));?>"><input class="nextLessButt" type="submit" value="<?php echo Yii::t('lecture','0088'); ?>"></a></p>
                </div>

            <?php  }?>
        </div>

    <?php
    }
    ?>
</div>