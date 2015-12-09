<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for tabs -->
    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/fontface.css"/>
    <!-- fonts -->
    <link rel="shortcut icon" href="<?php echo Config::getBaseUrl(); ?>/css/images/favicon.ico" type="image/x-icon"/>
    <script src="<?= StaticFilesHelper::fullPathTo('js', 'jquery-1.11.3.min.js');?>"></script>
</head>

<body>
<div id="contentBoxMain">
    <?php echo $content; ?>
</div>
</body>
</html>
