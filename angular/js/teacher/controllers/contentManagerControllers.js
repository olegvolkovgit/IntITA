/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('allAuchtorsCtrl', function ($scope){
        initAuthorsTableCM();
    })
    .controller('allConsultantsCtrl', function ($scope){
        initConsultantsTable();
    })
    .controller('allTeachersConsultantsCtrl', function ($scope){
        initTeacherConsultantsTableCM();
    })
    .controller('statusOfModulesCtrl', function ($scope, $resource, NgTableParams){

        var countOfModules = null;
        var countOfModulesWithoutVideos = null;
        var countOfModulesWithoutTests = null;
        var countOfModulesWithoutVideosAndTests = null;
        var modules = $resource(basePath + '/_teacher/_content_manager/contentManager/getCounts?type=modules');
        var courses = $resource(basePath + '/_teacher/_content_manager/contentManager/getCounts?type=courses');
        var modulesTable = $resource(basePath + '/_teacher/_content_manager/contentManager/getModulesList');
        var coursesTable = $resource(basePath + '/_teacher/_content_manager/contentManager/getCourseslist');

        function initCounts(resource){
            resource.get().$promise.then(function(data){
                countOfModules = data.countOfModules;
                countOfModulesWithoutVideos = data.countOfModulesWithoutVideos;
                countOfModulesWithoutTests = data.countOfModulesWithoutTests;
                countOfModulesWithoutVideosAndTests = data.countOfModulesWithoutVideosAndTests;

            });
        }

        $scope.initModulesList = function (){
            initCounts(modules);
            $scope.AllModulesTable = new NgTableParams({
                page: 1,
                count: 10,
                type:'all',
            }, {
                getData: function(params) {
                    return modulesTable.get(params.url()).$promise.then(function(data) {
                        params.total(countOfModules);
                        return data.rows[0];
                    });
                }
            });
        };
        $scope.initModuleWithoutVideos = function (){
            $scope.ModulesWithoutVideo = new NgTableParams({
                page: 1,
                count: 10,
                type:'withoutVideos',
            }, {
                getData: function(params) {
                    return modulesTable.get(params.url()).$promise.then(function(data) {
                        params.total(countOfModulesWithoutVideos);
                        return data.rows[0];
                    });
                }
            });
        };
        $scope.initModuleWithoutTests = function (){
            $scope.ModulesWithoutTests = new NgTableParams({
                page: 1,
                count: 10,
                type:'withoutTests',
            }, {
                getData: function(params) {
                    return modulesTable.get(params.url()).$promise.then(function(data) {
                        params.total(countOfModulesWithoutTests);
                        return data.rows[0];
                    });
                }
            });
        };
        $scope.initModuleWithoutVideosAndTests = function (){
            $scope.ModulesWithoutVideoAndTests = new NgTableParams({
                page: 1,
                count: 10,
                type:'withoutVideosAndTests',
            }, {
                getData: function(params) {
                    return modulesTable.get(params.url()).$promise.then(function(data) {
                        params.total(countOfModulesWithoutVideosAndTests);
                        return data.rows[0];
                    });
                }
            });
        };


        //////////////////////

        $scope.initCoursesList = function (){
            initCounts(courses);
            $scope.AllModulesTable = new NgTableParams({
                page: 1,
                count: 10,
                type:'all',
            }, {
                getData: function(params) {
                    return coursesTable.get(params.url()).$promise.then(function(data) {
                        params.total(countOfModules);
                        return data.rows[0];
                    });
                }
            });
        };
        $scope.initCoursesWithoutVideos = function (){
            $scope.ModulesWithoutVideo = new NgTableParams({
                page: 1,
                count: 10,
                type:'withoutVideos',
            }, {
                getData: function(params) {
                    return coursesTable.get(params.url()).$promise.then(function(data) {
                        params.total(countOfModulesWithoutVideos);
                        return data.rows[0];
                    });
                }
            });
        };
        $scope.initCoursesWithoutTests = function (){
            $scope.ModulesWithoutTests = new NgTableParams({
                page: 1,
                count: 10,
                type:'withoutTests',
            }, {
                getData: function(params) {
                    return coursesTable.get(params.url()).$promise.then(function(data) {
                        params.total(countOfModulesWithoutTests);
                        return data.rows[0];
                    });
                }
            });
        };
        $scope.initCoursesWithoutVideosAndTests = function (){
            $scope.ModulesWithoutVideoAndTests = new NgTableParams({
                page: 1,
                count: 10,
                type:'withoutVideosAndTests',
            }, {
                getData: function(params) {
                    return coursesTable.get(params.url()).$promise.then(function(data) {
                        params.total(countOfModulesWithoutVideosAndTests);
                        return data.rows[0];
                    });
                }
            });
        };

        //initModulesListTable($stateParams.idModule,'0');
        //initModulesListTable($stateParams.idModule,'1');
        //initModulesListTable($stateParams.idModule,'2');
        //initModulesListTable($stateParams.idModule,'3');
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