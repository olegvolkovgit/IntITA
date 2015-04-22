<!-- courses style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/courses.css" />

<script type="text/javascript">
    function wrt(x)
    {
        document.getElementById("razv").innerHTML=x;
//        if (x!="")
//        {document.getElementById("sver").innerHTML="<u><?php //echo Yii::t('lecture', '0082'); ?>//</u>";}
//        else
//        {document.getElementById("sver").innerHTML=""; document.getElementById("razv").innerHTML="<br><u><?php //echo Yii::t('courses', '0146'); ?>//</u>";}
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
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050'),
);
class Course
{
    public $courseLang="Мови курсу:";
    public $courseStatusTitle="Стан курсу:";
    public $coursePrice="Вартість курсу:";
    public $courseImage;
    public $courseName;
    public $courseLevel;
    public $courseNumberofModules;
    public $courseReview;
    public $courseMaxNumberofModules=5;
    public $coursesHeader='Наші курси';
    public $courseLevelTitle='Рівень курсу:';
    public $coursesTextHeader= 'Концепція підготовки';
    public $coursesTextFooter="<span id='courseText2'>Спочатку навчання створюється стійкий фундамент для підготовки програмістів:
		необхідні знання елементарної математики, будови комп’ютера і основ інформатики.</span>";
    public $coursesTextFooter2="<p><span id='courseText2'>Потім вивчаються основні принципи програмування на базі класичних комп'ютерних наук і методологій: алгоритмічна мова;
		лементи вищої та дискретної математики і комбінаторики; структури даних, розробка і аналіз алгоритмів.</span>
		<p><span id='courseText2'>
        Після чого формується база для переходу до сучасних технологій програмування: об’єктно-орієнтоване програмування; проектування баз даних.</span>
		<p><span id='courseText2'>Завершення процесу підготовки шляхом конкретного застосування отриманих знань на реальних проектах із засвоєнням сучасних методів і технологій,
		які використовуються в ІТ індустрії компаніями.</span>";
    function Course ( $courseImage,$courseName,$courseLevel,$courseNumberofModules,$courseReview)
    {
        $this->courseImage=$courseImage;
        $this->courseName=$courseName;
        $this->courseLevel=$courseLevel;
        $this->courseNumberofModules=$courseNumberofModules;
        $this->courseReview=$courseReview;
    }
}

$course1=new Course (Yii::app()->request->baseUrl.'/css/images/course1Image.png','Інтернет програміст (РНР)','сильний початківець',3,'Интерактивные веб-приложения разработка программного  for a for aобеспечения/ Zombie Outlaws Completion Badge. Build faster and more secure web apps with Rails 4.');
$course2=new Course (Yii::app()->request->baseUrl.'/css/images/course2Image.png','Інтернет програміст (Java Script)','сильний початківець',3,'Интерактивные веб-приложения разработка программного  for a for aобеспечения/ Zombie Outlaws Completion Badge. Build faster and more secure web apps with Rails 4.');
$course3=new Course (Yii::app()->request->baseUrl.'/css/images/course3Image.png','Програміст (Java)','сильний початківець',3,'Интерактивные веб-приложения разработка программного  for a for aобеспечения/ Zombie Outlaws Completion Badge. Build faster and more secure web apps with Rails 4.');
$course4=new Course (Yii::app()->request->baseUrl.'/css/images/course4Image.png','Програміст (C#)','сильний початківець',3,'Интерактивные веб-приложения разработка программного  for a for aобеспечения/ Zombie Outlaws Completion Badge. Build faster and more secure web apps with Rails 4.');
$course5=new Course (Yii::app()->request->baseUrl.'/css/images/course5Image.png','Програміст (С++)','сильний початківець',3,'Интерактивные веб-приложения разработка программного  for a for aобеспечения/ Zombie Outlaws Completion Badge. Build faster and more secure web apps with Rails 4.');
$course11=new Course (Yii::app()->request->baseUrl.'/css/images/course11Image.png','Тестувальник (QA) ','сильний початківець',3,'Профессиональная разработка программного обеспечения for a for a Zombie Outlaws Completion Badge. Build faster and more secure web apps with Rails 4.');
$coursesArray1=array($course1,$course2,$course3,$course4);
$course7=new Course (Yii::app()->request->baseUrl.'/css/images/course7Image.png','Програміст (Objective С)','сильний початківець',3,'Профессиональная разработка программного обеспечения for a for a Zombie Outlaws Completion Badge. Build faster and more secure web apps with Rails 4.');


$coursesArray2=array($course5,$course11,$course7);

$courseDisableImage=Yii::app()->request->baseUrl.'/css/images/ratIco0.png';
$courseEnableImage= Yii::app()->request->baseUrl.'/css/images/ratIco1.png';

?>

<div id='coursesMainBox'>

    <h1><?php echo Yii::t('courses', '0066'); ?></h1>

    <table>
        <tr>
