<?php
/**
 * @var $counters array
 */
?>
<?php if (isset($_GET['selector'])) $select = $_GET['selector']; else $select = 'all'; ?>
<?php if (isset($_GET['organization'])) $organization = $_GET['organization']; else $organization = 'allcourses'; ?>
<div class="coursesHeader">
    <h1>
        <?php echo CoursesController::nameCourses($organization) ?>
    </h1>
            <!-- line 1 -->
    <div class="coursesType">

            <!-- All our courses -->
        <div class="category">
            <div class='selectType sourse <?php if ($organization == 'ourcourses') echo 'selectedSelector' ?>'>
                <a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => $select, 'organization' => 'ourcourses')); ?>">
                    <?php echo Yii::t('courses', '0945'); ?></a>
                <span class='courseNum'><?php echo $counters["our"]; ?></span>
            </div>
            <div class='selectLine sourse'>&nbsp;&nbsp;<img
                    src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
            </div>
        </div>
            <!-- Courses of partners -->
        <div class="category">
            <div class='selectType sourse <?php if ($organization == 'partnerscourses') echo 'selectedSelector' ?>'>
                <a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => $select, 'organization'=>'partnerscourses')); ?>">
                    <?php echo Yii::t('courses', '0946'); ?></a>
                <span class='courseNum'><?php echo $counters["partner"]; ?></span>
            </div>
            <div class='selectLine sourse'>&nbsp;&nbsp;<img
                    src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
            </div>
        </div>
            <!-- all courses ++ -->
        <div class='sourse <?php if ($organization == 'allcourses') echo 'selectedSelector' ?>'><a
                href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => $select, 'organization'=>'allcourses')); ?>">
                <?php echo Yii::t('courses', '0143'); ?></a>&nbsp;<span
                class='courseNum'><?php echo $counters["total"]; ?></span>
        </div>
        <div class='selectLine sourse'>&nbsp;&nbsp;<img
                src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
        </div>
            <!-- all modules ++ -->
        <div class="category">
            <div class='selectType sourse <?php if ($organization == 'modules') echo 'selectedSelector' ?>'><a
                    href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => $select, 'organization' => 'modules')); ?>">
                    <?php echo Yii::t('courses', '0918'); ?></a>&nbsp;
                    <span class='moduleNum'><?php echo $counters["modules"]; ?></span>
            </div>
        </div>

        <div id="coursesFilter">
            <div class="spoilerTriangle" onclick="courseTypeSpoiler(this);">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>
                <?php echo Yii::t('courses', '0903'); ?>
                <span id='trg'>&#9660;</span>
            </div>
            <div id="typeList">
                <div class='sourse <?php if ($select == 'junior') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'junior')); ?>">
                        <?php echo Yii::t('courses', '0140'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["junior"]; ?></span>
                </div>
                <div class='sourse <?php if ($select == 'middle') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'middle')); ?>">
                        <?php echo Yii::t('courses', '0141'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["middle"]; ?></span>
                </div>
                <div class='sourse <?php if ($select == 'senior') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'senior')); ?>">
                        <?php echo Yii::t('courses', '0142'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["senior"]; ?></span>
                </div>
            </div>
        </div>
    </div>

            <!-- line 2 -->

    <div style="margin-left: 56%; margin-bottom: 10px;">
        <!-- junior ++ -->
        <div class="category">
            <div class='selectType sourse <?php if ($select == 'junior') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'junior', 'organization'=> $organization)); ?>">
                    <?php echo Yii::t('courses', '0140'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["junior"]; ?></span>
            </div>
            <div class='selectLine sourse'>&nbsp;&nbsp;<img
                        src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
            </div>
        </div>
        <!-- middle ++ -->
        <div class="category">
            <div class='selectType sourse <?php if ($select == 'middle') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'middle', 'organization'=> $organization)); ?>">
                    <?php echo Yii::t('courses', '0141'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["middle"]; ?></span>
            </div>
            <div class='selectLine sourse'>&nbsp;&nbsp;<img
                        src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
            </div>
        </div>
        <!-- senior ++ -->
        <div class="category">
            <div class='selectType sourse <?php if ($select == 'senior') echo 'selectedSelector' ?>'><a
                        href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'senior', 'organization'=> $organization)); ?>">
                    <?php echo Yii::t('courses', '0142'); ?></a>&nbsp;<span
                        class='courseNum'><?php echo $counters["senior"]; ?></span>
            </div>
            <div class='selectLine sourse'>&nbsp;&nbsp;<img
                        src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>&nbsp;&nbsp;
            </div>
        </div>
        <!-- all levels -->
        <div class='sourse <?php if ($select == 'all') echo 'selectedSelector' ?>'>
            <a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'all', 'organization' => $organization)); ?>">
                <?php echo Yii::t('courses', '0947'); ?></a>
        </div>

        <div id="coursesFilter">
            <div class="spoilerTriangle" onclick="courseTypeSpoiler(this);">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline2.png'); ?>"/>
                <?php echo Yii::t('courses', '0903'); ?>
                <span id='trg'>&#9660;</span>
            </div>
            <div id="typeList">
                <div class='sourse <?php if ($select == 'junior') echo 'selectedSelector' ?>'><a
                            href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'junior')); ?>">
                        <?php echo Yii::t('courses', '0140'); ?></a>&nbsp;<span
                            class='courseNum'><?php echo $counters["junior"]; ?></span>
                </div>
                <div class='sourse <?php if ($select == 'middle') echo 'selectedSelector' ?>'><a
                            href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'middle')); ?>">
                        <?php echo Yii::t('courses', '0141'); ?></a>&nbsp;<span
                            class='courseNum'><?php echo $counters["middle"]; ?></span>
                </div>
                <div class='sourse <?php if ($select == 'senior') echo 'selectedSelector' ?>'><a
                            href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'senior')); ?>">
                        <?php echo Yii::t('courses', '0142'); ?></a>&nbsp;<span
                            class='courseNum'><?php echo $counters["senior"]; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="coursesline1">
    <a id="coursesline1" ><img
            src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'coursesline1.png'); ?>"/></a>
</div>