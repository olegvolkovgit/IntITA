<?php
/*
 * @var TempPay $account
 * */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'account.css'); ?>"/>
<?php if (!isset($_GET['print'])) {
    Yii::app()->clientScript->registerScriptFile(StaticFilesHelper::fullPathTo('js', 'account.js'));
} ?>
<script>
    summa = "<?php echo CourseHelper::getPriceUah($account->id_course);?>";
    user = "<?php echo Yii::app()->user->getId();?>";
</script>

<?php $this->renderPartial('_account', array('account' => $account));?>
    <br>
    <br>
    <?php if (!isset($_GET['print'])){ ?>
    <button onclick="sendData('courseId=<?php echo $account->id_course; ?>&print=true&month=' + month,
        $account->id_course, $module)" id="printAccount">Надрукувати</button>
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



