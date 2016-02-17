/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .run([
        '$rootScope', '$state', '$stateParams','$http','paramService','accessLectureService',
        function ($rootScope, $state, $stateParams, $http, paramService,accessLectureService) {
            paramService.getStartParam($rootScope, $state, $stateParams);
            accessLectureService.getAccessLectures();

            $rootScope.$on('$stateChangeStart',
                function (event, toState, toParams, fromState, fromParams) {
                    //перевіряємо при завантажені стейта чи є модель pageData, якщо нема - дістаєм з сервера\
                    if(toParams.page==undefined) toParams.page=lastAccessPage;//при завантажені по дефолту робимо останю доступну частину
                    if($rootScope.pageData==undefined){
                        return $http({
                            url: basePath + '/lesson/GetPageData',
                            method: "POST",
                            data: $.param({lecture: idLecture}),
                            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                        }).then(function successCallback(response){
                            $rootScope.pageData = response.data;
                            $rootScope.pageCount = response.data.length;
                            if(toParams.page>$rootScope.pageCount || $rootScope.pageData[toParams.page-1].isDone==false){
                                event.preventDefault();
                                $state.go('defaultPage');
                            }
                        }, function errorCallback(response) {
                            alert('Error .run stateChangeStart ');
                        });
                    }
                    //перевіряємо чи доступна частина
                    if(toParams.page>$rootScope.pageCount || $rootScope.pageData[toParams.page-1].isDone==false){
                        event.preventDefault();
                    }else{
                        $rootScope.currentPage=toParams.page;
                    }
                }
            );
            $rootScope.$on('$stateChangeSuccess',
                function (event, toState, toParams, fromState, fromParams) {
                    $rootScope.currentPage=toParams.page;
                    setTimeout(function() {
                        MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
                    });
                });
        }
    ]);

angular
    .module('lessonApp')
    .config(['$locationProvider','$stateProvider','$urlRouterProvider', function($locationProvider,$stateProvider,$urlRouterProvider){
        $urlRouterProvider.otherwise("/page1");
        $stateProvider
            .state('page', {
                url: "/page{page:int}",
                views: {
                    "viewVideo": {
                        templateUrl: function (stateParams){
                            return basePath + '/content/module_'+idModule+'/lecture_'+idLecture+'/page_'+ stateParams.page+'_video_'+lang+'.html'
                        }
                    },
                    "viewText": {
                        templateUrl: function (stateParams){
                            return basePath + '/content/module_'+idModule+'/lecture_'+idLecture+'/page_'+ stateParams.page+'_text_'+lang+'.html'
                        }
                    },
                    "viewQuiz": {
                        templateUrl: function (stateParams){
                            return basePath + '/content/module_'+idModule+'/lecture_'+idLecture+'/page_'+ stateParams.page+'_quiz_'+lang+'.html'
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
                            return basePath + '/content/module_'+idModule+'/lecture_'+idLecture+'/page_'+ lastAccessPage+'_video_'+lang+'.html'
                        }
                    },
                    "viewText": {
                        templateUrl: function (){
                            return basePath + '/content/module_'+idModule+'/lecture_'+idLecture+'/page_'+ lastAccessPage+'_text_'+lang+'.html'
                        }
                    },
                    "viewQuiz": {
                        templateUrl: function (){
                            return basePath + '/content/module_'+idModule+'/lecture_'+idLecture+'/page_'+ lastAccessPage+'_quiz_'+lang+'.html'
                        }
                    }
                },
            });
    }]);