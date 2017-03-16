angular
    .module('superAdminRouter',['ui.router'])
    .config(function ($stateProvider) {
    $stateProvider
        .state('superadmin', {
            url: "/superadmin",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Суперадмін');
            },
            templateUrl: basePath+"/_teacher/_super_admin/superAdmin/index",
        })
});