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
                            if($rootScope.pageData[toParams.page-1].isDone==false){
                                event.preventDefault();
                                $state.go('error');
                            }
                        }, function errorCallback(response) {
                            alert('Error .run stateChangeStart ');
                        });
                    }
                    //перевіряємо чи доступна частина
                    if($rootScope.pageData[toParams.page-1].isDone==false){
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
    .config(['$locationProvider','$stateProvider', function($locationProvider,$stateProvider){
        $stateProvider
            .state('page', {
                url: "/page:page",
                views: {
                    "viewVideo": {
                        templateUrl: function (stateParams){
                            return basePath + '/content/module_1/lecture_'+idLecture+'/page_'+ stateParams.page+'_video_ua.html'
                        }
                    },
                    "viewText": {
                        templateUrl: function (stateParams){
                            return basePath + '/content/module_1/lecture_'+idLecture+'/page_'+ stateParams.page+'_text_ua.html'
                        }
                    },
                    "viewQuiz": {
                        templateUrl: function (stateParams){
                            return basePath + '/content/module_1/lecture_'+idLecture+'/page_'+ stateParams.page+'_quiz_ua.html'
                        }
                    }
                },
            })
            .state('error', {
                url: "/error",
                views: {
                    "viewVideo": {
                        template: 'Сторінка недоступна',
                    },
                    "viewText": {
                        template: 'Сторінка недоступна',
                    },
                    "viewQuiz": {
                        template: 'Сторінка недоступна',
                    }
                }
            })
            .state('default', {
                url: "",
                views: {
                    "viewVideo": {
                        templateUrl: function (){
                            return basePath + '/content/module_1/lecture_'+idLecture+'/page_'+ lastAccessPage+'_video_ua.html'
                        }
                    },
                    "viewText": {
                        templateUrl: function (){
                            return basePath + '/content/module_1/lecture_'+idLecture+'/page_'+ lastAccessPage+'_text_ua.html'
                        }
                    },
                    "viewQuiz": {
                        templateUrl: function (){
                            return basePath + '/content/module_1/lecture_'+idLecture+'/page_'+ lastAccessPage+'_quiz_ua.html'
                        }
                    }
                },
            });
    }]);