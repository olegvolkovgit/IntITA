<?php
/* $this*/
?>
<!-- teachers style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/teachers.css" />
<!-- teachers style -->
<script>
    function xexx()
    {
        document.getElementById('xex').style.display='none'
    }
</script>
<?php
$this->pageTitle = 'INTITA';
$post=Teacher::model()->findAll();
?>
<!-- BD -))) -->
<div class="subNavBlockTeachers">
    <?php
    $this->breadcrumbs=array(
        Yii::t('breadcrumbs', '0052'));
    ?>
</div>
<div class='teachersList'>
    <div class="titleTeachers">
        <h1><?php echo Yii::t('teachers', '0058'); ?></h1>
    </div>
    <div class="leftTeacher">
        <?php
        $i=0;
        foreach ($post as $teacherValue) {
            $i++;
            if ($i % 2 <> 0) {
                ?>
                <div class="teacherBlock">
                    <table>
                        <tr>
                            <td class="profileTeacher" >
                                <img class='teacherAvatar' src="<?php echo Yii::app()->request->baseUrl.$teacherValue->foto_url ?>"/>
                                <a href="<?php echo Yii::app()->request->baseUrl.$teacherValue->readMoreLink; ?>"><?php echo Yii::t('teachers', '0059'); ?> &#187;</a>
                            </td>
                            <td>
                                <h2><?php echo $teacherValue->last_name ?></h2>
                                <h2><?php echo $teacherValue->first_name ?> <?php echo $teacherValue->middle_name ?></h2>
                                <?php echo $teacherValue->profile_text ?>
                                <p>
                                    <?php echo Yii::t('teachers', '0061'); ?>
                                </p>
                                <div class="teacherCourses">
                                    <ul>
                                        <?php
                                        $coursesArray=explode(";", $teacherValue->subjects);
                                        for ($j = 0; $j < count($coursesArray); $j++)
                                        {
                                            ?>
                                            <li><a href="#"><?php echo $coursesArray[$j].";";?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="aboutMore">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/readMore.png"/> <a href="<?php echo Yii::app()->request->baseUrl.$teacherValue->readMoreLink; ?>"><?php echo Yii::t('teachers', '0062'); ?> &#187;</a></br>
                        <?php
                        for ($k=0; $k<10; $k++)
                        {
                            ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                        <?php
                        }
                        ?>
                        <a href="#"><?php echo Yii::t('teachers', '0063'); ?> &#187;</a>
                    </div>
                </div>
            <?php
            }
        }
        ?>
    </div>
    <div class="rightTeacher">
        <div class="ifYouTeachers" id="xex">
            <table>
                <tr>
                    <td valign="top"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher123.png"/></td>
                    <td valign="center"><div id="formTeacher3"><?php echo Yii::t('teachers', '0060');?></div></td>
                    <td valign="top">
                        <div id="xex" onclick='xexx("")' style="cursor: pointer;">
                            <img
                                src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/close_button.png">
                        </div>
                    </td>
                </tr>
            </table>
            <form method="post" action="#">
                <label id="formTeacher" for="name" style="margin-left: 50px"><?php echo Yii::t('teachers', '0174');?></label>
                <input class="formTeacher1" required type="text" name="firstname">
                <br>  <br>
                <label id="formTeacher" for="name" style="margin-left: 8px"><?php echo Yii::t('teachers', '0175');?></label>
                <input class="formTeacher1" required type="text" name="lastname">
                <br> <br>
                <label id="formTeacher" for="name" style="margin-left: 52px"><?php echo Yii::t('teachers', '0176');?></label>
                <input class="formTeacher1" required type="text" name="yearname">
                <br> <br>
                <label id="formTeacher" for="name" style="margin-left: 30px"><?php echo Yii::t('teachers', '0177');?></label>
                <input class="formTeacher1" required type="text" name="educationname">
                <br> <br>
                <label id="formTeacher" for="name" style="margin-left: 15px"><?php echo Yii::t('teachers', '0178');?></label>
                <input class="formTeacher1" required type="text" name="phonename">
                <br> <br>
                <table>
                    <tr>
                        <td>
                            <label id="formTeacher" for="text"><?php echo Yii::t('teachers', '0179');?></label>
                        </td>
                        <td>
                            <textarea class="formTeacher1" id="formTeacher2" required type="text" name="textname"></textarea>
                        </td>
                    </tr>
                </table>
                <ul class="actions">
                    <input id="send_btn" type="submit" value="<?php echo Yii::t('teachers', '0180');?>" />
                </ul>
            </form>
        </div>
        <?php
        $i=0;
        foreach ($post as $teacherValue) {
            $i++;
            if ($i % 2 == 0) {
                ?>

                <div class="teacherBlock">
                    <table>
                        <tr>
                            <td class="profileTeacher" >
                                <img class='teacherAvatar' src="<?php echo Yii::app()->request->baseUrl.$teacherValue->foto_url ?>"/>
                                <a href="<?php echo Yii::app()->request->baseUrl.$teacherValue->readMoreLink; ?>"><?php echo Yii::t('teachers', '0059'); ?> &#187;</a>
                            </td>
                            <td>
                                <h2><?php echo $teacherValue->last_name ?></h2>
                                <h2><?php echo $teacherValue->first_name ?> <?php echo $teacherValue->middle_name ?></h2>
                                <?php echo $teacherValue->profile_text ?>
                                <p>
                                    <?php echo Yii::t('teachers', '0061'); ?>
                                </p>
                                <div class="teacherCourses">
                                    <ul>
                                        <?php
                                        $coursesArray=explode(";", $teacherValue->subjects);
                                        for ($j = 0; $j < count($coursesArray); $j++)
                                        {
                                            ?>
                                            <li><a href="#"><?php echo $coursesArray[$j].";";?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="aboutMore">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/readMore.png"/> <a href="<?php echo Yii::app()->request->baseUrl.$teacherValue->readMoreLink; ?>"><?php echo Yii::t('teachers', '0062'); ?> &#187;</a></br>
                        <?php
                        for ($k=0; $k<10; $k++)
                        {
                            ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                        <?php
                        }
                        ?>
                        <a href="#"><?php echo Yii::t('teachers', '0063'); ?> &#187;</a>
                    </div>
                </div>
            <?php
            }
        }
        ?>
    </div>
</div>