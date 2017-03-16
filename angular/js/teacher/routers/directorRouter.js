angular
    .module('directorRouter',['ui.router'])
    .config(function ($stateProvider) {
    $stateProvider
        .state('director', {
            url: "/director",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Директор');
            },
            templateUrl: basePath+"/_teacher/_director/director/index",
        })
        .state('director.courses', {
            url: '/courses',
            views: {
                '@': {
                    templateUrl: basePath+"/_teacher/courseManage/coursesList",
                }
            }
        })
        .state('director.courses.course', {
            url: '/course/:id',
            views: {
                '@': {
                    templateUrl: function ($stateParams) {
                        return basePath+"/_teacher/courseManage/view?id="+$stateParams.id;
                    }
                }
            }
        })
        .state('director.modules', {
            url: '/modules',
            views: {
                '@': {
                    templateUrl: basePath+"/_teacher/moduleManage/modulesList",
                }
            }
        })
        .state('director.modules.module', {
            url: '/module/:moduleId',
            views: {
                '@': {
                    templateUrl: function ($stateParams) {
                        return basePath+"/_teacher/moduleManage/view?id="+$stateParams.moduleId;
                    }
                }
            }
        })
        .state('director.lectures', {
            url: '/lectures',
            views: {
                '@': {
                    templateUrl: basePath+"/_teacher/lecture/lecturesList",
                }
            }
        })
});