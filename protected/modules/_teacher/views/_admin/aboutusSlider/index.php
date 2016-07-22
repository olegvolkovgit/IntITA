<?php
/* @var $this AboutusSliderController */
/* @var $dataProvider CActiveDataProvider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>"/>
<br>
<br>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/create'); ?>','Додати фото')">
            Додати фото
        </button>
    </li>
</ul>

<div class="col-lg-12" ng-controller="aboutusSliderCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="aboutusSliderTable"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Порядок</th>
                        <th>Фото</th>
                        <th>Вверх слайд</th>
                        <th>Вниз слайд</th>
                        <th>Вверх текст</th>
                        <th>Вниз текст</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

