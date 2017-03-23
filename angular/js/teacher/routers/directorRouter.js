angular
    .module('directorRouter',['ui.router'])
    .config(function ($stateProvider) {
    $stateProvider
        .state('director', {
            url: "/director",
            controller: function($scope){
                $scope.changePageHeader('Директор');
            },
            templateUrl: basePath+"/_teacher/_director/director/index",
        })
        
        .state('director/addrole/:role', {
            url: "/director/addrole/:role",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_director/role/renderAddRoleForm/role/"+$stateParams.role;
            }
        })
        .state('director/addAdmin', {
            url: "/director/addAdmin",
            cache: false,
            templateUrl: basePath+"/_teacher/_director/role/renderAddAdminForm",
        })
        
        .state('organizations', {
            url: "/organizations",
            cache: false,
            templateUrl: basePath+"/_teacher/_director/organization/index",
        })
        .state('organizations/addOrganization', {
            url: "/organizations/addOrganization",
            cache: false,
            templateUrl: basePath + "/_teacher/_director/organization/createOrganizationForm",
        })
        .state('organizations/updateOrganization/:id', {
            url: "/organizations/updateOrganization/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_director/organization/updateOrganizationForm?id=" + $stateParams.id
            }
        })
});