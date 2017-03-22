<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<div ng-controller="graduateCtrl">
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminGraduate.css'); ?>"/>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ui-sref="graduate">
            Список випускників</button>
    </li>
    <?php if(0){?>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('graduate/edit/<?= $model->id ?>')">
            Редагувати</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="deleteGraduate('<?= $model->id ?>')">
            Видалити</button>
    </li>
    <?php } ?>
</ul>

<div class="panel panel-default">
    <div class="panel-body">
        <uib-tabset active="0" >
            <uib-tab  index="0" heading="Головне">
                <?php $this->renderPartial('_mainTab', array('model' => $model)); ?>
            </uib-tab>
            <uib-tab index="1" heading="Українською">
                <?php $this->renderPartial('_uaTab', array('model' => $model)); ?>
            </uib-tab>
            <uib-tab  index="2" heading="Російською">
                <?php $this->renderPartial('_ruTab', array('model' => $model)); ?>
            </uib-tab>
            <uib-tab  index="3" heading="Англійською">
                <?php $this->renderPartial('_enTab', array('model' => $model)); ?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>

</div>