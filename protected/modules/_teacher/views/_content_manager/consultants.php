<div class="ng-scope ng-isolate-scope alert alert-dismissible alert-success">
    *Консультант - співробітник, який може консультувати студентів по індивідуальному модульному
    або командному дипломному проекту, та екзамену з модуля, який закріплений за ним, як за консультантом.
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#all" data-toggle="tab">Консультанти</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="all">
                <?php $this->renderPartial('/_content_manager/_allConsultants');?>
            </div>
        </div>
    </div>
</div>