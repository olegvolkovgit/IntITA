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
    summa = "<?php echo $course->course_price;?>";
</script>

<?php $this->renderPartial('_account', array('course' => $course));?>
    <br>
    <br>
    <br>
    <?php if (!isset($_GET['print'])){ ?>
    <button onclick="sendData('courseId=<?php echo $course->course_ID; ?>&print=true&month=' + month)">
        Надрукувати рахунок
    </button>
</div>
<?php } ?>

<?php if (isset($_GET['print'])) { ?>
    <script>
        $(window).load(
            function () {
                window.print();
            }
        )
    </script>
<?php } ?>



