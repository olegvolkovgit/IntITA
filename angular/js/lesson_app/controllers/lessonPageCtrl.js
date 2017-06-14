/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('lessonApp')
    .controller('lessonPageCtrl',lessonPageCtrl);

function lessonPageCtrl($rootScope,$scope, ipCookie,openDialogsService, $http) {
    $scope.currentLocation = window.location.pathname;
    $scope.nextPage=function(){
        if($rootScope.currentPage>=$rootScope.pageCount){
            return $rootScope.currentPage;
        }else{
            return parseInt($rootScope.currentPage)+parseInt(1);
        }
    };


    angular.element(document.querySelector("#MyTab-Menu")).children("ul").children("li").on('click', function() {

        var tabId=angular.element(this).attr('aria-controls');
        switch (tabId) {
            case 'video':
                ipCookie('lessonTab', 0, { path: '/' });
                break;
            case 'text':
                $scope.startLogText();
                ipCookie('lessonTab', 1, { path: '/' });
                break;
            case 'quiz':
                $scope.startLogQuiz();
                break;
        }
    });

    $scope.dialogHide=function(){
        $("#mydialog2").dialog("close");
        var tab=ipCookie("lessonTab")+1;
        $('#ui-id-'+tab+'').click();
    };
    $scope.errorDialogHide=function(){
        $("#mydialog3").dialog("close");
    };
    $scope.hideInformDialog=function(){
        if($rootScope.currentPage==$rootScope.lastAccessPage){
            $("#informDialog").dialog("close");
            var tab=ipCookie("lessonTab")+1;
            $('#ui-id-'+tab+'').click();
            openDialogsService.openLastTrueDialog();
        }else{
            $("#informDialog").dialog("close");
            var tab=ipCookie("lessonTab")+1;
            $('#ui-id-'+tab+'').click();
        }
    };
    $scope.startLogQuiz=function(){
        $.post(basePath+"/track/index", {  events: 'Open_Quiz', lesson: idLecture,part: $rootScope.currentPage } );

    };
    $scope.startLogText=function(){
        $.post(basePath+"/track/index", {  events: 'Open_Text', lesson: idLecture,part: $rootScope.currentPage } );

    };
    $scope.startLogVideo=function(){
      $.post(basePath+"/track/index", {  events: 'Start_Video', lesson: idLecture,part: $rootScope.currentPage } );

       }

    //redirect to lecture page
    $scope.lectureLink = function (idLecture, idCourse) {
        $http
            .get(basePath + '/lesson/getLectureLink', {
                params: {
                    idLecture: idLecture,
                    idCourse: idCourse
                }
            })
            .then(function successCallback(response) {
                location.href = response.data;
            }, function errorCallback() {
                return false;
            });
    };
}
// celebre
document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen;

function enterFullscreen(id) {
    var el =  document.getElementById(id);
    var onfullscreenchange =  function(e){
        var fullscreenElement = document.fullscreenElement || document.mozFullscreenElement || document.webkitFullscreenElement;
        var fullscreenEnabled = document.fullscreenEnabled || document.mozFullscreenEnabled || document.webkitFullscreenEnabled;

    }

    el.addEventListener("webkitfullscreenchange", onfullscreenchange);
    el.addEventListener("mozfullscreenchange",     onfullscreenchange);
    el.addEventListener("fullscreenchange",             onfullscreenchange);

    if (el.webkitRequestFullScreen) {
        el.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
    } else {
        el.mozRequestFullScreen();
    }
    document.querySelector('#'+id + ' button').onclick = function(){
        exitFullscreen(id);
    }
}

function exitFullscreen(id) {
    document.cancelFullScreen();
    document.querySelector('#'+id + ' button').onclick = function(){
        enterFullscreen(id);
    }
}
// celebre


