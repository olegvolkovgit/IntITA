<?php
/*
 * @var TempPay $account
 * */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'account.css'); ?>"/>
<?php if (!isset($_GET['print'])) {
    Yii::app()->clientScript->registerScriptFile(StaticFilesHelper::fullPathTo('js', 'account.js'));
} ?>
<head>
    <meta charset="UTF-8">
</head>
<?php $this->renderPartial('_account', array('account' => $account), false, true);?>
    <br>
    <br>
    <?php if (!isset($_GET['print'])){ ?>
    <button onclick="sendData('<?php echo $account->id_account; ?>', month)" id="printAccount">Надрукувати</button>
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



