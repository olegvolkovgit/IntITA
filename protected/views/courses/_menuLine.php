<?php
/**
 * @var $counters array
 */
?>
<?php if (isset($_GET['selector'])) $select = $_GET['selector']; else $select = 'all'; ?>
<div class="coursesHeader">
    <h1><?php echo Yii::t('courses', '0066'); ?></h1>

    <table class="coursesType">
        <tr>
            <!--Для початківців (6)   |   Для спеціалістів (0)   |   Для експертів (0)   |   Усі курси (6)   |-->
            <td valign="top">
                <div class='sourse <?php if ($select == 'junior') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'junior')); ?>">
                        <?php echo Yii::t('courses', '0140'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["junior"]; ?></span>
                </div>
            </td>

            <td>
                <div class='sourse'>&nbsp;&nbsp;<img
                        src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
                </div>
            </td>
            <td valign="top">
                <div class='sourse <?php if ($select == 'middle') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'middle')); ?>">
                        <?php echo Yii::t('courses', '0141'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["middle"]; ?></span>
                </div>
            </td>

            <td>
                <div class='sourse'>&nbsp;&nbsp;<img
                        src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
                </div>
            </td>
            <td valign="top">
                <div class='sourse <?php if ($select == 'senior') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'senior')); ?>">
                        <?php echo Yii::t('courses', '0142'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["senior"]; ?></span>
                </div>
            </td>

            <td>
                <div class='sourse'>&nbsp;&nbsp;<img
                        src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
                </div>
            </td>
            <td valign="top">
                <div class='sourse <?php if ($select == 'all') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'all')); ?>">
                        <?php echo Yii::t('courses', '0143'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["total"]; ?></span></div>
            </td>
        </tr>
    </table>
</div>
<div class="coursesline1">
    <a id="coursesline1" href="#form"><img
            src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline1.png'); ?>"/></a>
</div>