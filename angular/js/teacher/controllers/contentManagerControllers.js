/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('sendCoworkerRequestCtrl',sendCoworkerRequestCtrl)
    .controller('allAuchtorsCtrl', function ($scope){
        initAuthorsTableCM();
    })
    .controller('allConsultantsCtrl', function ($scope){
        initConsultantsTable();
    })
    .controller('allTeachersConsultantsCtrl', function ($scope){
        initTeacherConsultantsTableCM();
    })
    .controller('statusOfModulesCtrl', function ($scope, $resource, NgTableParams, $stateParams){

        var modulesTable = $resource(basePath + '/_teacher/_content_manager/contentManager/getModulesList');
        var coursesTable = $resource(basePath + '/_teacher/_content_manager/contentManager/getCourseslist');
        
        $scope.initModulesList = function (){
            $scope.AllModulesTable = new NgTableParams({
                page: 1,
                count: 10,
                sorting:{title:'asc'},
                type:'all',
                courseId:$stateParams.courseId
            }, {
                getData: function(params) {
                    return modulesTable.get(params.url()).$promise.then(function(data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };
        $scope.initModuleWithoutVideos = function (){
            $scope.ModulesWithoutVideo = new NgTableParams({
                page: 1,
                count: 10,
                sorting:{title:'asc'},
                type:'withoutVideos',
                courseId:$stateParams.courseId
            }, {
                getData: function(params) {
                    return modulesTable.get(params.url()).$promise.then(function(data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };
        $scope.initModuleWithoutTests = function (){
            $scope.ModulesWithoutTests = new NgTableParams({
                page: 1,
                count: 10,
                sorting:{title:'asc'},
                type:'withoutTests',
                courseId:$stateParams.courseId
            }, {
                getData: function(params) {
                    return modulesTable.get(params.url()).$promise.then(function(data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };
        $scope.initModuleWithoutVideosAndTests = function (){
            $scope.ModulesWithoutVideoAndTests = new NgTableParams({
                page: 1,
                count: 10,
                sorting:{title:'asc'},
                type:'withoutVideosAndTests',
                courseId:$stateParams.courseId
            }, {
                getData: function(params) {
                    return modulesTable.get(params.url()).$promise.then(function(data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };


        //////////////////////

        $scope.initCoursesList = function (){
            $scope.AllModulesTable = new NgTableParams({
                page: 1,
                count: 10,
                sorting:{title:'asc'},
                type:'all'
            }, {
                getData: function(params) {
                    return coursesTable.get(params.url()).$promise.then(function(data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };
        $scope.initCoursesWithoutVideos = function (){
            $scope.ModulesWithoutVideo = new NgTableParams({
                page: 1,
                count: 10,
                sorting:{title:'asc'},
                type:'withoutVideos',
            }, {
                getData: function(params) {
                    return coursesTable.get(params.url()).$promise.then(function(data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };
        $scope.initCoursesWithoutTests = function (){
            $scope.ModulesWithoutTests = new NgTableParams({
                page: 1,
                count: 10,
                sorting:{title:'asc'},
                type:'withoutTests',
            }, {
                getData: function(params) {
                    return coursesTable.get(params.url()).$promise.then(function(data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };
        $scope.initCoursesWithoutVideosAndTests = function (){
            $scope.ModulesWithoutVideoAndTests = new NgTableParams({
                page: 1,
                count: 10,
                sorting:{title:'asc'},
                type:'withoutVideosAndTests',
            }, {
                getData: function(params) {
                    return coursesTable.get(params.url()).$promise.then(function(data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };
        
    })
    .controller('statusOfCoursesCtrl', function ($scope){
        //initCoursesListTable(0);
        //initCoursesListTable(1);
        //initCoursesListTable(2);
        //initCoursesListTable(3);
    })
    .controller('moduleDetailCtrl', function ($stateParams){
        initLessonsListTable($stateParams.idModule);
    })
    .controller('lessonDetailCtrl', function ($stateParams){
        initPartsListTable($stateParams.idLesson);
    });

function sendCoworkerRequestCtrl ($http, $scope, $state) {
    $scope.changePageHeader('Запит на призначення співробітника');

    $scope.sendCoworkerRequest=function () {
        user = $jq('#userId').val();
        if(user == 0){
            bootbox.alert("Виберіть користувача.");
        } else {
            $http({
                method: 'POST',
                url: basePath+'/_teacher/_content_manager/contentManager/sendRequest',
                data: $jq.param({user: user}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function successCallback(response) {
                bootbox.confirm(response.data, function () {
                    $state.reload();
                });
            }, function errorCallback() {
                bootbox.alert("Запит не вдалося надіслати");
            });
        }
    }
}