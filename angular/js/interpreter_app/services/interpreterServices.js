/**
 * Created by Wizlight on 21.01.2016.
 */
angular
    .module('interpreterModule',[])
    .service('interpreterServices', [
        '$http','$filter',
        function($http, $filter) {
            var self = this;
            this.sendAnswerJson = function (url,lng,id,code,sessionId,jobid) {
                $('#ajaxLoad').show();
                var startJson={
                    "operation": "start",
                    "token": sessionId,
                    "session" : sessionId,
                    "jobid" : jobid,
                    "code" : code,
                    "task": id,
                    "lang": lng
                };
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: JSON.stringify(startJson),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data.status;
                }, function errorCallback() {
                    return 'error';
                });
                return promise;
            };
            this.getResultJson = function (url,lng,id,code,sessionId,jobid) {
                var resultJson={
                    "operation": "result",
                    "token": sessionId,
                    "session" : sessionId,
                    "jobid" : jobid,
                    "task": id,
                    "lang": lng
                };
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: JSON.stringify(resultJson),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    return 'error';
                });
                return promise;
            };
            this.getJson = function (id,url) {
                var json={
                    "operation": "getJson",
                    "task": id
                };
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: JSON.stringify(json),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data.status=='success'){
                        return response.data.json;
                    }
                }, function errorCallback() {
                    bootbox.alert("Вибачте, але на сайті виникла помилка і отримати дані не вдалося. Зв'яжіться з адміністрацією сайту.");
                });
                return promise;
            };
            this.getTaskVariables = function (id,url) {
                var promise = this.getJson(id,url).then(function successCallback(response) {
                    //replace space symbols for json
                    var result = $filter('interpreterJsonFilter')(response);

                    var type, arg_type,res_type;
                    var variable = [];
                    for(var i=0;i<result.function.args.length;i++){
                        type=result.function.args[i]['type'];
                        arg_type=getType(type);
                        variable.push({
                            arg:result.function.args[i]['arg_name'],
                            type:arg_type,
                            array:result.function.args[i]['is_array'],
                            size:result.function.args[i]['size'],
                        });
                    }
                    res_type=getType(result.function.type);
                    var fullData = {
                        res_type:res_type,
                        res_array:result.function.array_type,
                        res_size:result.function.size,
                        input_variables:variable
                    };
                    return fullData;
                }, function errorCallback() {
                    bootbox.alert("Вибачте, але на сайті виникла помилка і отримати дані не вдалося. Зв'яжіться з адміністрацією сайту.");
                });
                return promise;
            };
            this.sendJson = function (url,jsonTask) {
                var promise =$http({
                    url: url,
                    method: "POST",
                    data: JSON.stringify(jsonTask),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $('#ajaxLoad').hide();
                    if(response.data.status=='updated') {
                        bootbox.alert("Зміни юніттестів успішно скомпільовані");
                        return true;
                    } else if(response.data.status=='success') {
                        bootbox.alert("Додані юніттести успішно скомпільовані");
                        return true;
                    } else if(response.data.status=='failed') {
                        bootbox.alert("Змін в юніттестах не відбулося");
                        return true;
                    } else {
                        bootbox.alert("Виникла помилка при компіляції:"+"<br/>"+response.data.status+"<br/>"+
                            "Якщо юніттест редагується за межами форми юніттестів, можливо вибрана мова не відповідає юніттестам");
                        return false;
                    }
                }, function errorCallback() {
                    $('#ajaxLoad').hide();
                    bootbox.alert("Вибач, але на сайті виникла помилка при редагуванні юніттестів. Спробуй пізніше або зв'яжись з адміністратором сайту.");
                    return false;
                });
                return promise;
            };

            this.editInterpreterTask = function (url,jsonTask,idTask) {
                $('#ajaxLoad').center().show();
                $http({
                    url: basePath+'/interpreter/editTask',
                    method: "POST",
                    data: $.param({
                        json: JSON.stringify(jsonTask),
                        idTask: idTask,
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data) {
                        $('#ajaxLoad').hide();
                        bootbox.alert(response.data, function () {
                            location.reload();
                        });
                    } else{
                        self.sendJson(url,jsonTask);
                    }
                }, function errorCallback(response) {
                    $('#ajaxLoad').hide();
                    console.log(response);
                    bootbox.alert("Вибач, але виникла помилка при отримані інформації про стан задачі даної ревізії. Спробуй пізніше або зв'яжись з адміністратором сайту.");
                });
            };


        }
    ]);

function getType(type) {
    switch (type) {
        case 0:
            return 'integer';
            break;
        case 1:
            return 'float';
            break;
        case 2:
            return 'bool';
            break;
        case 3:
            return 'string';
            break;
        case 4:
            return 'char';
            break;
        case 5:
            return 'range';
            break;
    }
}

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ($(window).scrollTop() + 50 + "px"));
    this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
    return this;
}