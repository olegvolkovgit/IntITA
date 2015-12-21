<?php
/* @var $model StudentReg */
?>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/dashboard.css'); ?>" rel="stylesheet">

<div id="page-wrapper" >
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Особистий кабінет</h1>
        </div>
    </div>
    <div id="pageContainer">
        <div class="row">
            <div class="col-lg-12">
    <?php echo $this->renderPartial('_dashboard',array(
            'model' => $model,
    )) ?>
            </div>
         </div>
    </div>
</div>

