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
            controller: function ($scope) {
                $scope.changePageHeader('Офлайнові групи');
            },
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/offlineGroups",
        })
        .state('supervisor/offlineGroup/:id', {
            url: "/supervisor/offlineGroup/:id",
            cache: false,
            controller: 'offlineGroupCtrl',
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
            controller: 'studentsWithoutGroupSVTableCtrl',
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/studentsWithoutGroup",
        })
        .state('supervisor/specializations', {
            url: "/supervisor/specializations",
            cache: false,
            controller: 'specializationsTableCtrl',
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/specializations",
        })
        .state('supervisor/specialization/update/:id', {
            url: "/supervisor/specialization/update/:id",
            cache: false,
            controller: 'specializationCtrl',
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/superVisor/specializationUpdate/id/"+$stateParams.id;
            }
        })
        .state('supervisor/createSpecialization', {
            url: "/supervisor/createSpecialization",
            cache: false,
            controller: 'specializationsTableCtrl',
            templateUrl: basePath+"/_teacher/_supervisor/superVisor/specializationCreate"
        })
        .state('supervisor/userProfile/:id', {
            url: "/supervisor/userProfile/:id",
            cache: false,
            controller: 'offlineStudentProfileCtrl',
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/userProfile"
        })
        .state('supervisor/student/:id/changetrainer', {
            url: "/supervisor/student/:id/changetrainer",
            cache: false,
            controller: 'offlineStudentProfileCtrl',
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/superVisor/changeTrainer/id/"+$stateParams.id;
            }
        })
        .state('supervisor/student/:id/addtrainer', {
            url: "/supervisor/student/:id/addtrainer",
            cache: false,
            controller: 'offlineStudentProfileCtrl',
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/superVisor/addTrainer/id/"+$stateParams.id;
            }
        })
        .state('supervisor/addOfflineGroup', {
            url: "/supervisor/addOfflineGroup",
            cache: false,
            controller: 'offlineGroupCtrl',
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/addNewOfflineGroupForm",
        })
        .state('supervisor/editOfflineGroup/:id', {
            url: "/supervisor/editOfflineGroup/:id",
            cache: false,
            controller: 'offlineGroupCtrl',
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/editOfflineGroupForm/?id=" + $stateParams.id
            }
        })
        .state('supervisor/offlineSubgroup/:id', {
            url: "/supervisor/offlineSubgroup/:id",
            cache: false,
            controller: 'offlineSubgroupCtrl',
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/offlineSubgroup/?id=" + $stateParams.id
            }
        })
        .state('supervisor/group/:groupId/addOfflineSubgroup', {
            url: "/supervisor/group/:groupId/addOfflineSubgroup",
            cache: false,
            controller: 'offlineSubgroupCtrl',
            templateUrl: basePath + "/_teacher/_supervisor/superVisor/addSubgroupForm"
        })
        .state('supervisor/editSubgroup/:id', {
            url: "/supervisor/editSubgroup/:id",
            cache: false,
            controller: 'offlineSubgroupCtrl',
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/editSubgroupForm/?id=" + $stateParams.id
            }
        })
        .state('supervisor/addStudentToSubgroup/:id', {
            url: "/supervisor/addStudentToSubgroup/:id",
            cache: false,
            controller: 'offlineStudentProfileCtrl',
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/addOfflineStudent/?id=" + $stateParams.id
            }
        })
        .state('supervisor/editOfflineStudent/:idOfflineStudentModel', {
            url: "/supervisor/editOfflineStudent/:idOfflineStudentModel",
            cache: false,
            controller: 'updateOfflineStudentCtrl',
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_supervisor/superVisor/editOfflineStudent/?id=" + $stateParams.idOfflineStudentModel
            }
        })
        .state('supervisor/users', {
            url: "/supervisor/users",
            cache: false,
            controller: 'usersSVTableCtrl',
            templateUrl: basePath+"/_teacher/_supervisor/superVisor/users",
        })
        .state('supervisor/students', {
            url: "/supervisor/students",
            cache: false,
            controller: 'studentsSVTableCtrl',
            templateUrl: basePath+"/_teacher/_supervisor/superVisor/students",
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
                return basePath+"/_teacher/_supervisor/superVisor/groupAccess/?type="+$stateParams.type+"&scenario=update";
            }
        })
        .state('supervisor/groupAccess/:type/group/:group', {
            url: "/supervisor/groupAccess/:type/group/:group",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_supervisor/superVisor/groupAccess/?type="+$stateParams.type+"&scenario=create";
            }
        })
});