angular
    .module('lessonApp')
    .service('progressServices', [
        '$http',
        function($http) {
            this.createRatingUserModule = function(idModule) {
                $http({
                    url: basePath+'/lesson/createRatingUserModuleRecord',
                    method: "POST",
                    data: $.param({moduleId:idModule}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(){
                }, function errorCallback() {
                    console.log('Error createRatingUserModule');
                });
            };
        }
    ]);