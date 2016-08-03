angular
    .module('courseRevisionsApp')
    .service('courseRevisionsActions', [
        '$http',
        function($http) {
            var self = this;
            this.sendCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/sendForApproveCourse',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data!='') {
                        if(typeof redirectFromEdit!='undefined'){
                            return response.data;
                        }else{
                            bootbox.alert(response.data);
                            return false;
                        }
                    }
                }, function errorCallback() {
                    bootbox.alert("Відправити ревізію на затвердження не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.cancelSendCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/cancelSendForApproveCourse',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відмінити відправлення ревізії на затвердження не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.approveCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/approveCourseRevision',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Затвердити ревізію не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.rejectCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/rejectCourseRevision',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відхилити відправку на затвердження не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.cancelCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/cancelCourseRevision',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Скасувати ревізію не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.cancelCourseEditByEditor = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/cancelEditCourseRevisionByEditor',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відмінити ревізію не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.restoreCourseEditByEditor = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/restoreEditCourseRevisionByEditor',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відновити ревізію автором не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.releaseCourseRevision = function(id, confirmRevision) {
                if(typeof confirmRevision=='undefined') confirmRevision=false;
                var promise = $http({
                    url: basePath+'/courseRevision/readyCourseRevision',
                    method: "POST",
                    data: $.param({idRevision: id, confirmRevision: confirmRevision}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data!='') {
                        bootbox.confirm(response.data, function(result) {
                            if(result)
                                self.releaseCourseRevision(id, true).then(function(){
                                    location.reload();
                            });
                        });
                    }
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відправити на реліз ревізію не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
        }
    ]);