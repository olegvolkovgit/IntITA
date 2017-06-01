/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('superVisorRouter', ['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('supervisor', {
            url: "/supervisor",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Supervisor');
            },
            templateUrl: basePath+"/_teacher/cabinet/loadPage/?page=supervisor",
        })
        .state('supervisor/offlineGroups', {
            url: "/supervisor/offlineGroups",
            cache: false,
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/offlineGroups",
        })
        .state('supervisor/offlineGroup/:id', {
            url: "/supervisor/offlineGroup/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/offlineGroup/?id=" + $stateParams.id
            }
        })
        .state('supervisor/offlineSubgroups', {
            url: "/supervisor/offlineSubgroups",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Офлайнові підгрупи');
            },
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/offlineSubgroups",
        })
        .state('supervisor/offlineStudents', {
            url: "/supervisor/offlineStudents",
            cache: false,
            controller: 'offlineStudentsSVTableCtrl',
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/offlineStudents",
        })
        .state('supervisor/studentsWithoutGroup', {
            url: "/supervisor/studentsWithoutGroup",
            cache: false,
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/studentsWithoutGroup",
        })
        .state('supervisor/addOfflineGroup', {
            url: "/supervisor/addOfflineGroup",
            cache: false,
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/addNewOfflineGroupForm",
        })
        .state('supervisor/editOfflineGroup/:id', {
            url: "/supervisor/editOfflineGroup/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/editOfflineGroupForm/?id=" + $stateParams.id
            }
        })
        .state('supervisor/offlineSubgroup/:id', {
            url: "/supervisor/offlineSubgroup/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/offlineSubgroup/?id=" + $stateParams.id
            }
        })
        .state('supervisor/group/:groupId/addOfflineSubgroup', {
            url: "/supervisor/group/:groupId/addOfflineSubgroup",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/addSubgroupForm/?id=" + $stateParams.groupId
            }
        })
        .state('supervisor/editSubgroup/:id', {
            url: "/supervisor/editSubgroup/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/editSubgroupForm/?id=" + $stateParams.id
            }
        })
        .state('supervisor/addOfflineStudent/:studentId', {
            url: "/supervisor/addOfflineStudent/:studentId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/addOfflineStudentForm/?id=" + $stateParams.studentId
            }
        })
        .state('supervisor/updateOfflineStudent/:studentModelId', {
            url: "/supervisor/updateOfflineStudent/:studentModelId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/updateOfflineStudentForm/?id=" + $stateParams.studentModelId
            }
        })
        .state('supervisor/addStudentToSubgroup/:subgroupId', {
            url: "/supervisor/addStudentToSubgroup/:subgroupId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/addOfflineStudentToSubgroupForm/?idSubgroup=" + $stateParams.subgroupId
            }
        })
        .state('supervisor/groupAccess/:type', {
            url: "/supervisor/groupAccess/:type",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/superVisor/groupAccess/?type="+$stateParams.type+"&scenario=create";
            }
        })
        .state('supervisor/editGroupAccess/:type/group/:group/service/:service', {
            url: "/supervisor/editGroupAccess/:type/group/:group/service/:service",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/superVisor/groupAccess/?type="+$stateParams.type+"&scenario=update&group="+$stateParams.group+"&service="+$stateParams.service;
            }
        })
        .state('supervisor/groupAccess/:type/group/:group', {
            url: "/supervisor/groupAccess/:type/group/:group",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/superVisor/groupAccess/?type="+$stateParams.type+"&scenario=create&group="+$stateParams.group;
            }
        })
        .state('users/profile/:id/addtrainer', {
            url: "/users/profile/:id/addtrainer",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/supervisor/addTrainer/id/"+$stateParams.id;
            }
        })
        .state('teacher/:id/editTrainerRole/role/:role', {
            url: "/teacher/:id/editTrainerRole/role/:role",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/roleAttributes/editTrainerRole/id/"+$stateParams.id;
            }
        })
        .state('supervisor/trainers', {
            url: "/supervisor/trainers",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Тренера');
            },
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/trainers",
        })
        .state('trainer/:idTrainer/students', {
            url: "/trainer/:idTrainer/students",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/trainersStudents/idTrainer/" + $stateParams.idTrainer;
            }
        })
        .state('supervisor/changeModuleTeacher/module/:idModule/group/:idGroup', {
            url: "/supervisor/changeModuleTeacher/module/:idModule/group/:idGroup",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/editOfflineGroupTeacherModule/idGroup/"+$stateParams.idGroup+"/idModule/" + $stateParams.idModule;
            }
        })
        .state('supervisor/lecturesRating', {
            url: "/supervisor/lecturesRating",
            cache: false,
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/lecturesRating",
        })
        .state('supervisor/modulesRating', {
            url: "/supervisor/modulesRating",
            cache: false,
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/modulesRating",
        })
});
