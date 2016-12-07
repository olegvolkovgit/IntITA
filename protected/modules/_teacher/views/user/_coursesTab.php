<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if(Yii::app()->user->model->isAdmin()){?>
        <div class="row">
            <div class="col col-md-6">
                <input type="text" size="65" ng-model="formData.courseSelected" ng-model-options="{ debounce: 1000 }"
                       placeholder="Курс" uib-typeahead="item.title for item in getCourses($viewValue) | limitTo:10"
                       typeahead-no-results="courseNoResults" typeahead-on-select="onSelectCourse($item)"
                       ng-change="reloadCourse()" class="form-control" />
                <div ng-show="courseNoResults">
                    <i class="glyphicon glyphicon-remove"></i> курс не знайдено
                </div>
            </div>
            <div class="col col-md-2">
                <button type="button" class="btn btn-success"
                        ng-click="actionCourse('payCourse',data.user.id,selectedCourse.id)">
                    Сплатити курс
                </button>
            </div>
        </div>
        <?php } ?>
        <br>
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
                                            <a type="button" class="btn btn-outline btn-success btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/agreement/course/{{course.id}}">
                                                <em>договір</em>
                                            </a>
                                            <a href=""
                                               ng-click="actionCourse('cancelCourse',data.user.id,course.id)">
                                                <span class="warningMessage"><em> скасувати доступ</em></span>
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
