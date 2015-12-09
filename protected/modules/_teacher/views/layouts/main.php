<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#">
<head>
    <!--[if lte IE 8]>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/json3.min.js'); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.29/angular.min.js"></script>
    <script>
        document.createElement('ng-include');
        document.createElement('ng-switch');
        document.createElement('ng-if');
        document.createElement('ng-pluralize');
        document.createElement('ng-view');

        // needed to enable CSS reference
        document.createElement('ng:view');
    </script>
    <![endif]-->
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
