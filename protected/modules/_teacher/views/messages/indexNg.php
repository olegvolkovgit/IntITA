<?php
/**
 * @var $model StudentReg
 * @var $message UserMessages
 * @var $receivedMessages array
 * @var $sentMessages CActiveDataProvider
 * @var $sentDialogs array
 * @var $deletedMessages array
 */
?>

<a type="button" class="btn btn-primary" ng-href="#/newmessages/receiver/">
    Написати
</a>
<br>
<br>
<script type="text/ng-template" id="headerCheckbox.html">
    <input type="checkbox" ng-model="checkboxes.checkAll" id="select_all" name="filter-checkbox" value="" />
</script>

<div id="mylettersSend">
    <div class="panel panel-default">
        <div class="panel-body" ng-controller="messagesCtrl">
            <!-- Nav tabs -->
            <script type="text/ng-template" id="path/to/your/filters/age.html">
                <div ng-controller="messagesCtrl">
                    <p class="input-group">
                        <input type="text" name="{{name}}" ng-disabled="$filterRow.disabled" ng-model="params.filter()[name]" class="input-filter form-control"/ >
          <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="show = !show"><i class="glyphicon glyphicon-calendar"></i></button>
          </span>
                    </p>
                    <div ng-show="show" style="display:block; z-index: 400; position: absolute; min-height:290px;">
                        <div uib-datepicker ng-model="dt" class="well well-sm" datepicker-options="options"></div>
                    </div>
                </div>
            </script>


            <uib-tabset active="0">

                <uib-tab index="0" heading="<?php echo Yii::t("letter", "0532") ?>" select="reload()">
                    <div ng-if="deleteReceivedMessages.length > 0" style="padding: 10px">
                    <button class="btn btn-danger"  ng-click="deleteMessages()">Видалити повідомлення </button>
                    </div>
                    <table ng-table="receivedMessagesTable" class="table table-striped table-bordered table-hover" width="100%" style="cursor:pointer">
                        <colgroup>
                            <col width="5%" />
                            <col width="25%" />
                            <col width="55%" />
                            <col width="15%" />
                        </colgroup>
                        <tr ng-repeat="row in $data"  ng-class="(!row.read ? 'new' : '')">
                            <td header="'headerCheckbox.html'"> <input type="checkbox" ng-model="checkboxes.items[row.id_message]" /></td>
                            <td data-title="'Від кого'"  filter="{'name' : 'text'}" ng-click="changeView('messages/message/'+row.id_message)" sortable="'sender.fullName'">
                                <div ng-if="row.sender.fullName"><em>{{row.sender.fullName}} ({{row.sender.email}})</em></div>
                                <div ng-if="row.sender.fullName == ''"><em>{{row.sender.email}}</em></div>
                            </td>
                            <td data-title="'Тема'" filter="{'subject' : 'text'}" ng-click="changeView('messages/message/'+row.id_message)">
                                <div ng-if="row.rejectRevisionMessages"><em>Запит на затвердження ревізії відхилено</em></div>
                                <div ng-if="row.userMessages"><em>{{row.userMessages.subject}}</em></div>
                                <div ng-if="row.notificationMessages"><em>{{row.notificationMessages.subject}}</em></div>
                                <div ng-if="row.approveRevisionMessages"><em>Запит на затвердження ревізії успішно підтверджено</em></div>
                                <div ng-if="row.payModule"><em>Доступ до модуля</em></div>
                                <div ng-if="row.payCourse"><em>Доступ до курсу</em></div>
                                <div ng-if="row.paymentMessage && !row.paymentMessage.service_id"><em>Доступ до лекцій</em></div>
                            </td>
                            <td data-title="'Дата'"  sortable="'message.create_date'" filter="{'message.create_date': 'path/to/your/filters/age.html' }" ng-click="changeView('messages/message/'+row.id_message)">
                                <em>{{row.message.create_date |shortDate:"dd-MM-yyyy"}}</em>
                            </td>
                        </tr>
                    </table>
                </uib-tab>
                <uib-tab index="1" heading="Надіслані" select="reload()">

                    <table ng-table="sentMessagesTable" class="table table-striped table-bordered table-hover" width="100%" style="cursor:pointer">
                        <colgroup>
                            <col width="25%" />
                            <col width="55%" />
                            <col width="15%" />
                        </colgroup>
                        <tr ng-repeat="row in $data" ng-click="changeView('dialog/'+row.sender.id+'/'+row.receiver.id)">
                            <td data-title="'Кому'"  filter="{'name' : 'text'}" sortable="'receiver.fullName'">
                                <div ng-if="row.receiver.fullName"><em>{{row.receiver.fullName}} ({{row.receiver.email}})</em></div>
                                <div ng-if="row.receiver.fullName == ''"><em>{{row.receiver.email}}</em></div>
                            </td>
                            <td data-title="'Тема'"  filter="{'subject' : 'text'}" ng-click="changeView('messages/message/'+row.id_message)">
                                <div ><em>{{row.userMessages.subject}}</em></div>
                            </td>
                            <td data-title="'Дата'"  sortable="'message.create_date'" ng-click="changeView('messages/message/'+row.id_message)">
                                <em>{{row.message.create_date |shortDate:"dd-MM-yyyy"}}</em>
                            </td>
                        </tr>
                    </table>
                </uib-tab>

                </uib-tab>


                <uib-tab index="2" heading="Видалені" select="reload()">
                    <table ng-table="deletedMessagesTable" class="table table-striped table-bordered table-hover" width="100%" style="cursor:pointer">
                        <colgroup>
                            <col width="25%" />
                            <col width="55%" />
                            <col width="15%" />
                        </colgroup>
                        <tr ng-repeat="row in $data" ng-click="changeView('deletedmessage/'+row.id_message)">
                            <td data-title="'Від кого'"  filter="{'name' : 'text'}" sortable="'sender.fullName'">
                                <div ng-if="row.sender.fullName"><em>{{row.sender.fullName}} ({{row.sender.email}})</em></div>
                                <div ng-if="row.sender.fullName == ''"><em>{{row.sender.email}}</em></div>
                            </td>
                            <td data-title="'Тема'"  filter="{'subject' : 'text'}" ng-click="changeView('messages/message/'+row.id_message)">
                                <div ng-if="row.rejectRevisionMessages"><em>Запит на затвердження ревізії відхилено</em></div>
                                <div ng-if="row.userMessages"><em>{{row.userMessages.subject}}</em></div>
                                <div ng-if="row.notificationMessages"><em>{{row.notificationMessages.subject}}</em></div>
                                <div ng-if="row.approveRevisionMessages"><em>Запит на затвердження ревізії успішно підтверджено</em></div>
                                <div ng-if="row.payModule"><em>Доступ до модуля</em></div>
                                <div ng-if="row.payCourse"><em>Доступ до курсу</em></div>
                                <div ng-if="row.paymentMessage && !row.paymentMessage.service_id"><em>Доступ до лекцій</em></div>
                            </td>
                            <td data-title="'Дата'" sortable="'message.create_date'" ng-click="changeView('messages/message/'+row.id_message)">
                                <em>{{row.message.create_date |shortDate:"dd-MM-yyyy"}}</em>
                            </td>
                        </tr>
                    </table>
                </uib-tab>

            </uib-tabset>

        </div>

    </div>
</div>
