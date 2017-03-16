angular
    .module('auditorRouter',['ui.router'])
    .config(function ($stateProvider) {
    $stateProvider
        .state('auditor', {
            url: "/auditor",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Аудитор');
            },
            templateUrl: basePath+"/_teacher/_auditor/auditor/index",
        })
});