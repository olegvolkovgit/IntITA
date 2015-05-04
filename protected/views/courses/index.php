<!-- courses style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/courses.css" />

<script type="text/javascript">
    function wrt(x)
    {
        document.getElementById("razv").innerHTML=x;
    }
</script>
<script>
    function xexx()
    {
        document.getElementById('xex').style.display='none'
    }
</script>

<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0050'),
);


$courseList = $dataProvider->getData();

$courseDisableImage=Yii::app()->request->baseUrl.'/css/images/ratIco0.png';
$courseEnableImage= Yii::app()->request->baseUrl.'/css/images/ratIco1.png';

?>

<div id='coursesMainBox'>

    <h1><?php echo Yii::t('courses', '0066'); ?></h1>

    <table>
        <tr>
<!--            Для стажерів() | Для початківців (6)   |   Для спеціалістів (0)   |   Для експертів (0)   |   Усі курси (6)   |-->
            <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'intern'));?>">
                        <?php echo 'Для стажерів'; ?></a>&nbsp;(<?php echo Course::model()->count('level=:level',	array(':level' => 'intern'));?>)</div></td>
            <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline2.png"/>&nbsp;&nbsp;</div></td>
            <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'junior'));?>">
                        <?php echo Yii::t('courses', '0140'); ?></a>&nbsp;(<?php echo Course::model()->count('level=:level',	array(':level' => 'junior'));?>)</div></td>
            <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline2.png"/>&nbsp;&nbsp;</div></td>
            <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'strong junior'));?>">
                        <?php echo Yii::t('courses', '0141'); ?></a>&nbsp;(<?php echo Course::model()->count('level=:level',	array(':level' => 'strong junior'));?>)</div></td>
            <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline2.png"/>&nbsp;&nbsp;</div></td>
            <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'middle'));?>">
                        <?php echo Yii::t('courses', '0142'); ?></a>&nbsp;(<?php echo Course::model()->count('level=:level',	array(':level' => 'middle'));?>)</div></td>
            <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline2.png"/>&nbsp;&nbsp;</div></td>
            <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'senior'));?>">
                        <?php echo 'Для провідних розробників'; ?></a>&nbsp;(<?php echo Course::model()->count('level=:level',	array(':level' => 'senior'));?>)</div></td>
            <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline2.png"/>&nbsp;&nbsp;</div></td>
            <td  valign="top"> <div class='sourse'><a href="<?php echo Yii::app()->createUrl('courses/index', array('selector' => 'all'));?>">
                        <?php echo Yii::t('courses', '0143'); ?></a>&nbsp;(<?php echo Course::model()->count('level');?>)</div></td>
        </tr>
    </table>

    <div class="coursesline1">
        <a id="coursesline1" href="#form"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline1.png"/></a>
    </div>

    <table>
        <tr>
            <td  valign="top">

                <div id='coursesPart1'>
                    <?php
                    for ($k = 0; $k < $count1; $k++)
                    {
                        $val = $courseList[$k];
                         ?>
                        <div class='courseBox'>
                            <img src='<?php echo Yii::app()->request->baseUrl.$val->course_img; ?>'>
                            <div class='courseName'> <a href="<?php echo Yii::app()->createUrl('course/index', array('courseID'=>2) ); ?>"><?php
                                    echo $val->course_name; ?></a>
                            </div>
                                <!--Рівень курсу-->
                            <div class="courseLevelBox">
                                <?php echo Yii::t('courses', '0068'); ?>
                                      <span class="courseLevel">
			                            <?php
                                        $rate = 0;
                                        switch ($val->level){
                                            case 'intern':
                                                echo Yii::t('courses', '0232');
                                                $rate = 1;
                                                break;
                                            case 'junior':
                                                echo Yii::t('courses', '0233');
                                                $rate = 2;
                                                break;
                                            case 'strong junior':
                                                echo Yii::t('courses', '0234');
                                                $rate = 3;
                                                break;
                                            case 'middle':
                                                echo Yii::t('courses', '0235');
                                                $rate = 4;
                                                break;
                                            case 'senior':
                                                echo Yii::t('courses', '0236');
                                                $rate = 5;
                                                break;
                                        }
                                        ?>
			                          </span>

                                <div class='courseLevelIndex'>
                                    <?php
                                    for ($i = 0; $i < $rate; $i++) {
                                        ?><span class="courseLevelImage">
                                        <img src="<?php echo $courseEnableImage; ?>">
                                        </span><?php
                                    }
                                    for ($i = $rate; $i < Course::MAX_LEVEL; $i++) {
                                        ?><span class="courseLevelImage">
                                        <img src="<?php echo $courseDisableImage; ?>">
                                        </span><?php
                                    }
                                    ?>
                                </div>
                            </div>
                                                <!--Стан курсу-->
                            <div class="courseStatusBox">
                                <?php echo Yii::t('courses', '0094'); ?>
                                <span id="courseStatus<?php echo $val->status;?>">
                                    <?php if($val->status == 0){
                                        echo Yii::t('courses','0230');
                                    } else {
                                        echo Yii::t('courses','0231');
                                    }
                                    ?>
                                </span>
                            </div>
                                <!--Мови курсу-->
                            <div class="courseLang">
                                <?php echo Yii::t('courses', '0069'); ?>
                                <div id="coursesLang" class="down">
                                    <form  action="" method="post" onsubmit="" name="fff">
                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'UA'));?>" id="ua" name="ua" onclick="changeLang(this)" class="selectedLang" disabled>ua</button>
                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'RU'));?>" id="ru" name="ru" onclick="changeLang(this)">ru</button>
                                    </form>
                                </div>
                            </div>
                                    <!--Вартість курсу-->
                            <div class="coursePriceBox">
                                <?php echo Yii::t('courses', '0147'); ?>
                                <span id="coursePriceStatus1"> <?php echo "21600.00 грн. ";?> </span>
                                <span id="coursePriceStatus2"> <?php echo " 16500.00 грн. ";?> </span>
                                <?php echo " (".Yii::t('courses', '0144')." - 25%)";?>
                            </div>
                                <!--Оцінка курсу-->
                            <div class='starLevelIndex'>
                                <br>
                                <?php echo Yii::t('courses', '0145'); ?>
                                <?php
                                for ($i = 0; $i < 9; $i++) {
                                    ?><span class="courseLevelImage">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png">
                                    </span><?php
                                }
                                for ($i = 0; $i < 1; $i++) {
                                    ?><span class="courseLevelImage">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png">
                                    </span><?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                   } ?>
                </div>
            </td>

            <td  >
                <div id='coursesPart2'>
                                                    <!--Синий блок-->
                    <div class="bgBlue" id="xex">
                        <table>
                            <tr>
                                <td valign="top">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/course99.png">
                                </td>
                                <td>
                                    <div id='coursesHeader'>
                                        <?php echo Yii::t('courses', '0067'); ?>
                                    </div>

                                </td>
                                <td valign="top" style="padding-left: 40px;">
                                    <div id="xex" onclick='xexx("")' style="cursor: pointer;">
                                        <img
                                            src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/close_button.png">
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class='courseBox2'>
                            <span id='courseText2'><?php echo Yii::t('courses', '0148'); ?></span>
                            <?php $tmp = Yii::t('courses', '0229');?>
                            <div id="razv"
                                 onclick='wrt("<?php echo $tmp;?>")'>
                                <br>
                                <u><?php echo Yii::t('courses', '0146'); ?></u>
                            </div>
                            <br>
                            <div id="sver" onclick='wrt("");'></div>
                            <br>
                        </div>
                    </div>

                    <?php
                    for ($j = $count1; $j < $count1+$count2; $j++)
                    {
                        $val = $courseList[$j];
                        ?>
                        <div class='courseBox'>
                            <img src='<?php echo Yii::app()->request->baseUrl.$val->course_img; ?>'>
                            <div class='courseName'> <a href="<?php echo Yii::app()->request->baseUrl; ?>/course"><?php
                                    echo $val->course_name; ?></a>
                            </div>
                                <!--Рівень курсу-->
                            <div class="courseLevelBox">
                                <?php echo Yii::t('courses', '0068');  ?>
                                <span class="courseLevel">
			                            <?php
                                        $rate = 0;
                                        switch ($val->level){
                                            case 'intern':
                                                echo Yii::t('courses', '0232');
                                                $rate = 1;
                                                break;
                                            case 'junior':
                                                echo Yii::t('courses', '0233');
                                                $rate = 2;
                                                break;
                                            case 'strong junior':
                                                echo Yii::t('courses', '0234');
                                                $rate = 3;
                                                break;
                                            case 'middle':
                                                echo Yii::t('courses', '0235');
                                                $rate = 4;
                                                break;
                                            case 'senior':
                                                echo Yii::t('courses', '0236');
                                                $rate = 5;
                                                break;
                                        }
                                        ?>
			                        </span>

                                <div class='courseLevelIndex'>
                                    <?php
                                    for ($i = 0; $i < $rate; $i++) {
                                        ?><span class="courseLevelImage">
                                        <img src="<?php echo $courseEnableImage; ?>">
                                        </span><?php
                                    }
                                    for ($i = $rate; $i < Course::MAX_LEVEL; $i++) {
                                        ?><span class="courseLevelImage">
                                        <img src="<?php echo $courseDisableImage; ?>">
                                        </span><?php
                                    }
                                    ?>
                                </div>
                            </div>
                                <!--Стан курсу-->
                            <div class="courseStatusBox">
                                <?php echo Yii::t('courses', '0094'); ?>
                                <span id="courseStatus<?php echo $val->status;?>">
                                    <?php if($val->status == 0){
                                        echo Yii::t('courses','0230');
                                    } else {
                                        echo Yii::t('courses','0231');
                                    }
                                    ?>
                                </span>
                            </div>
                                <!--Мови курсу-->
                            <div class="courseLang">
                                <?php echo Yii::t('courses', '0069'); ?>
                                <div id="coursesLang" class="down">
                                    <form  action="" method="post" onsubmit="" name="fff">
                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'UA'));?>" id="ua" name="ua" onclick="changeLang(this)" class="selectedLang" disabled>ua</button>
                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'RU'));?>" id="ru" name="ru" onclick="changeLang(this)">ru</button>
                                    </form>
                                </div>
                            </div>
                                <!--Вартість курсу-->
                            <div class="coursePriceBox">
                                <?php echo Yii::t('courses', '0147'); ?>
                                <span id="coursePriceStatus1"> <?php echo "21600.00 грн. "; ?> </span>
                                <span id="coursePriceStatus2"> <?php echo " 16500.00 грн. "; ?> </span>
                                <?php echo " (".Yii::t('courses', '0144')." - 25%)"; ?>
                            </div>
                            <div class='starLevelIndex'>
                                <br>
                                <?php echo Yii::t('courses', '0145'); ?>
                                <?php
                                for ($i = 0; $i < 9; $i++) {
                                    ?><span class="courseLevelImage">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png">
                                    </span><?php
                                }
                                for ($i = 0; $i < 1; $i++) {
                                    ?><span class="courseLevelImage">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png">
                                    </span><?php
                                }
                                ?>
                            </div>
                        </div> <?php
                    }
                    ?>
                </div>
            </td>
        </tr>
    </table>
</div>

<script>
    function changeLang(n){
        for (var i=0; i< n.form.length; i++){
            if(n.form.elements[i].id !== n.id){
                console.log(n.form.elements[i].id);
                document.getElementById(n.form.elements[i].id).disabled = false;
                document.getElementById(n.form.elements[i].id).className = "";
            }
        }
    }
</script>
