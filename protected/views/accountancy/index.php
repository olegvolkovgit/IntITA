<?php
/*
 * @var TempPay $account
 * */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'account.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'account.js');?>"></script>

<head>
    <meta charset="UTF-8">
</head>
<?php $this->renderPartial('_account', array('account' => $account), false, true);?>
    <br>
    <br>
    <?php if (!isset($_GET['print'])){ ?>
    <button onclick="sendData('<?php echo $account->id_account; ?>')" id="printAccount">Надрукувати</button>
<?php } ?>
<br>
<br>
<br>

<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>

<?php if (isset($_GET['print']) && $_GET['print'] == true) { ?>
    <script>
        $(window).load(
            function () {
                window.print();
            }
        )
    </script>
<?php } ?>



