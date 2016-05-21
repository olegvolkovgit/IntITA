/**
 * Created by Wizlight on 21.01.2016.
 */
angular
    .module('lecturePreviewRevisionApp')
    .service('userAnswerTaskService', [
        '$http',
        function($http) {
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
        }
    ]);