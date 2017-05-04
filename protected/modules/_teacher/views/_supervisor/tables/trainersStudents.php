<?php
/**
 * @var $idTrainer integer
 */
?>
<div class="panel panel-default" ng-controller="trainersStudentsCtrl">
    <div class="col-md-12">
        <h3>
            <b>Тренер: <?php echo StudentReg::model()->findByPk($idTrainer)->fullName() ?></b>
            <a class="btnChat"  ng-href="#/newmessages/receiver/<?php echo $idTrainer ?>"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                <i class="fa fa-envelope fa-fw"></i>
            </a>
            <a class="btnChat" href="<?php echo Config::getChatPath(); ?><?php echo $idTrainer ?>" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                <i class="fa fa-weixin fa-fw"></i>
            </a>
        </h3>
    </div>
    <div class="col-md-8">
        <form method="post" ng-submit="addTrainer('<?php echo $idTrainer ?>',selectedUser.id);">
            <div class="form-group">
                <label>Студент*:</label>
                <input autocomplete="off" type="text" name="student" size="50" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                       placeholder="Студент" uib-typeahead="item.email for item in getStudentsWithoutTrainer($viewValue) | limitTo : 10"
                       typeahead-no-results="noResultsStudent"  typeahead-template-url="customTemplate.html"
                       typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control"
                       ng-disabled="defaultStudent" required/>
                <div ng-show="noResultsStudent">
                    <i class="glyphicon glyphicon-remove"></i> студента не знайдено
                </div>
                <br>
                <input type="submit" class="btn btn-success" ng-disabled="!selectedUser" value="Додати студента">
            </div>
        </form>
    </div>
    <br>

    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="trainersStudentsTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col/>
                    <col width="5%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td style="word-wrap:break-word" data-title="'Студент'" filter="{'studentModel.fullName': 'text'}" sortable="'studentModel.fullName'">
                        <a ng-href="#/users/profile/{{row.student}}">{{row.studentModel.fullName}}</a>
                    </td>
                    <td data-title="'Призначено'" filter="{'start_time': 'text'}" sortable="'start_time'">{{row.start_time}}</td>
                    <td data-title="''">
                        <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.student}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" href="<?php echo Config::getChatPath(); ?>{{row.student}}" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
                        <a ng-if="!row.end_time" ng-click="cancelTrainer(row.student)"><i class="fa fa-trash fa-fw"></i></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>