/**
 * Created by Wizlight on 03.11.2015.
 */
'use strict';
/* Controllers */
angular
    .module('lessonApp')
    .run([
    '$rootScope', '$state', '$stateParams','$http',
    function ($rootScope, $state, $stateParams, $http) {
        $rootScope.editMode = editMode;
        $rootScope.isAdmin = parseInt(isAdmin);
        $rootScope.lastAccessPage = parseInt(lastAccessPage);

        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;

        $rootScope.$on('$stateChangeStart',
            function (event, toState, toParams, fromState, fromParams) {
                //перевіряємо при завантажені стейта чи є модель pageData, якщо нема - дістаєм з сервера
                if($rootScope.pageData==undefined){
                    return $http({
                        url: basePath + '/lesson/GetPageData',
                        method: "POST",
                        data: $.param({lecture: idLecture}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).then(function successCallback(response){
                        $rootScope.pageData = response.data;
                        $rootScope.pageCount = response.data.length;
                        if(toParams.page==undefined) toParams.page=lastAccessPage;//при завантажені по дефолту робимо останю доступну частину
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
            });
    }
]);

angular
    .module('lessonApp')
    .config(['$locationProvider','$stateProvider', function($locationProvider,$stateProvider){
        $stateProvider
            .state('page', {
                //resolve: {
                //    auth: function ($q, $http) {
                //        return $http({
                //            url: basePath + '/lesson/GetPageData',
                //            method: "POST",
                //            data: $.param({lecture: idLecture}),
                //            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                //        }).then(function(response){
                //            if(response.data!=0) return "authorized";
                //
                //            return $q.reject('not authorized');
                //        });
                //    }
                //},
                url: "/page:page",
                views: {
                    "viewVideo": {
                        templateUrl: function (stateParams){
                            return '/IntITA/content/module_1/lecture_117/page_'+ stateParams.page+'_video_ua.html'
                        },
                    },
                    "viewText": {
                        templateUrl: function (stateParams){
                                return '/IntITA/content/module_1/lecture_117/page_'+ stateParams.page+'_text_ua.html'
                        },
                    },
                    "viewQuiz": {
                        templateUrl: function (stateParams){
                            return '/IntITA/content/module_1/lecture_117/page_'+ stateParams.page+'_quiz_ua.html'
                        },
                    }
                },
            })
            .state('error', {
                url: "/error",
                views: {
                    "viewVideo": {
                        template: 'сторіоступна',
                    },
                    "viewText": {
                        template: 'сторінступна',
                    },
                    "viewQuiz": {
                        template: 'сторіноступна',
                    }
                },
            })
            .state('default', {
                url: "",
                views: {
                    "viewVideo": {
                        templateUrl: function (stateParams){
                            return '/IntITA/content/module_1/lecture_117/page_'+ lastAccessPage+'_video_ua.html'
                        },
                    },
                    "viewText": {
                        templateUrl: function (stateParams){
                            return '/IntITA/content/module_1/lecture_117/page_'+ lastAccessPage+'_text_ua.html'
                        },
                    },
                    "viewQuiz": {
                        templateUrl: function (stateParams){
                            return '/IntITA/content/module_1/lecture_117/page_'+ lastAccessPage+'_quiz_ua.html'
                        },
                    }
                },
            })
            //.when('/page:page',{
            //    templateUrl:function(params) {return basePath+'/lesson/pageAjaxUpdate?page='+ params.page+'&lectureId='+idLecture;},
            //    controller: 'lessonPageCtrl'
            //})
            //.when('/',{
            //    templateUrl:function() {return basePath+'/lesson/pageAjaxUpdate?page='+lastAccessPage+'&lectureId='+idLecture;},
            //    controller: 'lessonPageCtrl'
            //})
    }]);

angular
    .module('lessonApp')
    .controller('lessonPageCtrl',lessonPageCtrl)
    .controller('sidebarCtrl',['$scope','$http','$location','$routeParams', function($scope, $http,$location,$routeParams) {

    }]);

/* Controllers */
function lessonPageCtrl($rootScope,$http, $scope, ipCookie, $templateCache, $state, $stateParams) {
    //var page = $stateParams.page;
    //$scope.state = $state.current;
    //$rootScope.params = $stateParams;
    //console.log(auth);

    $rootScope.$on('$stateChangeError',
        function(event, toState, toParams, fromState, fromParams, error) {
            console.log('Err'+error); // not authorized
        }
    );
    $scope.nextPage=function(){
        if($rootScope.currentPage>=$rootScope.pageCount){
            return $rootScope.currentPage;
        }else{
            return parseInt($rootScope.currentPage)+parseInt(1);
        }
    };
    $scope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams){
        //if(angular.element('[aria-describedby="mydialog2"]').length!=0) {
        //    if (angular.element('[aria-describedby="mydialog2"]').css('display') == 'block') {
        //        $http({
        //            url: basePath + '/lesson/GetPageData',
        //            method: "POST",
        //            data: $.param({lecture: idLecture}),
        //            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        //        }).then(function(response){
        //            $rootScope.pageData = response.data;
        //        });
        //        $("#mydialog2").dialog().dialog("close");
        //    }
        //}

    });
    //$rootScope.$on('$routeChangeStart', function(event, current, next) {
    //        $templateCache.remove(next['loadedTemplateUrl']);
    //});

    $http({method: 'GET', url: ''})
        .success(function(data) {
            if($('[aria-describedby="mydialog2"]').length==2){
                $('div.ui-widget-overlay.ui-front').remove();
                $('[aria-describedby="mydialog2"]').remove();
            }
            if(document.getElementById('pagePressed')) {
                var position = $('#pagePressed').position();
                $('#pointer').css('margin-top', -12);
                $('#pointer').css('margin-left', position.left + 6);
                $('#pointer').show();
            };
            $scope.data = data;
            setTimeout(function() {
                MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
            });
            $rootScope.chapters = $scope.spots;
        });
    $scope.update = function($scope){
        MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
    };


    $('#MyTab-Menu').children("ul").children("li").click(function(){
        var tabId=$(this).attr('aria-controls');
        switch (tabId) {
            case 'video':
                ipCookie('lessonTab', 0, { path: '/' });
                break;
            case 'text':
                ipCookie('lessonTab', 1, { path: '/' });
                break;
        }
    });

    $scope.getPageData = function (page) {
        $http({
            url: basePath + '/lesson/GetPageData',
            method: "POST",
            data: $.param({page: page, lecture: idLecture}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        })
            .success(function (response) {
                //alert(response);
                //$scope.pageData = response;
            })
            .error(function () {
                alert($scope.errorMsg);
            })
    };
    //angular.element(document).ready(function () {
    //
    //        var position = $('#pagePressed').position();
    //        $('#pointer').css('margin-top', -12);
    //        $('#pointer').css('margin-left', position.left + 6);
    //        $('#pointer').show();
    //
    //});
    $scope.dialogHide=function(){
        $("#mydialog2").dialog("close");
    };
    $scope.errorDialogHide=function(){
        $("#mydialog3").dialog("close");
    };
    $scope.testw=function(a){
        alert(a);
    };
}

angular
    .module('lessonApp')
    .directive('hoverSpot', function() {
            return {
                link: function(scope, element, attrs){
                    attrs.$observe('id',function(){
                        if(attrs.id=='pagePressed'){
                            $('#pointer').css('margin-top', -12);
                            $('#pointer').css('margin-left', attrs.hoverSpot*35 + 6);
                            $('#pointer').show();
                        }
                    });
                    element.on("mouseenter", function(){
                        var tooltipHtml='<p>'+$(this).attr("title")+'</p>';
                        if($(this).is('.pageNoAccess')) {
                            tooltipHtml='<p class="titleNoAccess">'+$(this).attr("title")+'<span class="noAccess"> ('+partNotAvailable+')</span></p>';
                        }
                        $('#pointer').hide();
                        $('#arrowCursor').show();
                        $('#arrowCursor').css('margin-top',-12);
                        $('#arrowCursor').css('margin-left',attrs.hoverSpot*35 + 6);
                        $('#tooltip').html(tooltipHtml);
                        $('#labelBlock').hide();
                        $('#tooltip').css('display','inline-block');
                    });
                    element.on("mouseleave", function(){
                        var position = angular.element(document.querySelector('#pagePressed')).prop('offsetLeft');
                        $('#pointer').css('margin-top',-12);
                        $('#pointer').css('margin-left',position.left + 6);
                        $('#pointer').show();
                        $('#arrowCursor').hide();
                        $('#tooltip').hide();
                        $('#labelBlock').show();
                    })
                }
            }
    })
    //.directive('quizStatus', function () {
    //    return {
    //        restrict: 'E',
    //        link: function(scope, element, attrs) {
    //            attrs.$observe('status', function () {
    //               alert(attrs.status);
    //            })
    //        },
    //        //template: function (elm, attrs) {
    //        //    return '<li><textarea ng-cloak class="testVariant" type="text" ckeditor="editorOptionsAnswer"' +
    //        //        'name="option' + attrs["option"] + '" id="option' + attrs["option"] + '' +
    //        //        'size="80" required ng-model="option' + attrs["option"] + '"></textarea>' +
    //        //        '<div ng-click="alert()" class="ckeImg">CKE</div><div class="answerCheck" >' +
    //        //        '<div id="answersList" class="answersCheckbox"><div><input type="checkbox" ' +
    //        //        'name="answer' + attrs["option"] + '" value=' + attrs["option"] + '></div></div></div></li>'
    //        //},
    //    }
    //})

