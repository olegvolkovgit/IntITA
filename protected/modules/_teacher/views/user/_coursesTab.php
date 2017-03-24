<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені курси:</h4>
                <ul ng-if="data.courses.length!=0" class="list-group">
                    <li ng-repeat="course in data.courses track by $index" class="list-group-item">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="" data-toggle="collapse" ng-click="collapse('#collapse'+course.id)">
                                            {{course.title_ua}} ({{course.lang}})
                                        </a>
                                        <?php if(Yii::app()->user->model->isAdmin()){?>
                                            <a type="button" class="btn btn-outline btn-success btn-xs" ng-href="#/users/profile/{{data.user.id}}/agreement/course/{{course.id}}">
                                                <em>договір</em>
                                            </a>
                                        <?php } ?>
                                    </h4>
                                </div>
                                <div id="collapse{{course.id}}" class="panel-collapse collapse">
                                    <ul>
                                        <li ng-repeat="module in course.modules track by $index">
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
                <em ng-if="data.courses.length==0">Курсів немає.</em>
            </div>
        </div>
    </div>
</div>