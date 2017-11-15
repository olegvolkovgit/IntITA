<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені курси:</h4>
                <ul ng-if="studentAttributes.courses.length!=0" class="list-group">
                    <li ng-repeat="service in studentAttributes.courses track by $index" class="list-group-item">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="" data-toggle="collapse" ng-click="collapse('#collapse'+service.id)">
                                            {{service.title_ua}} ({{service.lang}}, {{service.name}})
                                        </a>
                                    </h4>
                                    <?php if (Yii::app()->user->model->isAccountant()) { ?>
                                        <?php $this->renderPartial('_agreementBlock', array('model' =>$model,'service' =>'course'));?>
                                    <?php } ?>
                                </div>
                                <div id="collapse{{service.id}}" class="panel-collapse collapse">
                                    <ul>
                                        <li ng-repeat="module in service.modules track by $index">
                                            <a href={{module.link}} target="_blank">
                                                {{module.title}} ({{module.lang}})
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <em ng-if="studentAttributes.courses.length==0">Курсів немає.</em>
            </div>
        </div>
    </div>
</div>
<style>
    .agreementBlock{
        text-align: right;
        color:#4B75A4;
        cursor: pointer;
    }
</style>