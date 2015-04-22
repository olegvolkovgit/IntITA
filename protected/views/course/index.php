<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 15.03.2015
 * Time: 18:08
 */
?>
<!-- course style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/course.css" />
<!-- course style -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/spoilerPrice.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/readmore/readmore.js"></script>
<!-- BD -))) -->
<?php
$post=Course::model()->findByPk(1);
?>
<?php
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",'Програмування для чайників',
);
?>

<div class="courseBlock">
    <div class="courseTitle">
        <h1><?php echo $post->course_name;?></h1>
    </div>
    <div class="courseShortInfo">
        <img class="courseImg" style="display: inline-block" src="<?php echo Yii::app()->request->baseUrl.$post->course_img ?>" />
        <div class="courseShortInfoTable">
            <table class="courseLevelLine">
                    <tr>
                        <td>
                            <p><span class="colorP"><b>Рівень курсу: </b></span>сильний початківець</p>
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
            <table class="courseDetail">
                <tr>
                    <td>
                        <span class="colorP">Тривалість курсу: </span>
                    </td>
                    <td>
                        <span class="colorGrey"><b><?php echo $post->course_duration_hours;?> занять</b>, орієнтовно - <b><?php echo ceil($post->course_duration_hours/36);?> міс.</b> (3 год./день, 3 дні/тиждень)</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="colorP">Модулів: </span>
                    </td>
                    <td>
                        <span class="colorGrey"><b><?php echo $post->modules_count;?></b><?php $post::getModulesTermination($post->modules_count);?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="spoilerLinks"><span class="spoilerClick">Схеми проплат </span><span class="spoilerTriangle">&#9660;</span></span>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;за весь курс наперід:
                    </td>
                    <td>
                        <span class="redStrike">21600.00 грн.</span> <b>16500.00 грн.</b> (знижка - 25%)
                    </td>
                </tr>
                <tr class="spoilerRow">
                    <td>
                        &nbsp;2 проплати за курс:
                    </td>
                    <td>
                        <span class="redStrike">21600.00 грн.</span> 9000.00 грн. х 2 проплати = <b>18000.00 грн.</b> (знижка - 8%)
                    </td>
                </tr>
                <tr class="spoilerRow">
                    <td>
                        &nbsp;4 проплати за курс:
                    </td>
                    <td>
                        <span class="redStrike">21600.00 грн.</span> 5000.00 грн. х 4 проплати = <b>20000.00 грн.</b> (знижка - 9%)
                    </td>
                </tr>
                <tr class="spoilerRow">
                    <td>
                        &nbsp;помісячно:
                    </td>
                    <td>
                        1800.00 грн.х 12 проплат = <b>21600.00 грн.</b>
                    </td>
                </tr>
                <tr class="spoilerRow">
                    <td>
                        &nbsp;кредит на 2 роки:
                    </td>
                    <td>
                        1000.00 грн./міс. х 24 проплати = <b>24000.00 грн.</b>
                    </td>
                </tr>
                <tr class="spoilerRow">
                    <td>
                        &nbsp;кредит на 3 роки:
                    </td>
                    <td>
                        800.00 грн./міс. х 36 проплат = <b>28800.00 грн.</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="colorP">Середня оцінка: </span>
                    </td>
                    <td>
                        <?php
                        for ($i=0; $i<10; $i++)
                        {
                            ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="courseInfo">
        <ul>
            <p class="subCourseInfo"><b>Для кого:</b></p>
            <?php
            $forWhomArray=explode(";", $post->for_whom);
            for ($k = 0; $k < count($forWhomArray)-1; $k++)
            {
                ?>
                <li><?php echo $forWhomArray[$k].";";?></li>
            <?php
            }
            ?>
        </ul>
        <ul>
            <p class="subCourseInfo"><b>Чому Ви навчитеся?</b></p>
            <?php
            $whatYouLearnArray=explode(";", $post->what_you_learn);
            for ($l = 0; $l < count($whatYouLearnArray)-1; $l++)
            {
                ?>
                <li><?php echo $whatYouLearnArray[$l].";";?></li>
            <?php
            }
            ?>
        </ul>
        <ul>
            <p class="subCourseInfo"><b>Що Ви отримаєте?</b></p>
            <?php
            $whatYouLearnArray=explode(";", $post->what_you_get);
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
        <h2>Викладачі</h2>
        <article>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                     <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                      <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher4.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сірий Олександр</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher4.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сірий Олександр</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher4.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сірий Олександр</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="courseTeacher">
                <div class="courseTeacherImg">
                    <a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1.jpg" />
                    </a>
                </div>
                <div class="courseTeacherInfo">
                    <h3><a href="<?php echo Yii::app()->request->baseUrl.'/profile'?>">Сіра Олександра</a></h3>
                    <table class="courseTeacherDetail">
                        <tr>
                            <td>
                                <span class="colorP">Модуль 1: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 2: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Ява скрипт та Суматра;</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="colorP">Модуль 3: </span><span class="colorGrey"><a href="<?php echo Yii::app()->request->baseUrl.'/module'?>">Програмування PHP;</a></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </article>
    </div>

    <script>
        $('article').readmore({
            maxHeight: 360,
            moreLink: '<span><span class="spoiler">Всі викладачі</span> <span class="spoilerTriangle"> &#9660;</span></span>',
            lessLink: '<span><span class="spoiler">Згорнути</span> <span class="spoilerTriangle"> &#9650;</span></span>'
        });
    </script>

    <div class="courseModules">
        <h2>Модулі</h2>
        <div class="cModule">
            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 1. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Основи PHP</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 2. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Семантичне ядро сайту</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 3. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Зовнішні ресурси в просуванні</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey"">Модуль 4. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Запити HTTP, URL параметри і форми HTML котрі допомагають справжньому програмісту</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 5. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Cookies Урок і сесії</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 6. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Робота з файлами</span></a>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 7. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Урок Робота з базою даних</span></a>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <span class="colorGrey">Модуль 11. </span>
                    </td>
                    <td>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Урок Робота з базою даних</span></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>