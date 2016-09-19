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
<script>

</script>
<a type="button" class="btn btn-primary" ng-href="#/newmessages/receiver/">
    Написати
</a>
<br>
<br>

<div id="mylettersSend">
    <div class="panel panel-default">
        <div class="panel-body" ng-controller="messagesCtrl">
            <!-- Nav tabs -->

            <uib-tabset active="0">
                <uib-tab index="0" heading="<?php echo Yii::t("letter", "0532") ?>" select="reload()">
                    <table ng-table="receivedMessagesTable" class="table table-striped table-bordered table-hover" width="100%" style="cursor:pointer">
                        <colgroup>
                            <col width="25%" />
                            <col width="55%" />
                            <col width="15%" />
                        </colgroup>
                        <tr ng-repeat="row in $data" ng-click="changeView('dialog/'+row.sender.id+'/'+row.receiver.id)" ng-class="!row.read ? 'new' : ''">
                            <td data-title="'Від кого'"  filter="{'name' : 'text'}">
                                <div ng-if="row.sender.fullName"><em>{{row.sender.fullName}} ({{row.sender.email}})</em></div>
                                <div ng-if="row.sender.fullName == ''"><em>{{row.sender.email}}</em></div>
                            </td>
                            <td data-title="'Тема'" filter="{'subject' : 'text'}">
                                <div ng-if="row.rejectRevisionMessages"><em>Запит на затвердження ревізії відхилено</em></div>
                                <div ng-if="row.userMessages"><em>{{row.userMessages.subject}}</em></div>
                                <div ng-if="row.notificationMessages"><em>{{row.notificationMessages.subject}}</em></div>
                                <div ng-if="row.approveRevisionMessages"><em>Запит на затвердження ревізії успішно підтверджено</em></div>
                                <div ng-if="row.payModule"><em>Доступ до модуля</em></div>
                                <div ng-if="row.payCourse"><em>Доступ до курсу</em></div>
                                <div ng-if="row.paymentMessage && !row.paymentMessage.service_id"><em>Доступ до лекцій</em></div>
                            </td>
                            <td data-title="'Дата'"  sortable="'message.create_date'">
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
                            <td data-title="'Кому'"  filter="{'name' : 'text'}">
                                <div ng-if="row.receiver.fullName"><em>{{row.receiver.fullName}} ({{row.receiver.email}})</em></div>
                                <div ng-if="row.receiver.fullName == ''"><em>{{row.receiver.email}}</em></div>
                            </td>
                            <td data-title="'Тема'"  filter="{'subject' : 'text'}">
                                <div ><em>{{row.userMessages.subject}}</em></div>
                            </td>
                            <td data-title="'Дата'"  sortable="'message.create_date'">
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
                            <td data-title="'Від кого'"  filter="{'name' : 'text'}">
                                <div ng-if="row.sender.fullName"><em>{{row.sender.fullName}} ({{row.sender.email}})</em></div>
                                <div ng-if="row.sender.fullName == ''"><em>{{row.sender.email}}</em></div>
                            </td>
                            <td data-title="'Тема'"  filter="{'subject' : 'text'}">
                                <div ng-if="row.rejectRevisionMessages"><em>Запит на затвердження ревізії відхилено</em></div>
                                <div ng-if="row.userMessages"><em>{{row.userMessages.subject}}</em></div>
                                <div ng-if="row.notificationMessages"><em>{{row.notificationMessages.subject}}</em></div>
                                <div ng-if="row.approveRevisionMessages"><em>Запит на затвердження ревізії успішно підтверджено</em></div>
                                <div ng-if="row.payModule"><em>Доступ до модуля</em></div>
                                <div ng-if="row.payCourse"><em>Доступ до курсу</em></div>
                                <div ng-if="row.paymentMessage && !row.paymentMessage.service_id"><em>Доступ до лекцій</em></div>
                            </td>
                            <td data-title="'Дата'" sortable="'message.create_date'">
                                <em>{{row.message.create_date |shortDate:"dd-MM-yyyy"}}</em>
                            </td>
                        </tr>
                    </table>
                </uib-tab>

            </uib-tabset>

        </div>

    </div>
</div>
