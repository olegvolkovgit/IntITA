<?php
/* @var $invoice Invoice */
?>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery-1.8.3.js"></script>
<!-- Bootstrap Core CSS -->
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.css'); ?>"
      rel="stylesheet">
<link rel="stylesheet"
    href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap-theme.css'); ?>">

<link rel="stylesheet"
    href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'account.css'); ?>"/>
<head>
    <meta charset="UTF-8">
</head>
<div class="container">
    <div class="row">
        <?php $this->renderPartial('_account', array('model' => $invoice), false, true); ?>
        <div>
            <?php if (!isset($_GET['nolayout'])) { ?>
                <div class="col-sm-2 col-sm-offset-3">
                    <button onclick="sendData()" id="printAccount">
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
            <?php }else if (isset($_GET['nolayout'])){ ?>
            <div class="col-sm-2 col-sm-offset-3">
                <button onclick="sendData()" id="printAccount">
                    <?php echo Yii::t('payment', '0658'); ?>
                </button>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'account.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.cookie.js'); ?>"></script>