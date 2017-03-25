var auditorUrl = basePath+"/_teacher/_auditor";

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
            templateUrl: auditorUrl+"/auditor/index",
        })
        .state('auditor/offerTemplate', {
            url: "/auditor/offerTemplate",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Публічна оферта');
            },
            templateUrl: auditorUrl+"/template/index",
        })
        .state('auditor/updateOfferTemplate/:lang', {
            url: "/auditor/updateOfferTemplate/:lang",
            cache         : false,
            templateUrl: function ($stateParams) {
                return auditorUrl+"/template/editOffer/?lang="+$stateParams.lang;
            }
        })
});