<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 13.11.2016
 * Time: 22:43
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>"/>

<div class="panel panel-primary">
    <div class="panel-heading">
Написати листа
</div>
    <div class="panel-body" ng-controller="newsletterCtrl">
        <div class="row">
            <input type="number" hidden="hidden" id="receiverId" value="0"/>

            <div class="form-group col-md-8" id="receiver">
                <label>Кому</label>
                <br>
                <select class="form-control" ng-model="selectedRole" ng-options="role as role.name for role in roles"></select>
            </div>

            <div class="form-group col-md-8">
                <label>Тема</label>
                <input class="form-control" name="subject" placeholder="Тема листа">
            </div>

            <div class="form-group col-md-8">
                <label>Лист</label>
                <textarea class="form-control" rows="6" id="text" placeholder="Лист" required></textarea>
            </div>
            <div class="col-md-8">
            <button type="submit" class="btn btn-primary"
                    ng-click="sendMessage('<?php echo Yii::app()->createUrl('/_teacher/messages/sendUserMessage'); ?>');">
                        Написати
            </button>
                <button type="reset" class="btn btn-default"
                        ng-click="loadMessagesIndex()">
                            Скасувати
                </button>
            </div>
    </div>
    </div>
</div>