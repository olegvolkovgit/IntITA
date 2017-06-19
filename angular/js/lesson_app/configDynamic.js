/**
 * Created by Wizlight on 14.12.2015.
 */
angular
    .module('lessonApp')
    .run([
        '$rootScope', '$state', '$stateParams','$http','paramService','accessLectureService','pagesUpdateService', 'ipCookie',
        function ($rootScope, $state, $stateParams, $http, paramService,accessLectureService,pagesUpdateService, ipCookie) {
            paramService.getStartParam($rootScope, $state, $stateParams);
            pagesUpdateService.getFinishedModule();
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

                            if((ipCookie("lessonTab")==0 || typeof(ipCookie("lessonTab"))=='undefined') && !$rootScope.pageData[toParams.page-1].isVideo){
                                ipCookie('lessonTab', 1, { path: '/' });
                                $('#MyTab-Menu').tabs("option","active",jQuery("#MyTab-Menu a[href*='#text']").parent().index());
                            }
                            
                            $rootScope.pageCount = response.data.length;
                            if(toParams.page>$rootScope.pageCount || $rootScope.pageData[toParams.page-1].isDone==false){
                                event.preventDefault();
                                $state.go('defaultPage');
                            }
                        }, function errorCallback(response) {
                            console.log('Error .run stateChangeStart ');
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
                function (event, toState, toParams) {
                    $('#text').scrollTop(0);

                    $rootScope.currentPage=toParams.page;

                    if($rootScope.pageData){
                        if((ipCookie("lessonTab")==0 || typeof(ipCookie("lessonTab"))=='undefined') && !$rootScope.pageData[$rootScope.currentPage-1].isVideo){
                            ipCookie('lessonTab', 1, { path: '/' });
                            $('#MyTab-Menu').tabs("option","active",jQuery("#MyTab-Menu a[href*='#text']").parent().index());
                        }
                    }

                    setTimeout(function() {
                        MathJax.Hub.Config({
                            tex2jax: {
                                inlineMath: [['$','$'], ['\\(','\\)']]
                            },
                            "HTML-CSS": {
                                linebreaks: { automatic: true }
                            },
                            SVG: {
                                linebreaks: { automatic: true }
                            }
                        });
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
                            return basePath+'/lesson/loadVideoPage?page='+stateParams.page+'&lectureId='+idLecture;
                        }
                    },
                    "viewText": {
                        templateUrl: function (stateParams){
                            return basePath+'/lesson/loadTextPage?page='+stateParams.page+'&lectureId='+idLecture;
                        }
                    },
                    "viewQuiz": {
                        templateUrl: function (stateParams){
                            return basePath+'/lesson/loadQuizPage?page='+stateParams.page+'&lectureId='+idLecture;
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
                            return basePath+'/lesson/loadVideoPage?page='+lastAccessPage+'&lectureId='+idLecture;
                        }
                    },
                    "viewText": {
                        templateUrl: function (){
                            return basePath+'/lesson/loadTextPage?page='+lastAccessPage+'&lectureId='+idLecture;
                        }
                    },
                    "viewQuiz": {
                        templateUrl: function (){
                            return basePath+'/lesson/loadQuizPage?page='+lastAccessPage+'&lectureId='+idLecture;
                        }
                    }
                },
            });
    }]);