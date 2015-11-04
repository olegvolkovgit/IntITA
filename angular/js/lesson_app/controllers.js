/**
 * Created by Wizlight on 03.11.2015.
 */
'use strict';
/* Controllers */
angular
    .module('lessonApp')
    .config(['$routeProvider','$locationProvider', function($routeProvider){
        $routeProvider
            .when('/page:page',{
                templateUrl:function(params) {return '/lesson/pageAjaxUpdate?page='+ params.page+'&lectureId='+idLecture;},
                controller: 'lessonPageCtrl'
            })
            .when('/',{
                templateUrl:function() {return '/lesson/pageAjaxUpdate?page='+lastAccessPage+'&lectureId='+idLecture;},
                controller: function($scope, $http){
                    $http({method: 'GET', url: ''})
                        .success(function() {
                            var position = $('#pagePressed').position();
                            $('#pointer').css('margin-top',-12);
                            $('#pointer').css('margin-left',position.left+6);
                            $('#pointer').show();
                        })
                }
            })
    }]);

angular
    .module('lessonApp')
    .controller('lessonPageCtrl',lessonPageCtrl)
    .controller('sidebarCtrl',['$scope','$http','$location','$routeParams', function($scope, $http,$location,$routeParams) {

    }]);

/* Controllers */
function lessonPageCtrl($rootScope,$http, $scope, ipCookie) {
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
            }
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
            //case 'quiz':
            //    ipCookie('lessonTab', 2, { path: '/' });
            //    break;
            //default:
            //ipCookie('lessonTab', 0, { path: '/' });
        }
    });
}

angular
    .module('lessonApp')
    .directive('hoverSpot', function() {
            return {
                link: function(scope, element, attrs){
                    element.on("mouseenter", function(){
                        var tooltipHtml='<p>'+$(this).attr("title")+'</p>';
                        if($(this).is('.pageNoAccess')) {
                            tooltipHtml='<p class="titleNoAccess">'+$(this).attr("title")+'<span class="noAccess"> ('+partNotAvailable+')</span></p>';
                        }
                        $('#pointer').hide();
                        $('#arrowCursor').show();
                        var position = $(this).position();
                        $('#arrowCursor').css('margin-top',-12);
                        $('#arrowCursor').css('margin-left',position.left+6);
                        $('#tooltip').html(tooltipHtml);
                        $('#labelBlock').hide();
                        $('#tooltip').css('display','inline-block');
                    });
                    element.on("mouseleave", function(){
                        var position = $('#pagePressed').position();
                        $('#pointer').css('margin-top',-12);
                        $('#pointer').css('margin-left',position.left+6);
                        $('#pointer').show();
                        $('#arrowCursor').hide();
                        $('#tooltip').hide();
                        $('#labelBlock').show();
                    })
                }
            }
    });

