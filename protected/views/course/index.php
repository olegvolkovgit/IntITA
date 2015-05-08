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
            <div class="courseLevelLine">
                <p>
                <div class="courseLevelName"><span class="colorP"><b><?php echo Yii::t('course', '0193'); ?></b></span>сильний початківець</div>
                <div class="courseLevel">
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
                </div>
                </p>
            </div>
            <div class="courseDetail">
                <div> <span class="colorP"><?php echo Yii::t('course', '0194'); ?> </span> <span class="colorGrey"><b><?php echo $model->course_duration_hours;?> занять</b>, <?php echo Yii::t('course', '0209'); ?> - <b><?php echo ceil($model->course_duration_hours/36);?> міс.</b> (3 год./день, 3 дні/тиждень)</span></div>
                <div> <span class="colorP"><?php echo Yii::t('course', '0196'); ?> </span></div>
                <div id="spoilerPay">
                    <div> <span> &nbsp;<?php echo Yii::t('course', '0197'); ?> </span> <span class="redStrike">21600.00 грн.</span> <b>16500.00 грн.</b> (<?php echo Yii::t('course', '0210'); ?> - 25%)</div>
                    <div> <span> &nbsp;<?php echo Yii::t('course', '0198'); ?> </span> <span class="redStrike">21600.00 грн.</span> 9000.00 грн. х 2 проплати = <b>18000.00 грн.</b> (<?php echo Yii::t('course', '0210'); ?> - 8%)</div>
                    <div> <span> &nbsp;<?php echo Yii::t('course', '0199'); ?> </span>  <span class="redStrike">21600.00 грн.</span> 5000.00 грн. х 4 проплати = <b>20000.00 грн.</b> (<?php echo Yii::t('course', '0210'); ?> - 9%)</div>
                     <div> <span> &nbsp;<?php echo Yii::t('course', '0200'); ?> </span> <span>1000.00 грн./міс. х 24 проплати = <b>24000.00 грн.</b></span></div>
                    <div> <span> &nbsp;<?php echo Yii::t('course', '0201'); ?> </span> <span>800.00 грн./міс. х 36 проплат = <b>28800.00 грн.</b>.</span></div>
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
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP"><?php echo Yii::t('course', '0208'); ?> 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                      <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher4.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сірий Олександр</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 1));?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 2));?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 3));?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher4.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сірий Олександр</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher4.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сірий Олександр</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->createUrl('profile');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </article>
    </div>

    <div class="courseModules">
        <h2>Модулі</h2>
        <div class="cModule">
            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 1. </span>
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
                        <span class="colorGrey">Модуль 2. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 2)); ?>"><span class="colorP">Семантичне ядро сайту</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 3. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 3)); ?>"><span class="colorP">Зовнішні ресурси в просуванні</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey"">Модуль 4. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 4)); ?>"><span class="colorP">Запити HTTP, URL параметри і форми HTML котрі допомагають справжньому програмісту</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 5. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 5)); ?>"><span class="colorP">Cookies Урок і сесії</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 6. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 6)); ?>"><span class="colorP">Робота з файлами</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 7. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 7)); ?>"><span class="colorP">Урок Робота з базою даних</span></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/spoilerPrice.js"></script>
