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
        var User = $resource(basePath + '/_teacher/_content_manager/contentManager/getModulesList');
        User.get().$promise.then(function(data){
            $scope.AllModulesTable = new NgTableParams({}, {
                dataset: data.allModules.rows
            });
            $scope.ModulesWithoutVideo = new NgTableParams({}, {
                dataset: data.withoutVideos.rows
            });
            $scope.ModulesWithoutTests= new NgTableParams({}, {
                dataset: data.withoutTests.rows
            });
            $scope.ModulesWithoutVideoAndTests = new NgTableParams({}, {
                dataset: data.withoutVideosAndTests.rows
            });
        });


        //initModulesListTable($stateParams.idModule,'0');
        //initModulesListTable($stateParams.idModule,'1');
        //initModulesListTable($stateParams.idModule,'2');
        //initModulesListTable($stateParams.idModule,'3');
    })
    .controller('statusOfCoursesCtrl', function ($scope){
        initCoursesListTable(0);
        initCoursesListTable(1);
        initCoursesListTable(2);
        initCoursesListTable(3);
    })
    .controller('moduleDetailCtrl', function ($stateParams){
        initLessonsListTable($stateParams.idModule);
    })
    .controller('lessonDetailCtrl', function ($stateParams){
        initPartsListTable($stateParams.idLesson);
    });