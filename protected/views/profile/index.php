<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lessonsStyle.css" />
<!-- Підключення BBCode WysiBB -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/jquery.wysibb.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/theme/default/wbbtheme.css" type="text/css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/lang/ua.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/BBCode.js"></script>
<!-- Підключення BBCode WysiBB -->
<!-- Spoiler -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SpoilerContent.js"></script>
<!-------------------------------------------------------------->
<!-- teacherProfile style -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/teacherProfile.css" />
<!-- steps style -->
<?php
/* @var $this ProfileController */
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(Yii::t('breadcrumbs', '0057'),);
$tmp2 = Yii::t('teachers', '0061');
if (isset($_GET['div'])){
    $currentDiv = $_GET['div'];
} else {
    $currentDiv = '';
}
$arrayCourseText=array(
    ' •  кройка и шитье сроков давности;'=> Yii::app()->request->baseUrl.'/course',
    ' •  программування самоубийств;'=> Yii::app()->request->baseUrl.'/course'
);
?>
<div class="TeacherProfilemainBlock">
    <!-- Block 1 -->
    <div class="TeacherProfileblock1">
        <table>
            <tr>
                <td valign="top">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1Image.png"/>
                </td>
                <td>
                    <?php
                    if ($editMode) {
                        $currentDiv = 'TeacherProfilename';
                        $this->renderPartial('_editorToolbar', array('div' => $currentDiv));
                    }
                    ?>
                    <div class="TeacherProfilename"> <?php echo $model->last_name;?></div>
                    <div class="TeacherProfilename"> <?php echo $model->first_name.' '.$model->middle_name; ?> </div>

                    <div class="TeacherProfiletitles">
                        <?php echo Yii::t('teacher', '0064') ?>
                    </div>

                    <?php
                    if ($editMode) {
                        $currentDiv = 'TeacherProfilesectionText';
                        $this->renderPartial('_editorToolbar', array('div' => $currentDiv));
                    }
                    ?>
                    <div class="TeacherProfilesectionText">
                        <?php
                        foreach ($sections as $val) {
                            echo $val; ?><p></p><?php
                        }
                        ?>
                    </div>

                    <div class="TeacherProfiletitles">
                        <?php echo Yii::t('teacher', '0065') ?>
                    </div>

                    <?php
                    if ($editMode) {
                        $currentDiv = 'txtMsgFirst';
                        $this->renderPartial('_editorToolbar', array('div' => $currentDiv));
                    }
                    ?>

                    <div class="txtMsgFirst">
                        <?php echo $model->profile_text_first; ?>
                    </div>

                    <?php echo Yii::t('teachers', '0061'); ?>

                    <?php
                    if ($editMode) {
                        $currentDiv = 'TeacherProfilecourse';
                        $this->renderPartial('_editorToolbar', array('div' => $currentDiv));
                    }
                    ?>
                    <div class="TeacherProfilecourse">
                        <?php
                        foreach ($arrayCourseText as $linkText => $linkAdress) {
                            ?>
                            <p><a href="<?php echo $linkAdress; ?>">
                                <?php echo $linkText; ?>
                            </a></p>

                        <?php
                        }
                        ?>
                    </div>

                    <?php
                    if ($editMode) {
                        $currentDiv = 'txtMsgSecond';
                        $this->renderPartial('_editorToolbar', array('div' => $currentDiv));
                    }
                    ?>
                    <div class="txtMsgSecond">
                        <?php echo $model->profile_text_last;?>
                    </div>
                </td>
            </tr>
        </table>
    </div>


    <!-- Block 2 -->
    <div class="TeacherProfileblock2">
        <div class="border">
            <div class="TeacherProfiletitles">
                <?php echo Yii::t('teacher', '0181'); ?>
                <b>
                    <?php echo $model->last_name; ?>
                    <?php echo $model->first_name; ?>
                    <?php echo $model->middle_name; ?>
                </b>
            </div>
        </div>
        <div class="TeacherProfiletitles"><?php echo Yii::t('teacher', '0182'); ?></div>
        <div class="border">
            <div class="txtMsg">
                <?php
                echo Yii::t('teacher', '0183').$model->rate_knowledge.'    ';
                echo Yii::t('teacher', '0184').$model->rate_efficiency.'    ';
                echo Yii::t('teacher', '0185').$model->rate_relations.'    ';
                ?>
            </div>
        </div>

        <?php
        $responses = $dataProvider->getData();
        $count = $dataProvider->totalItemCount;
        for($i = 0; $i < $count; $i++){
            $this->renderPartial('_responseBlock', array('model' => $responses[$i]));
        }
        ?>

        <?php
        $this->renderPartial('_yourResponse');
        ?>
    </div>

    <?php
    // use editor WYSIWYG Imperavi
    $this->widget('ImperaviRedactorWidget', array(
        'selector' => $currentDiv,

        'options' => array(
            'imageUpload' => $this->createUrl('images/upload'),
            'lang' => Yii::app()->language,
            'toolbar' => true,
            'iframe' => true,
            'css' => 'wym.css',
        ),
        'plugins' => array(
            'fullscreen' => array(
                'js' => array('fullscreen.js',),
            ),
            'video' => array(
                'js' => array('video.js',),
            ),
            'fontsize' => array(
                'js' => array('fontsize.js',),
            ),
            'fontfamily' => array(
                'js' => array('fontfamily.js',),
            ),
            'fontcolor' => array(
                'js' => array('fontcolor.js',),
            ),

        ),
    ));
    ?>