<!--            Для початківців (6)   |   Для спеціалістів (0)   |   Для експертів (0)   |   Усі курси (6)   |-->
            <td  valign="top"> <div class='sourse'><a href="#"><?php echo Yii::t('courses', '0140'); ?></a>&nbsp;(6)</div></td>   <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline2.png"/>&nbsp;&nbsp;</div></td>
            <td  valign="top"> <div class='sourse'><a href="#"><?php echo Yii::t('courses', '0141'); ?></a>&nbsp;(0)</div></td>   <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline2.png"/>&nbsp;&nbsp;</div></td>
            <td  valign="top"> <div class='sourse'><a href="#"><?php echo Yii::t('courses', '0142'); ?></a>&nbsp;(0)</div></td>   <td><div class='sourse'>&nbsp;&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline2.png"/>&nbsp;&nbsp;</div></td>
            <td  valign="top"> <div class='sourse'><a href="#"><?php echo Yii::t('courses', '0143'); ?></a>&nbsp;(6)</div></td>
        </tr>
    </table>



    <div class="coursesline1">
        <a id="coursesline1" href="#form"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/coursesline1.png"/></a>
    </div>

    <table>
        <tr><td  valign="top">

                <div id='coursesPart1'>
                    <?php
                    foreach ($coursesArray1 as $val)
                    {
                        ?>
                        <div class='courseBox'>
                            <img src='<?php echo $val->courseImage; ?>'>
                            <div class='courseName'> <a href="<?php echo Yii::app()->request->baseUrl; ?>/course"><?php
                                    echo $val->courseName; ?></a>
                            </div>
<!--Рівень курсу-->
                            <div class="courseLevelBox">
                                <?php echo Yii::t('courses', '0068'); ?>
                                      <span class="courseLevel">
			                            <?php echo $val->courseLevel; ?>
			                          </span>

                                <div class='courseLevelIndex'>
                                    <?php
                                    for ($i=0; $i<$val->courseNumberofModules; $i++)
                                    {
                                        ?><span class="courseLevelImage">
                                        <img src="<?php echo $courseEnableImage;?>">
                                        </span><?php
                                    }
                                    for ($i=0; $i<($val->courseMaxNumberofModules-$val->courseNumberofModules); $i++)
                                    {
                                        ?><span class="courseLevelImage">
                                        <img src="<?php echo $courseDisableImage;?>">
                                        </span><?php
                                    }
                                    ?>
                                </div>
                            </div>
<!--Стан курсу-->
                            <div class="courseStatusBox">
                                <?php echo Yii::t('courses', '0094'); ?>
                                <span id="courseStatus1">доступний</span>
                            </div>
<!--Мови курсу-->
                            <div class="courseLang">
                                <?php echo Yii::t('courses', '0069'); ?>
                                <div id="coursesLang" class="down">
                                    <form  action="" method="post" onsubmit="" name="fff">
                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'UA'));?>" id="ua" name="ua" onclick="changeLang(this)" class="selectedLang" disabled>ua</button>

                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'RU'));?>" id="ru" name="ru" onclick="changeLang(this)">ru</button>

                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'EN'));?>" id="en" name="en" onclick="changeLang(this)">en</button>
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
                            <!--<span class='courseText'>--><?php //echo $val->courseReview;?><!--</span>-->
                        </div>
                    <?php } ?>
                </div></td>

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
                            <div id="razv"
                                 onclick='wrt("<p>Потім вивчаються основні принципи програмування на базі класичних комп&rsquo;ютерних наук і методологій: алгоритмічна мова;елементи вищої та дискретної математики і комбінаторики; структури даних, розробка і аналіз алгоритмів." +
                                  "<p>Після чого формується база для переходу до сучасних технологій програмування: об’єктно-орієнтоване програмування; проектування баз даних." +
                                   "<p>Завершення процесу підготовки шляхом конкретного застосування отриманих знань на реальних проектах із засвоєнням сучасних методів і технологій, які використовуються в ІТ індустрії компаніями.")'>
                                <br>
                                <u><?php echo Yii::t('courses', '0146'); ?></u>
                            </div>
                            <br>

                            <div id="sver" onclick='wrt("");'></div>
                            <br>
                        </div>
                    </div>
                    <?php
                    foreach ($coursesArray2 as $val)
                    {
                        ?>
                        <div class='courseBox'>
                            <img src='<?php echo $val->courseImage; ?>'>
                            <div class='courseName'> <a href="<?php echo Yii::app()->request->baseUrl; ?>/course"><?php
                                    echo $val->courseName; ?></a>
                            </div>
<!--Рівень курсу-->
                            <div class="courseLevelBox">
                                <?php echo Yii::t('courses', '0068');  ?>
                                <span class="courseLevel">
			                            <?php echo $val->courseLevel; ?>
			                        </span>

                                <div class='courseLevelIndex'>
                                    <?php
                                    for ($i = 0; $i < $val->courseNumberofModules; $i++) {
                                        ?><span class="courseLevelImage">
                                        <img src="<?php echo $courseEnableImage; ?>">
                                        </span><?php
                                    }
                                    for ($i = 0; $i < ($val->courseMaxNumberofModules - $val->courseNumberofModules); $i++) {
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
                                <span id="courseStatus2">розробляється</span>
                            </div>
<!--Мови курсу-->
                            <div class="courseLang">
                                <?php echo Yii::t('courses', '0069'); ?>
                                <div id="coursesLang" class="down">
                                    <form  action="" method="post" onsubmit="" name="fff">
                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'UA'));?>" id="ua" name="ua" onclick="changeLang(this)" class="selectedLang" disabled>ua</button>

                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'RU'));?>" id="ru" name="ru" onclick="changeLang(this)">ru</button>

                                        <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lang'=>'EN'));?>" id="en" name="en" onclick="changeLang(this)">en</button>
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

<! main box>

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
