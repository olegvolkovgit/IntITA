<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 27.06.2017
 * Time: 16:10
 */
?>
<div id="pageContainer" ng-controller="calendarCtrl">

    <div id="btn_now" style="" ng-show="show_btn_now" ng-click="back_today()">
        <input class="btn btn-primary" type="submit" value="Сьогодні">
    </div>

    <div id="confirm_time" ng-show="approve_tm">
        <input class="btn btn-success" type="submit" value="Затвердити" ng-click="approve_time_cons()"  >
        <input class="btn btn-danger" type="submit" value="Видалити" ng-click="delete_times()" >
    </div>

    <div id="btn_save_del" ng-show="show_btn" >
        <input class="btn btn-danger" type="submit" value="Видалити" ng-click="delete_times()" ng-hide="save_tm" >
        <input class="btn btn-success" type="submit" value="Зберегти" ng-click="save_time()" ng-show="save_tm" >
        <button class="btn btn-primary" ng-click="cansel_time()"> Скинути </button>
    </div>

    <div class="form-group">
        <div id="date_time_picker" ng-model="date"  ></div>
    </div>

    <calendar></calendar>

    <div id="info_block" ng-if="calendarLoaded">
        <div class="info_rectangle consultationTime"></div> - призначена консультація
        <div class="info_rectangle confirmationTime"></div> - замовлена консультація
        <div class="info_rectangle freeTime"></div> - вільний час вчителя
    </div>
</div>

<script type="text/javascript">
    $jq(function () {
        $jq('#date_time_picker').datetimepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            todayBtn: 0,
            todayHighlight: true,
            startView: 2,
            minView: 2,
            inline: true,
            sideBySide: true
        }).on('changeDate', function (e) {
            var dateObject  = $jq("#date_time_picker").data("datetimepicker").getDate();
            angular.element(document.getElementById('date_time_picker')).scope().showTime(dateObject);
        });
    });
</script>

