<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 09.04.2015
 * Time: 15:45
 */
//Загальні параметри блоку
$footNavSize='960px'; // Ширина блоку
$footNavMaxMark='6'; // Шкала оцінювання - максимальна кількість балів, поділок
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lessonFooter.css" />

<div class="subViewLessons" id="subViewLessons"	style="width:<?php echo $footNavSize; ?>" >
    <?php
    if (  $lecture->getPre()=='True' )
    {
        ?>
        <div class="preLessons">
            <p class="lesname"><?php echo Yii::t('lecture','0073'); ?> <?php echo $lecture->getPreNumber() ?>: <b><?php echo $lecture->getPreName() ?></b></p>
            <table class="typeLesson">
                <tr>
                    <td><p><?php echo Yii::t('lecture','0074'); ?></p></td>
                    <td><span><?php echo $lecture->getPreType() ?></span></td>
                    <td><img src="<?php
                        switch ($lecture->getPreType())
                        {
                            case 'лекція':
                                echo Yii::app()->request->baseUrl."/css/images/lectureIco.png";
                                break;
                            case 'практична робота':
                                echo Yii::app()->request->baseUrl."/css/images/practicalIco.png";
                                break;
                        }
                        ?> " style="width:<?php echo $footNavSize*0.02 . 'px'; ?>"></td>
                    <td><p><?php echo Yii::t('lecture','0075'); ?></p></td>
                    <td><span><?php echo $lecture->getPreDur() ?></span></td>
                    <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/timeIco.png" style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
                </tr>
            </table>
            <table class="ratingLeson">
                <tr>
                    <?php
                    for ($i=0; $i<$lecture->getPreRait(); $i++)
                    {
                        ?>
                        <td>	<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco1.png" style="width:<?php echo $footNavSize*0.015 . 'px';?>; padding:0px;"></td>
                    <?php
                    }
                    for ($j=0; $j<$footNavMaxMark-$lecture->getPreRait(); $j++)
                    {
                        ?>
                        <td>	<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco0.png" style="width:<?php echo $footNavSize*0.015 . 'px';?>; padding:0px;"></td>
                    <?php
                    }
                    ?>
                    <td><img src="<?php
                        if ($lecture->getPreMedal()=='Зараховано')
                        {
                            echo Yii::app()->request->baseUrl."/css/images/medalIco.png";
                        } else {
                            echo Yii::app()->request->baseUrl."/css/images/medalIcoFalse.png";
                        }
                        ?> " style="width:<?php echo $footNavSize*0.035 . 'px'; ?>"></td>
                </tr>
            </table>
            <div class="preLesonLink">
                <p><a href="#">&#171 <?php echo Yii::t('lecture','0087'); ?></a></p>
            </div>
        </div>
    <?php
    }

    if (  $lecture->getPost()=='True' )
    {
    ?>
    <div class="nextLessons">
        <p class="lesname"><?php echo Yii::t('lecture','0073'); ?> <?php echo $lecture->getPostNumber() ?>: <b><?php echo $lecture->getPostName() ?></b></p>
        <table class="typeLesson">
            <tr>
                <td><p><?php echo Yii::t('lecture','0074'); ?></td>
                <td><span><?php echo $lecture->getPostType() ?></span></td>
                <td><img src="<?php
                    switch ($lecture->getPostType())
                    {
                        case 'лекція':
                            echo Yii::app()->request->baseUrl."/css/images/lectureIco.png";
                            break;
                        case 'практична робота':
                            echo Yii::app()->request->baseUrl."/css/images/practicalIco.png";
                            break;
                    }
                    ?> "style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
                <td><p><?php echo Yii::t('lecture','0075'); ?></p></td>
                <td><span><?php echo $lecture->getPostDur() ?></span></td>
                <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/timeIco.png" style="width:<?php echo $footNavSize*0.02 . 'px';?>"></td>
            </tr>
        </table>
        <table class="ratingLeson">
            <tr>
                <?php
                for ($i=0; $i<$lecture->getPostRait(); $i++)
                {
                    ?>
                    <td>	<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco1.png" style="width:<?php echo $footNavSize*0.015 . 'px';?>; padding:0px;"></td>
                <?php
                }
                for ($j=0; $j<$footNavMaxMark-$lecture->getPostRait(); $j++)
                {
                    ?>
                    <td>	<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco0.png" style="width:<?php echo $footNavSize*0.015 . 'px';?>; padding:0px;"></td>
                <?php
                }
                ?>
                <td><img src="<?php
                    if ($lecture->getPostMedal()=='Зараховано')
                    {
                        echo Yii::app()->request->baseUrl."/css/images/medalIco.png";
                    } else {
                        echo Yii::app()->request->baseUrl."/css/images/medalIcoFalse.png";
                    }
                    ?> " style="width:<?php echo $footNavSize*0.035 . 'px';?>"></td>
            </tr>
        </table>
        <?php if($lecture->getThisMedal()=='Зараховано') { ?>
            <div class="nextLesonLink">
                <p><a href="#"><input class="nextLessButt" type="submit" value="<?php echo Yii::t('lecture','0088'); ?>"></a></p>
            </div>

            <?php  }?>
    </div>

<?php
    }
?>
</div>

