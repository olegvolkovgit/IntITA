/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('lessonApp')
    .controller('lessonPageCtrl',lessonPageCtrl);

function lessonPageCtrl($rootScope,$scope, ipCookie,openDialogsService) {
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
        $.post("/track/index", {  events: 6, lesson: idLecture,part: $rootScope.currentPage } );

    };
    $scope.startLogText=function(){
        $.post("/track/index", {  events: 5, lesson: idLecture,part: $rootScope.currentPage } );

    };
    $scope.startLogVideo=function(){
      $.post("/track/index", {  events: 7, lesson: idLecture,part: $rootScope.currentPage } );

       }
}
