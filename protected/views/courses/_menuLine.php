<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:46
 */
?>
<h1><?php echo Yii::t('courses', '0066'); ?></h1>

<table>
    <tr>
        <!--Для початківців (6)   |   Для спеціалістів (0)   |   Для експертів (0)   |   Усі курси (6)   |-->
        <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'junior'));?>">
                    <?php echo Yii::t('courses', '0140'); ?></a>&nbsp;(<?php echo count(Course::model()->findAllByAttributes(array('level' => array('junior','strong junior','intern')))); ?>)</div></td>
        <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png');?>"/>&nbsp;&nbsp;</div></td>
        <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'middle'));?>">
                    <?php echo Yii::t('courses', '0141'); ?></a>&nbsp;(<?php echo Course::model()->count('level=:level',	array(':level' => 'middle'));?>)</div></td>
        <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png');?>"/>&nbsp;&nbsp;</div></td>
        <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'senior'));?>">
                    <?php echo Yii::t('courses', '0142'); ?></a>&nbsp;(<?php echo Course::model()->count('level=:level',	array(':level' => 'senior'));?>)</div></td>
        <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png');?>"/>&nbsp;&nbsp;</div></td>
        <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'all'));?>">
                    <?php echo Yii::t('courses', '0143'); ?></a>&nbsp;(<?php echo Course::model()->count('level');?>)</div></td>
    </tr>
</table>

<div class="coursesline1">
    <a id="coursesline1" href="#form"><img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline1.png');?>"/></a>
</div>