<!-- course style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/course.css" />
<!-- course style -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/readmore/readmore.js"></script>
<!-- BD -))) -->
<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",$model->course_name,
);
?>

<div class="courseBlock">
    <div class="courseTitle">
        <h1><?php echo $model->course_name;?></h1>
    </div>
    <div class="courseShortInfo">
        <img class="courseImg" style="display: inline-block" src="<?php echo Yii::app()->request->baseUrl.$model->course_img ?>" />
        <div class="courseShortInfoTable">
            <table class="courseLevelLine">
                    <tr>
                        <td>
                            <p><span class="colorP"><b><?php echo Yii::t('course', '0193'); ?></b></span>&nbsp;<?php echo Yii::t('courses', '0234'); ?></p>
                        </td>
                        <td class="courseLevel">
                            <?php
                            for ($i=0; $i<3; $i++)
                            {
                                ?>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco1.png" >
                            <?php
                            }
                            for ($j=0; $j<2; $j++)
                            {
                                ?>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco0.png" >
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
            </table>
            <div class="courseDetail">
                <div> <span class="colorP"><?php echo Yii::t('course', '0194'); ?> </span> <span class="colorGrey"><b><?php echo $model->course_duration_hours;?> <?php echo Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('course', '0209'); ?> - <b><?php echo ceil($model->course_duration_hours/36);?> <?php echo Yii::t('module', '0218'); ?></b> (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)</span></div>
                <div> <span class="colorP"><?php echo Yii::t('course', '0196'); ?> </span></div>
                <div id="spoilerPay">
                    <div> <span> &nbsp;<?php echo Yii::t('course', '0197'); ?> </span> <span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> <b>16500.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 25%)</div>
                    <div> <span> &nbsp;<?php echo Yii::t('course', '0198'); ?> </span> <span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> 9000.00 <?php echo Yii::t('module', '0222'); ?> х 2 проплати = <b>18000.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 8%)</div>
                    <div> <span> &nbsp;<?php echo Yii::t('course', '0199'); ?> </span>  <span class="redStrike">21600.00 <?php echo Yii::t('module', '0222'); ?></span> 5000.00 <?php echo Yii::t('module', '0222'); ?> х 4 проплати = <b>20000.00 <?php echo Yii::t('module', '0222'); ?></b> (<?php echo Yii::t('course', '0210'); ?> - 9%)</div>
                     <div> <span> &nbsp;<?php echo Yii::t('course', '0200'); ?> </span> <span>1000.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 24 проплати = <b>24000.00 <?php echo Yii::t('module', '0222'); ?>.</b></span></div>
                    <div> <span> &nbsp;<?php echo Yii::t('course', '0201'); ?> </span> <span>800.00 <?php echo Yii::t('module', '0222'); ?>/<?php echo Yii::t('module', '0218'); ?> х 36 проплат = <b>28800.00 <?php echo Yii::t('module', '0222'); ?></b>.</span></div>
                </div>
                <div> <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
                    <span>
                        <?php
                        for ($i=0; $i<10; $i++)
                        {
                            ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                        <?php
                        }
                        ?>
                    </span>
                </div>
            </div>
    </div>

    <div class="courseInfo">
        <ul>
            <p class="subCourseInfo"><b><?php echo Yii::t('course', '0204'); ?></b></p>
            <?php
            $forWhomArray=explode(";", $model->for_whom);
            for ($k = 0; $k < count($forWhomArray)-1; $k++)
            {
                ?>
                <li><?php echo $forWhomArray[$k].";";?></li>
            <?php
            }
            ?>
        </ul>
        <ul>
            <p class="subCourseInfo"><b><?php echo Yii::t('course', '0205'); ?></b></p>
            <?php
            $whatYouLearnArray=explode(";", $model->what_you_learn);
            for ($l = 0; $l < count($whatYouLearnArray)-1; $l++)
            {
                ?>
                <li><?php echo $whatYouLearnArray[$l].";";?></li>
            <?php
            }
            ?>
        </ul>
        <ul>
            <p class="subCourseInfo"><b><?php echo Yii::t('course', '0206'); ?></b></p>
            <?php
            $whatYouLearnArray=explode(";", $model->what_you_get);
            for ($r = 0; $r < count($whatYouLearnArray)-1; $r++)
            {
                ?>
                <li><?php echo $whatYouLearnArray[$r].";";?></li>
            <?php
            }
            ?>
        </ul>
    </div>

    <div class="courseTeachers">
        <h2><?php echo Yii::t('course', '0207'); ?></h2>
        <article>
            <?php $this->renderPartial('_courseTeacher', array('course'=>$model));?>    
        </article>
    </div>

    <div class="courseModules">
        <h2>Модулі</h2>
        <div class="cModule">
            <table>
                <tr>
                    <td>
                        <span class="colorGrey"><?php echo Yii::t('course', '0208'); ?> 1. </span>
                    </td>
                    <td>
<!--                        <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/module"><span class="colorP">Основи PHP</span></a>-->
                            <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 1)); ?>"><span class="colorP">Основи PHP</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey"><?php echo Yii::t('course', '0208'); ?> 2. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 2)); ?>"><span class="colorP">Семантичне ядро сайту</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey"><?php echo Yii::t('course', '0208'); ?> 3. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 3)); ?>"><span class="colorP">Зовнішні ресурси в просуванні</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey"><?php echo Yii::t('course', '0208'); ?> 4. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 4)); ?>"><span class="colorP">Запити HTTP, URL параметри і форми HTML котрі допомагають справжньому програмісту</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey"><?php echo Yii::t('course', '0208'); ?> 5. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 5)); ?>"><span class="colorP">Cookies Урок і сесії</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey"><?php echo Yii::t('course', '0208'); ?> 6. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 6)); ?>"><span class="colorP">Робота з файлами</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey"><?php echo Yii::t('course', '0208'); ?> 7. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 7)); ?>"><span class="colorP">Урок Робота з базою даних</span></a>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <span class="colorGrey"><?php echo Yii::t('course', '0208'); ?> 11. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 8)); ?>"><span class="colorP">Урок Робота з базою даних</span></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
        
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/spoilerPrice.js"></script>
