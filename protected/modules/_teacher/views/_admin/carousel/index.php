<?php
/* @var $this CarouselController */
/* @var $dataProvider CActiveDataProvider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>" />
<br>
<br>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                ng-click="changeView('admin/addmainsliderphoto')">
            Додати фото</button>
    </li>
</ul>

    <div class="page-header" >
        <h4>Слайдер на головній</h4>
    </div>

<div class="col-lg-12" ng-controller="mainSliderTableCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="mainSliderTable" datatable="ng" dt-options="dtOptions" style="width:100%">
                    <thead>
                    <tr>
                        <th>Порядок</th>
                        <th ng-style="{ width:'50%' }">Фото</th>
                        <th>Вверх слайд</th>
                        <th>Вниз слайд</th>
                        <th>Вверх текст</th>
                        <th>Вниз текст</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="row in sliderList">
                        <td>{{row.order}}</td>
                        <td><a ng-href="#/admin/carousel/view/id/{{row.id}}">
                                <img class="carouselImage" src="{{row.photo.image}}">
                            </a>
                            <div>{{row.photo.text}}</div>
                        </td>
                        <td><a ng-href="#/carousel/up/{{row.order}}">вверх</a></td>
                        <td><a ng-href="#/carousel/down/{{row.order}}">вниз</a></td>
                        <td><a ng-href="#/carousel/textUp/{{row.order}}">вверх</a></td>
                        <td><a ng-href="#/carousel/textDown/{{row.order}}">вниз</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>