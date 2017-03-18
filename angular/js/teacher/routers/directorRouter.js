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
});