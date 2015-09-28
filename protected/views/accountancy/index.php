<?php
/*
 * @var $course Course
 * */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'account.css'); ?>"/>
<?php if (!isset($_GET['print'])) {
    Yii::app()->clientScript->registerScriptFile(StaticFilesHelper::fullPathTo('js', 'account.js'));
} ?>
<script>
    summa = "<?php echo CourseHelper::getPriceUah($course->course_ID);?>";
    user = "<?php echo Yii::app()->user->getId();?>";
</script>

<?php $this->renderPartial('_account', array('course' => $course, 'module' => $module));?>
    <br>
    <br>
    <?php if (!isset($_GET['print'])){ ?>
    <button onclick="sendData('courseId=<?php echo $course->course_ID; ?>&print=true&month=' + month, $course->course_ID, $module)" id="printAccount">
        Надрукувати
    </button>
<?php } ?>
<br>
<br>
<br>

<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>

<?php if (isset($_GET['print'])) { ?>
    <script>
        $(window).load(
            function () {
                window.print();
            }
        )
    </script>
<?php } ?>



