/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .service('pagesUpdateService', [
        '$rootScope','$http',
        function($rootScope, $http) {
            this.pagesDataUpdate = function (){
                $http({
                    url: basePath + '/lesson/GetPageData',
                    method: "POST",
                    data: $.param({lecture: idLecture}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function(response){
                    $rootScope.pageData = response.data;
                    var count = $rootScope.pageData.length;

                    for (var i = 0; i < count; i++) {
                        if (i == (count - 1) && $rootScope.pageData[i]['isDone']){
                            $rootScope.lastAccessPage = i+1;
                            break;
                        }
                        if ($rootScope.pageData[i]['isDone'] && !$rootScope.pageData[i+1]['isDone']){
                            $rootScope.lastAccessPage = i+1;
                            break;
                        }
                    }
                });
            };
            this.getFinishedModule = function () {
                $http({
                    url: basePath + '/lesson/GetModulesLastPage',
                    method: "POST",
                    data: $.param({moduleId: idModule, editMode: editMode}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $rootScope.moduleFinished = response.data.icoPath+'medalIco.png';
                    if (!response.data.access) {
                        $rootScope.moduleFinished = response.data.icoPath+'medalIcoFalse.png';
                    } else {
                        for (var i = 0; i < response.data.lectures.length; i++) {
                            if (!response.data.lectures[i].isDone || !response.data.lectures[i].isQuizDone) {
                                $rootScope.moduleFinished = response.data.icoPath+'medalIcoFalse.png';
                                break;
                            }
                        }
                    }
                }, function errorCallback() {
                    return 'error GetModulesLastPage';
                });
            };
        }
    ]);