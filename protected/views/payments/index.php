<? $css_version = 1; ?>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery-1.8.3.js"></script>
<!-- Bootstrap Core CSS -->
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap-theme.css'); ?>" rel="stylesheet">

<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'account.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'account.js'); ?>"></script>

<head>
    <meta charset="UTF-8">
</head>
<div class="container">
    <div class="row">
    <?php $this->renderPartial('_account', array('account' => $account), false, true); ?>

        <br>
        <br>
        <?php if (!isset($_GET['nolayout'])) { ?>

                <div class="col-sm-2 col-sm-offset-3">
                    <button onclick="sendData('<?php echo $account->id_account; ?>')" id="printAccount">
                        <?php echo Yii::t('payment', '0658'); ?>
                    </button>
                </div>
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