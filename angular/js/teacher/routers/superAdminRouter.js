var url= basePath+"/_teacher/_super_admin";

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
            templateUrl: url+"/superAdmin/index",
        })

        .state('carousel', {
            url: "/carousel",
            cache: false,
            templateUrl: url+"/carousel/index",
        })
        .state('carousel/view/id/:id', {
            url: "/carousel/view/id/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return url+"/carousel/view/?id="+$stateParams.id;
            }
        })
        .state('carousel/update/id/:id', {
            url: "/carousel/update/id/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return url+"/carousel/update/?id="+$stateParams.id;
            }
        })
        .state('aboutusSlider', {
            url: "/aboutusSlider",
            cache: false,
            templateUrl: url+"/aboutusSlider/index",
        })
        .state('aboutusSlider/view/id/:id', {
            url: "/aboutusSlider/view/id/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return url+"/aboutusSlider/view/?id="+$stateParams.id;
            }
        })
        .state('aboutusSlider/update/id/:id', {
            url: "/aboutusSlider/update/id/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return url+"/aboutusSlider/update/?id="+$stateParams.id;
            }
        })
        .state('addmainsliderphoto', {
            url: "/addmainsliderphoto",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Слайдер на головній сторінці');
            },
            templateUrl: url+"/carousel/create",
        })
        .state('addaboutussliderphoto', {
            url: "/addaboutussliderphoto",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Слайдер на сторінці Про нас');
            },
            templateUrl: url+"/aboutusSlider/create",
        })

        .state('address', {
            url: "/address",
            cache: false,
            templateUrl: url+"/address/index",
        })
        .state('addcity', {
            url: "/addcity",
            cache: false,
            controller:"addressCtrl",
            templateUrl: url+"/address/addCity",
        })
        .state('editcity/:id', {
            url: "/editcity/:id",
            cache: false,
            controller:"addressCtrl",
            templateUrl: function ($stateParams) {
                return url+"/address/editCity/id/"+$stateParams.id;
            }
        })
        .state('addcountry', {
            url: "/addcountry",
            cache: false,
            templateUrl: url+"/address/addCountry",
        })
});