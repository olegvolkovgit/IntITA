<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>" />
<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/addmainsliderphoto">
            Додати фото
        </a>
    </li>
</ul>
<div ng-controller="mainSliderTableCtrl">
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
                        <td><a ng-href="#/carousel/view/id/{{row.id}}">
                                <img class="carouselImage" src="{{row.photo.image}}">
                            </a>
                            <div>{{row.photo.text}}</div>
                        </td>
                        <td><a ng-click="mainSlideAction('up',row.order)">вверх</a></td>
                        <td><a ng-click="mainSlideAction('down',row.order)">вниз</a></td>
                        <td><a ng-click="mainSlideAction('textUp',row.order)">вверх</a></td>
                        <td><a ng-click="mainSlideAction('textDown',row.order)">вниз</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>