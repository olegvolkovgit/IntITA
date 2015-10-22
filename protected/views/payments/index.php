<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery-1.8.3.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'account.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'account.js'); ?>"></script>

<head>
    <meta charset="UTF-8">
</head>
<div id="accountContainer">
    <?php $this->renderPartial('_account', array('account' => $account), false, true); ?>
    <div>
        <br>
        <br>
        <?php if (!isset($_GET['nolayout'])) { ?>
            <button onclick="sendData('<?php echo $account->id_account; ?>')" id="printAccount">
                <?php echo Yii::t('payment', '0658'); ?>
            </button>
        <?php } ?>
        <br>
        <br>
        <br>
        <?php if (isset($_GET['nolayout']) && $_GET['nolayout'] == 'true') { ?>
            <script>
                $(window).load(
                    function () {
                        window.print();
                    }
                )
            </script>
        <?php } ?>
    </div>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'account.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.cookie.js'); ?>"></script>