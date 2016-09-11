<div class="panel panel-default" ng-controller="moduleAuthorsCtrl">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#all" data-toggle="tab">Автори модулів</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="all">
                <?php $this->renderPartial('/_content_manager/_allAuthors');?>
            </div>
        </div>
    </div>
</div>