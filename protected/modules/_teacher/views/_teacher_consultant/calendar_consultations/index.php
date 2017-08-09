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
        <input type="text" id="date_time_picker" ng-model="date" ng-change="showTime()"  required autofocus >
    </div>

    <calendar></calendar>

</div>

<script type="text/javascript">
    $jq(function () {
        $jq('#date_time_picker').datetimepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            todayBtn: 0,
            autoclose: false,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            inline: true,
            sideBySide: true,
            keepOpen: true,
            IsDropDownOpen: true,
            debug:true
        });
    });

    $jq("#date_time_picker").focus().bind('blur', function() {
        $jq(this).focus();
    });

</script>