/**
 * Created by Админ on 29.06.2017.
 */
angular
    .module('teacherApp')
    .controller('calendarCtrl', function ($scope, $compile, teacherConsultantService, $http, $q) {

        $scope.days = [];
        $scope.time = [];
        $scope.free_time = [];
        $scope.free_time_id = [];
        $scope.fullNameDays = [];
        $scope.confirm_time_arr = [];
        $scope.confirm_time = {};
        $scope.month_name_UA = ["Грудень","Січень","Лютий","Березень","Квітень","Травень","Червень","Липень","Серпень","Вересень","Жовтень","Листопад"];
        $scope.title = '';
        $scope.selecting_cell = 0;
        $scope.cansel_flag = 0;
        $scope.show_btn_now = 0;
        $scope.past_day = 0;
        $scope.current_day = 0;
        $scope.approve_tm = 0;
        $scope.show_popup = '';

        $scope.showTime = function(date_out){
            $scope.show_btn = 0;
            var date, name_day, year = [], mon = [], month, day, today;
            var dt, currentWeekDay, lessDays, wkStart, wkEnd, str_st, day_start, str_end, day_end;
            var ch_d, chose_day;

            if( !$scope.days.length ){  // page first download
                var now = new Date();
                day = now.getDate();
                year = now.getFullYear();
                month = now.getMonth()+1;
                $scope.title = $scope.month_name_UA[month]+' '+year;
                today = year+'-'+month+'-'+day;
                $scope.current_day = today;
                $scope.num_week = new Date(today).getWeek();  // номер текущей недели
                $scope.current_week = $scope.num_week;
                dt = new Date();  //current date of week
                currentWeekDay = dt.getDay();
                lessDays = currentWeekDay == 0 ? 6 : currentWeekDay-1;
                wkStart = new Date(new Date(dt).setDate(dt.getDate()- lessDays));
                wkEnd = new Date(new Date(wkStart).setDate(wkStart.getDate()+6));
                str_st = wkStart.toString();
                str_end = wkEnd.toString();
                day_start = str_st.split(' ')[2];
                day_end =  str_end.split(' ')[2];
                ch_d = dt.toString();
                chose_day = ch_d.split(' ')[2];

                // if( day_start > 20 && day_end < 8 && dt < 8 ) {
                if( chose_day < 8 ) {

                    if( month == 1 ){
                        mon.push(12);
                        year.push(year-1);
                        year.push(year);
                    } else {
                        mon.push(month-1);
                    }
                    mon.push(month);

                // } else if( day_start > 20 && day_end < 8 && dt > 20 ) {
                } else if( chose_day > 20 ) {

                    mon.push(month);
                    if( month == 12 ){
                        mon.push(1);
                        year.push(year);
                        year.push(year+1);
                    }else{
                        mon.push(month+1);
                    }
                } else {
                     mon.push(month);
                }
                getFreeTimeConsultation( year, mon );

                for(var i=1; i<=7; i++){
                    date = getDayInWeek($scope.num_week, i, year);
                    year = date.getFullYear();
                    month = date.getMonth()+1;
                    day = date.getDate();

                    if(month < 10 && day < 10){
                        $scope.fullNameDays.push(year+'-0'+month+'-0'+day);
                    }else if(month < 10 && day > 9){
                        $scope.fullNameDays.push(year+'-0'+month+'-'+day);
                    }else{
                        $scope.fullNameDays.push(year+'-'+month+'-'+day);
                    }

                    date = date.toString();
                    name_day = (date.split(' ')[0])+' '+(date.split(' ')[2]);  // Mon 03
                    $scope.days.push(name_day);
                }
                $scope.first_scroll_tbody();
                return $scope.days;

            }else{  // page download after chose day
                $scope.date = date_out;
                $scope.days = [];
                $scope.fullNameDays = [];
                $scope.num_week = new Date($scope.date).getWeek();  // номер текущей недели
                year = $scope.date.getFullYear();
                month = $scope.date.getMonth()+1;
                $scope.title = $scope.month_name_UA[month]+' '+year;

                if($scope.num_week != $scope.current_week){
                    $scope.show_btn_now = 1;
                }else{
                    $scope.show_btn_now = 0;
                }

                dt = new Date($scope.date);  //chose date of week
                currentWeekDay = dt.getDay();
                lessDays = currentWeekDay == 0 ? 6 : currentWeekDay-1;
                wkStart = new Date(new Date(dt).setDate(dt.getDate()- lessDays));
                wkEnd = new Date(new Date(wkStart).setDate(wkStart.getDate()+6));
                str_st = wkStart.toString();
                day_start = str_st.split(' ')[2];
                str_end = wkEnd.toString();
                day_end =  str_end.split(' ')[2];

                ch_d = dt.toString();
                chose_day = ch_d.split(' ')[2];

                // if( day_start > 20 && day_end < 8 && chose_day < 8 ) {
                if( chose_day < 8 ) {
                    if( month == 1 ){
                        mon[0] = 12;
                        year[0] = year-1;
                        year[1] = year;
                    } else {
                        mon[0] = month-1;
                    }
                    mon[1] = month;
                    getFreeTimeConsultation( year, mon );

                // } else if( day_start > 20 && day_end < 8 && chose_day > 20 ) {
                } else if( chose_day > 20 ) {
                    mon[0] = month;
                    if( month == 12 ){
                        mon[1] = 1;
                        year[0] = year;
                        year[1] = year+1;
                    }else{
                        mon[1] = month+1;
                    }
                    getFreeTimeConsultation( year, mon );
                }
                getFreeTimeConsultation( year, month );

                for(var i=1; i<=7; i++){
                    date = getDayInWeek($scope.num_week, i, year);
                    year = date.getFullYear();
                    month = date.getMonth()+1;
                    day = date.getDate();

                    if(month < 10 && day < 10){
                        $scope.fullNameDays.push(year+'-0'+month+'-0'+day);
                    }else if(month < 10 && day > 9){
                        $scope.fullNameDays.push(year+'-0'+month+'-'+day);
                    }else{
                        $scope.fullNameDays.push(year+'-'+month+'-'+day);
                    }

                    date = date.toString();
                    name_day = (date.split(' ')[0])+' '+(date.split(' ')[2]);   // Mon 03
                    $scope.days.push(name_day);
                }
                $scope.second_scroll_tbody();
                return $scope.days;
            }
        };


            // create object with selected cell for save in DB
        $scope.result_arr = [];
        $scope.prev_checked_event = '';

        $scope.selectTime = function ( time, date, event ) {
            $scope.cansel_flag = 0;

            if( !check_past_day( date ) ){
                $scope.show_btn = 1;
                $scope.approve_tm = 0;
                var year, month, start_time, end_time;

                var checked_event = $scope.checkTimeForEvent( time, date );
                year = parseInt(date.split('-',1));
                month = parseInt((date.split('-')).splice(1,1));
                start_time = date+' '+time.split('-',1)+':00';
                end_time = date+' '+(time.split('-')).splice(1,1)+':00';

                if( checked_event == 'freeTime' && !event.ctrlKey ){   //  tm: 23:30-24:00 day: 2017-7-6
                    $jq("table tbody .selectingCell").removeClass("selectingCell");

                    if( this.selecting_cell == 1 ) {
                        $scope.approve_tm = 0;
                        $scope.show_btn = 0;
                        this.selecting_cell = 0;
                        $scope.save_tm = 1;
                        $scope.cansel_time();
                    }
                    this.selecting_cell = 1;
                    $scope.prev_checked_event = 'freeTime';
                    $scope.save_tm = 0;
                    $scope.confirm_time_arr = [];
                    $scope.confirm_time = {
                        time: time,
                        date: date
                    };
                    $scope.confirm_time_arr.push($scope.confirm_time);

                } else if( checked_event == 'confirmationTime' && !event.ctrlKey ){
                    $jq("table tbody .selectingCell").removeClass("selectingCell");
                    $scope.confirm_time_arr = [];

                    if( this.selecting_cell == 1 ) {
                        $scope.approve_tm = 0;
                        $scope.show_btn = 0;
                        this.selecting_cell = 0;
                        $scope.cansel_time();
                    } else {
                        this.selecting_cell = 1;
                        $scope.approve_tm = 1;
                        $scope.show_btn = 0;
                        $scope.prev_checked_event = 'confirmationTime';
                        $scope.confirm_time = {
                            time: time,
                            date: date
                        };
                        $scope.confirm_time_arr.push($scope.confirm_time);
                    }
                } else if( checked_event == 'consultationTime' && !event.ctrlKey ){
                    $jq("table tbody .selectingCell").removeClass("selectingCell");
                    $scope.confirm_time_arr = [];

                    if( this.selecting_cell == 1 ) {
                        $scope.approve_tm = 0;
                        $scope.show_btn = 0;
                        this.selecting_cell = 0;
                        $scope.cansel_time();
                    } else {
                        this.selecting_cell = 1;
                        $scope.save_tm = 0;
                        $scope.prev_checked_event = 'consultationTime';
                        $scope.confirm_time = {
                            time: time,
                            date: date
                        };
                        $scope.confirm_time_arr.push($scope.confirm_time);
                    }
                } else if( this.selecting_cell == 1 && !event.ctrlKey ){
                    $jq("table tbody .selectingCell").removeClass("selectingCell");
                    this.selecting_cell = 0;
                    $scope.save_tm = 1;
                    $scope.show_btn = 0;
                    $scope.approve_tm = 0;
                    $scope.prev_checked_event = '';
                    $scope.cansel_time();

                } else if( event.ctrlKey ){

                    if( event.ctrlKey && checked_event == 'confirmationTime' ){
                        if( this.selecting_cell == 1 ) {
                            $jq("table tbody .selectingCell").removeClass("selectingCell");
                            $scope.prev_checked_event = '';
                            $scope.confirm_time_arr = [];
                            $scope.approve_tm = 0;
                            $scope.show_btn = 0;
                            $scope.save_tm = 1;
                            $scope.cansel_time();
                        } else {

                            if( $scope.prev_checked_event != 'confirmationTime' ){
                                $jq("table tbody .selectingCell").removeClass("selectingCell");
                                $scope.prev_checked_event = 'confirmationTime';
                                $scope.selecting_cell = 0;
                                $scope.confirm_time_arr = [];
                            }
                            this.selecting_cell = 1;
                            $scope.approve_tm = 1;
                            $scope.show_btn = 0;
                            $scope.confirm_time = {
                                time: time,
                                date: date
                            };
                            $scope.confirm_time_arr.push($scope.confirm_time);
                        }
                    } else if( event.ctrlKey && checked_event == 'consultationTime'){

                        if( this.selecting_cell == 1 ) {
                            $jq("table tbody .selectingCell").removeClass("selectingCell");
                            $scope.prev_checked_event = '';
                            $scope.confirm_time_arr = [];
                            $scope.approve_tm = 0;
                            $scope.show_btn = 0;
                            $scope.save_tm = 1;
                        } else {

                            if( $scope.prev_checked_event != 'consultationTime' ){
                                $jq("table tbody .selectingCell").removeClass("selectingCell");
                                $scope.prev_checked_event = 'consultationTime';
                                $scope.selecting_cell = 0;
                                $scope.confirm_time_arr = [];
                            }
                            this.selecting_cell = 1;
                            $scope.approve_tm = 0;
                            $scope.show_btn = 1;
                            $scope.save_tm = 0;
                            $scope.confirm_time = {
                                time: time,
                                date: date
                            };
                            $scope.confirm_time_arr.push($scope.confirm_time);
                        }
                    } else if( event.ctrlKey && checked_event == 'freeTime' ) {
                        if( this.selecting_cell == 1 ){
                            $jq("table tbody .selectingCell").removeClass("selectingCell");
                            $scope.show_btn = 0;
                            this.selecting_cell = 0;
                            $scope.confirm_time_arr = [];
                            $scope.cansel_time();
                        } else {
                            if($scope.prev_checked_event != 'freeTime'){
                                $jq("table tbody .selectingCell").removeClass("selectingCell");
                                $scope.prev_checked_event = 'freeTime';
                                $scope.selecting_cell = 0;
                                $scope.confirm_time_arr = [];
                            }
                            $scope.show_btn = 1;
                            this.selecting_cell = 1;
                            $scope.save_tm = 0;

                            $scope.confirm_time = {
                                time: time,
                                date: date
                            };
                            $scope.confirm_time_arr.push($scope.confirm_time);
                        }
                    }else{

                        if(this.selecting_cell == 1){
                            $jq("table tbody .selectingCell").removeClass("selectingCell");
                            $scope.show_btn = 0;
                            this.selecting_cell = 0;
                            $scope.cansel_time();
                        }
                        if( $scope.prev_checked_event == 'freeTime' || $scope.prev_checked_event == 'consultationTime' ||
                            $scope.prev_checked_event == 'confirmationTime' ){
                            $jq("table tbody .selectingCell").removeClass("selectingCell");
                            $scope.cansel_time();
                            $scope.result_arr = [];
                            $scope.confirm_time_arr = [];
                        }
                        $scope.prev_checked_event = '';
                        $scope.show_btn = 1;
                        this.selecting_cell = 1;
                        $scope.save_tm = 1;

                        $scope.result = {
                            year: year,
                            month: month,
                            start_time: start_time,
                            end_time: end_time,
                            date: date,
                            status: 1
                        };
                        $scope.result_arr.push($scope.result);
                    }
                } else if( event.shiftKey ){
                    $jq("table tbody .selectingCell").removeClass("selectingCell");
                    $scope.cansel_time();
                    $scope.result_arr = [];
                    $scope.confirm_time_arr = [];
                    $scope.show_btn = 0;
                    this.selecting_cell = 1;
                    $scope.save_tm = 1;
                    $scope.prev_checked_event = '';

                } else if( !event.ctrlKey && !event.shiftKey && !( checked_event == 'freeTime') ) {
                    $scope.result_arr = [];
                    $scope.confirm_time_arr = [];
                    $jq("table tbody .selectingCell").removeClass("selectingCell");
                    $scope.show_btn = 1;
                    this.selecting_cell = 1;
                    $scope.save_tm = 1;
                    $scope.result = {
                        year: year,
                        month: month,
                        start_time: start_time,
                        end_time: end_time,
                        date: date,
                        status: 1
                    };

                    $scope.result_arr.push($scope.result);
                } else {
                    angular.element(document.querySelector(".selectingCell")).removeClass("selectingCell");
                    $jq("table tbody .selectingCell").removeClass("selectingCell");
                    $scope.cansel_time();
                }
            }
            return this.selecting_cell;
        };

            //  scroll table body after fist download page
        $scope.first_scroll_tbody = function () {
            setTimeout(function(){
                $jq('#table_consult tbody').scrollTop(596);
            }, 20);
        };

            //  scroll table body after choose day in calendar
        $scope.second_scroll_tbody = function () {
            setTimeout(function(){
                $jq('#table_consult tbody').scrollTop(0);
            }, 20);
        };


        $scope.fillContainer = function (data) {
            var container = angular.element(document.querySelector("#pageContainer"));
            container.html('');
            $compile(container.html(data))($scope);
        };


            // save free time of consultation in DB
        $scope.save_time = function(){
            $scope.show_btn = 0;
            //event.preventDefault();  // отмена перегрузки страницы по submit

            teacherConsultantService.saveTimeConsultation({result: $scope.result_arr})
                .$promise
                .then(function successCallback(data) {
                    $scope.fillContainer(data.data);
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        };


        $scope.cansel_time = function(){
            $scope.cansel_flag = 1;
            $scope.cansel_btn();
            $scope.show_btn = 0;
            $scope.result_arr = [];
            $scope.confirm_time_arr = [];
        };


        $scope.cansel_btn = function () {
            if(this.selecting_cell == 1 && $scope.cansel_flag == 1){
                this.selecting_cell = 0;
                return 1;
            }else{
                return 0;
            }
        };


            //come back to current week
        $scope.back_today = function () {
            $scope.show_btn_now = 0;
            $scope.days = [];
            $scope.fullNameDays = [];
            $scope.showTime();
            $scope.second_scroll_tbody();
        };


            // create time array for view
        for( var i=0; i<24; i++ ){
            var j = i+1;
            $scope.time.push(i.toString()+':00'+'-'+i.toString()+':30');
            $scope.time.push(i.toString()+':30'+'-'+j.toString()+':00');
        }


            //approve time for consultation
        $scope.approve_time_cons = function(){
            $scope.approve_tm = 0;
            var length = $scope.free_time_id.length;
            var length_confirm_arr = $scope.confirm_time_arr.length;
            var result = [];
            var cons_time = {};
            var cons_map = {};
            var temp_arr = [];
            var key = '';
            var k = 0;

            for( var i=0; i<length_confirm_arr; i++ ){
                for( var j=0; j<length; j++ ){
                    if( stringCompare($scope.confirm_time_arr[i].time, $scope.free_time_id[j].time) &&
                        stringCompare($scope.confirm_time_arr[i].date, $scope.free_time_id[j].date) ) {

                        if( !($scope.free_time_id[j].student_id in cons_map) ) {
                            temp_arr = 'Дата: '+$scope.free_time_id[j].date+'; години: '+$scope.free_time_id[j].time+'; лекція: '
                                        +$scope.free_time_id[j].lecture_name;
                            key = $scope.free_time_id[j].student_id.toString();
                            cons_map[key] = new Array(temp_arr);
                        } else {
                            temp_arr = 'Дата: '+$scope.free_time_id[j].date+'; години: '+$scope.free_time_id[j].time+'; лекція: '
                                +$scope.free_time_id[j].lecture_name;
                            key = $scope.free_time_id[j].student_id.toString();
                            cons_map[key].push(temp_arr);
                        }
                        cons_time.map = cons_map;
                        result[k] = $scope.free_time_id[j].id;
                        k++;
                        result.push(cons_time);
                    }
                }
            }

            teacherConsultantService.approveTimeConsultation( {'result': result} )
                .$promise
                .then(function successCallback(data) {
                    $scope.fillContainer(data.data);
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        };


            //delete chose cell and cells of time
        $scope.delete_times = function() {
            var length = $scope.free_time_id.length;
            var length_conf = $scope.confirm_time_arr.length;
            var del_time_arr = [];
            var temp = {};
            var cons_map = {};
            var temp_arr = [];
            var key = '';
            var k = 0;

            for( var i=0; i<length_conf; i++ ){
                for( var j=0; j<length; j++ ){
                    if( stringCompare($scope.confirm_time_arr[i].time, $scope.free_time_id[j].time) &&
                        stringCompare($scope.confirm_time_arr[i].date, $scope.free_time_id[j].date) ) {
                        if( $scope.free_time_id[j].status == 2 || $scope.free_time_id[j].status == 3 ){
                            if( !($scope.free_time_id[j].student_id in cons_map) ) {
                                temp_arr = 'Дата: '+$scope.free_time_id[j].date+'; години: '+$scope.free_time_id[j].time+'; лекція: '
                                    +$scope.free_time_id[j].lecture_name;
                                key = $scope.free_time_id[j].student_id.toString();
                                cons_map[key] = new Array(temp_arr);
                            } else {
                                temp_arr = 'Дата: '+$scope.free_time_id[j].date+'; години: '+$scope.free_time_id[j].time+'; лекція: '
                                    +$scope.free_time_id[j].lecture_name;
                                key = $scope.free_time_id[j].student_id.toString();
                                cons_map[key].push(temp_arr);
                            }
                        }
                        temp.map = cons_map;
                        temp[k] = $scope.free_time_id[j].id;
                        k++;
                        del_time_arr.push(temp);
                    }
                }
            }

            del_time_arr = del_time_arr.splice(0,1);

            teacherConsultantService.deleteTimeConsultation( {'del_time_arr': del_time_arr} )
                .$promise
                .then(function successCallback(data) {
                    $scope.fillContainer(data.data);
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        };

            // номер текущей недели
        Date.prototype.getWeek = function () {
            var target  = new Date(this.valueOf());
            var dayNr   = (this.getDay() + 6) % 7;
            target.setDate(target.getDate() - dayNr + 3);
            var firstThursday = target.valueOf();
            target.setMonth(0, 1);
            if (target.getDay() != 4) {
                target.setMonth(0, 1 + ((4 - target.getDay()) + 7) % 7);
            }
            return 1 + Math.ceil((firstThursday - target) / 604800000);
        };


            //недели и дни с еденицы, в русском варианте
        function getDayInWeek (week,day,year) {
            var w=week||1,n=day||1,y=year||new Date().getFullYear(); //default
            var d=new Date(y,0,7*w);
            d.setDate(d.getDate()-(d.getDay()||7)+n);
            return d;
        }


            //check past day
        function check_past_day( day ) {
            var year_now = parseInt($scope.current_day.split('-')[0]);
            var month_now = parseInt($scope.current_day.split('-')[1]);
            var day_now = parseInt($scope.current_day.split('-')[2]);

            var check_year = parseInt(day.split('-')[0]);
            var check_month = parseInt(day.split('-')[1]);
            var check_day = parseInt(day.split('-')[2]);

            if( year_now > check_year || month_now > check_month ){
               return true;
            }else{

                if(month_now == check_month && day_now > check_day){
                    return true;
                }else{
                    return false;
                }
            }
        }


        $scope.checkTimeForEvent = function (tm, day) {

            if( check_past_day( day ) ){
                this.past_day = 1;
            }else{
                this.past_day = 0;
            }

            for(var key in $scope.free_time_id) {

                if(stringCompare(tm, $scope.free_time_id[key].time) && stringCompare(day, $scope.free_time_id[key].date)){

                    if($scope.free_time_id[key].status == 1){

                        return 'freeTime';
                    }else if($scope.free_time_id[key].status == 2){

                        $scope.show_popup = $scope.free_time_id[key].student_name+"\n"+$scope.free_time_id[key].lecture_name;
                        return 'confirmationTime';
                    }else if($scope.free_time_id[key].status == 3){

                        $scope.show_popup = $scope.free_time_id[key].student_name+"\n"+$scope.free_time_id[key].lecture_name;
                        return 'consultationTime';
                    }
                }
            }
        };


        function stringCompare(str, str2) {
            return !!(~str.indexOf(str2)); // if str == str2 return true;
        }


        function getFreeTimeConsultation(year, month) {
            teacherConsultantService.getTeacherCalendarConsultation({'year':year, 'month': month})
                .$promise
                .then(
                    function successCallback( data ){
                        var deferred = $q.defer();
                        var temp = data;
                        var data_db_length = temp.length;
                        var time = [];
                        var full_date;
                        var full_date_prev;
                        var full_date_next;
                        var counter = 0;

                        for(var i = 0; i < data_db_length; i++){
                            full_date = temp[i].start_time.split(' ', 1).join();  // ++  2017-07-03

                            var array = temp[i].start_time.split(' ');  // ++ ["2017-07-03", "15:30:00"]
                            var full_time = array.splice(1,1);  // ++ ["15:30:00"]
                            var temp_str_tm = full_time.join(); //  ++ 15:30:00
                            temp_str_tm = temp_str_tm.split(':');  // ++ ["15", "30", "00"]
                            temp_str_tm.splice(2, 1); // ++ ["15", "30"]
                            temp_str_tm[0] = parseInt(temp_str_tm[0]);
                            var hour_str = parseInt(temp_str_tm[0]);
                            var min_str = parseInt(temp_str_tm[1]);
                            var array2 = temp[i].end_time.split(' ');  // ++ ["2017-07-03", "16:00:00"]
                            var full_time2 = array2.splice(1,1);  // ++ ["16:00:00"]
                            var temp_end_tm = full_time2.join(); //  ++ 16:00:00
                            temp_end_tm = temp_end_tm.split(':');  // ++ ["16", "30", "00"]
                            temp_end_tm.splice(2, 1); // ++ ["16", "30"]
                            temp_end_tm[0] = parseInt(temp_end_tm[0]);
                            var hour_end = parseInt(temp_end_tm[0]);
                            var min_end = parseInt(temp_end_tm[1]);
                            var total_time = '';
                            total_time = temp_str_tm.join(":")+'-'+temp_end_tm.join(":");  // ++ 15:30-16:00
                            if( hour_str == hour_end && min_str == 0 && min_end == 30 || hour_str+1 == hour_end && min_end == 0 && min_str == 30 ){
                                time.push(total_time);
                                $scope.free_time_id[i+counter] = {
                                    id: temp[i].id,
                                    time: total_time,
                                    date: full_date,
                                    status: temp[i].status,
                                    student_id: temp[i].student_id,
                                    student_name: temp[i].student_name,
                                    lecture_name: temp[i].lecture_name,
                                    repeat: 0
                                };

                                var str_min = parseInt(temp_str_tm[1]);
                                var end_tm_arr = [];
                                var start_tm_arr = temp_str_tm;
                                var j = 1;
                                var x = 1;

                                if( str_min == 0 ){

                                    end_tm_arr = [];
                                    start_tm_arr = temp_str_tm;
                                    j = 1;
                                    x = 1;
                                    do{
                                        if(j%2){
                                            start_tm_arr[1] = "00";
                                            end_tm_arr[0] = start_tm_arr[0];
                                            end_tm_arr[1] = "30";
                                            total_time = start_tm_arr.join(":")+'-'+end_tm_arr.join(":");  // ++ 15:30-16:00
                                            time.push(total_time);
                                            $scope.free_time_id[i+counter] = {
                                                id: temp[i].id,
                                                time: total_time,
                                                date: full_date,
                                                status: temp[i].status,
                                                student_id: temp[i].student_id,
                                                student_name: temp[i].student_name,
                                                lecture_name: temp[i].lecture_name,
                                                repeat: j
                                            };
                                            counter += x;
                                            j++;
                                        }else{
                                            start_tm_arr[0] = end_tm_arr[0];
                                            start_tm_arr[1] = end_tm_arr[1];
                                            end_tm_arr[0] = start_tm_arr[0]+x;
                                            end_tm_arr[1] = "00";
                                            total_time = start_tm_arr.join(":")+'-'+end_tm_arr.join(":");  // ++ 15:30-16:00
                                            time.push(total_time);

                                            $scope.free_time_id[i+counter] = {
                                                id: temp[i].id,
                                                time: total_time,
                                                date: full_date,
                                                status: temp[i].status,
                                                student_id: temp[i].student_id,
                                                student_name: temp[i].student_name,
                                                lecture_name: temp[i].lecture_name,
                                                repeat: j
                                            };
                                            start_tm_arr[0] = start_tm_arr[0]+x;
                                            counter += x;
                                            j++;
                                        }
                                    }while(!stringCompare(temp_end_tm.join(":"), end_tm_arr.join(":")));
                                    counter -=1;
                                }else{

                                    end_tm_arr = [];
                                    start_tm_arr = temp_str_tm;
                                    j = 1;
                                    x = 1;
                                    do{
                                        if( j % 2 ){
                                            start_tm_arr[1] = "30";
                                            end_tm_arr[0] = start_tm_arr[0]+x;
                                            end_tm_arr[1] = "00";
                                            total_time = start_tm_arr.join(":")+'-'+end_tm_arr.join(":");  // ++ 15:30-16:00
                                            time.push(total_time);
                                            $scope.free_time_id[i+counter] = {
                                                id: temp[i].id,
                                                time: total_time,
                                                date: full_date,
                                                status: temp[i].status,
                                                student_id: temp[i].student_id,
                                                student_name: temp[i].student_name,
                                                lecture_name: temp[i].lecture_name,
                                                repeat: j
                                            };
                                            counter += x;
                                            j++;
                                        }else{
                                            start_tm_arr[0] = end_tm_arr[0];
                                            start_tm_arr[1] = end_tm_arr[1];
                                            end_tm_arr[0] = start_tm_arr[0];
                                            end_tm_arr[1] = "30";
                                            total_time = start_tm_arr.join(":")+'-'+end_tm_arr.join(":");  // ++ 15:30-16:00
                                            time.push(total_time);
                                            $scope.free_time_id[i+counter] = {
                                                id: temp[i].id,
                                                time: total_time,
                                                date: full_date,
                                                status: temp[i].status,
                                                student_id: temp[i].student_id,
                                                student_name: temp[i].student_name,
                                                lecture_name: temp[i].lecture_name,
                                                repeat: j
                                            };
                                            counter += x;
                                            j++;
                                        }
                                    }while( !stringCompare(temp_end_tm.join(":"), end_tm_arr.join(":")) );
                                    counter -= 1;
                                }
                            }

                            if( i > 0 && (i+1) < data_db_length ){
                                full_date_prev =  temp[i-1].start_time.split(' ', 1).join();    // ++  2017-07-03
                                full_date_next = temp[i+1].start_time.split(' ', 1).join(); // ++  2017-07-05

                                if( stringCompare(full_date, full_date_prev) ){
                                    full_date = temp[i].start_time.split(' ', 1).join();
                                    full_date_next = temp[i+1].start_time.split(' ', 1).join();

                                    if( !stringCompare(full_date, full_date_next) ){
                                        $scope.free_time[full_date] = time;
                                        time = [];
                                    }
                                }else if(stringCompare(full_date, full_date_next)){

                                }else{
                                    $scope.free_time[full_date] = time;
                                    time = [];
                                }

                            }else if( i==0 ){
                                if(temp.length > 1){
                                    full_date_next = temp[i+1].start_time.split(' ', 1).join(); // ++  2017-07-04
                                    if( !stringCompare(full_date, full_date_next) ){
                                        $scope.free_time[full_date] = time;
                                        time = [];
                                        $scope.free_time[full_date].id = temp[i].id;
                                    }
                                }else{
                                    $scope.free_time[full_date] = time;
                                    time = [];
                                    $scope.free_time[full_date].id = temp[i].id;
                                }
                            }else if(i==(data_db_length-1)){
                                $scope.free_time[full_date] = time;
                            }
                        }
                        deferred.resolve($scope.free_time);
                        return deferred.promise;
                    },
                    function errorCallback(error, status){
                        $scope.data.error = { message: error, status: status };
                        console.log( $scope.data.error.status );
                    }
                );
        }
    })

    .directive('calendar', function(){
        'use strict';
        return{
            restrict: 'EA',
            replace: true,
            templateUrl: basePath+'/angular/js/teacher/templates/calendar/week.html',
            controller: 'calendarCtrl',
            link: function(scope, element, attrs, ctrls){

            }
        }
    });