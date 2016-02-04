/**
 * Created by Wizlight on 21.01.2016.
 */
angular
    .module('lessonApp')
    .service('startJson', [
        '$http',
        function($http) {
            this.startJson = function (url,lng,id,code,sessionId,jobid) {
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
                //console.log(startJson.jobid);
                //var startJson={
                //    "operation": "start",
                //    "token": "-8668338574358268261",
                //    "session" : "4294947",
                //    "jobid" : "42949295",
                //    "code" : "var array = new Array( 10.0, 10.0);return array;",
                //    "task": "119",
                //    "lang": "js"
                //};
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: startJson,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    console.log(response);
                    return response.statusText;
                    //var resultJS={
                    //    "operation": "result",
                    //    "token": "-8668338574358268261",
                    //    "session" : "4294947",
                    //    "jobid" : "42949295",
                    //    "task": "119",
                    //    "lang": "js"
                    //};
                    //var promiseResult = $http({
                    //    url: url,
                    //    method: "POST",
                    //    data: JSON.stringify(resultJS),
                    //    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    //}).then(function successCallback(responseResult) {
                    //    console.log(responseResult.data);
                    //},function errorCallback() {
                    //    alert("resultJS error");
                    //});
                    //console.log('!!!');
                    //console.log(promiseResult);
                }, function errorCallback() {
                    alert("Вибачте, але на сайті виникла помилка і додати задачу до заняття наразі неможливо. Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
                });
                return promise;
            };
        }
    ]);