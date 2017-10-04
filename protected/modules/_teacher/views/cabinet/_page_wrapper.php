<?php
/* @var $model StudentReg */
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 style="margin-bottom: 10px;margin-top: 20px" class="page-header" id="pageTitle">Особистий кабінет</h2>
        </div>
    </div>
    <div style="display:none" id="operationMessageHolder"
         uib-alert="" ng-class="'alert-' + (message.type || 'warning')"
         class="ng-scope ng-isolate-scope alert alert-dismissible alert-success">
    </div>
    <div id="pageContainer" ui-view>
        <div class="row">
            <div class="col-lg-12">
    <?php echo $this->renderPartial('_dashboard',array(
            'model' => $model,
    )) ?>
            </div>
         </div>
    </div>
</div>

