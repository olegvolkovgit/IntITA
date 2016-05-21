/**
 * Created by Wizlight on 14.12.2015.
 */
angular
    .module('lecturePreviewRevisionApp')
    .run([
        '$rootScope', '$state', '$stateParams','$http',
        function ($rootScope, $state, $stateParams, $http) {
            $rootScope.currentPage=1;

            $rootScope.$on('$stateChangeStart',
                function (event, toState, toParams) {
                    //перевіряємо при завантажені стейта чи є модель pageData, якщо нема - дістаєм з сервера\
                    if(toParams.page==undefined) toParams.page=1;//при завантажені по дефолту робимо останю доступну частину
                    if($rootScope.pageData==undefined){
                        return $http({
                            url: basePath + '/revision/getRevisionPreviewData',
                            method: "POST",
                            data: $.param({idRevision: idRevision}),
                            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                        }).then(function successCallback(response){
                            $rootScope.pageData = response.data;
                            $rootScope.pageCount = response.data.length;
                            if(toParams.page>$rootScope.pageCount){
                                event.preventDefault();
                                $state.go('defaultPage');
                            }
                        }, function errorCallback() {
                            console.log('Error .run stateChangeStart ');
                        });
                    }
                    //перевіряємо чи доступна частина
                    if(toParams.page>$rootScope.pageCount){
                        event.preventDefault();
                    }else{
                        $rootScope.currentPage=toParams.page;
                    }
                }
            );
            $rootScope.$on('$stateChangeSuccess',
                function (event, toState, toParams) {
                    $rootScope.currentPage=toParams.page;
                    setTimeout(function() {
                        MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
                    });
                });
        }
    ]);

angular
    .module('lecturePreviewRevisionApp')
    .config(['$locationProvider','$stateProvider','$urlRouterProvider', function($locationProvider,$stateProvider,$urlRouterProvider){
        $urlRouterProvider.otherwise("/page1");
        $stateProvider
            .state('page', {
                url: "/page{page:int}",
                views: {
                    "viewVideo": {
                        templateUrl: function (stateParams){
                            return basePath+'/revision/videoPreview?idRevision='+idRevision+'&idPage='+stateParams.page;
                        }
                    },
                    "viewText": {
                        templateUrl: function (stateParams){
                            return basePath+'/revision/textPreview?idRevision='+idRevision+'&idPage='+stateParams.page;
                        }
                    },
                    "viewQuiz": {
                        templateUrl: function (stateParams){
                            return basePath+'/revision/quizPreview?idRevision='+idRevision+'&idPage='+stateParams.page;
                        }
                    }
                },
            })
            .state('defaultPage', {
                url: "/page1",
            })
            .state('default', {
                url: "",
                views: {
                    "viewVideo": {
                        templateUrl: function (){
                            return basePath+'/revision/videoPreview?idRevision='+idRevision+'&idPage=1';
                        }
                    },
                    "viewText": {
                        templateUrl: function (){
                            return basePath+'/revision/textPreview?idRevision='+idRevision+'&idPage=1';
                        }
                    },
                    "viewQuiz": {
                        templateUrl: function (){
                            return basePath+'/revision/quizPreview?idRevision='+idRevision+'&idPage=1';
                        }
                    }
                },
            });
    }]);