<?php
/* @var $this CabinetController
   @var $model StudentReg
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/showPlainTask.css'); ?>" rel="stylesheet">

    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/main.css'); ?>" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap-theme.css'); ?>" rel="stylesheet">

    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/metisMenu/dist/metisMenu.min.css');?>" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '/dist/css/timeline.css');?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '/dist/css/sb-admin-2.css');?>" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/morrisjs/morris.css');?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<script>
    basePath = '<?=Config::getBaseUrl()?>';
</script>
<body>

<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php echo $this->renderPartial('_top_navigation', array('model' => $model, 'newMessages' => $newMessages));?>
        <?php echo $this->renderPartial('_sidebar_navigation', array('model' => $model));?>
    </nav>

    <?php echo $this->renderPartial('_page_wrapper', array('model' => $model));?>

</div>

</body>

<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/dist/js/sb-admin-2.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_teacher.js');?>"></script>
<!-- jQuery -->
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/metisMenu/dist/metisMenu.min.js');?>"></script>

<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/raphael/raphael-min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/morrisjs/morris.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'cms/morris-data.js');?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/dist/js/sb-admin-2.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_teacher.js');?>"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/_teachers/newPlainTask.js"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '/cms/morris-data.js');?>"></script>
</html>

