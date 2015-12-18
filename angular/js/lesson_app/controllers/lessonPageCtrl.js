/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('lessonApp')
    .controller('lessonPageCtrl',lessonPageCtrl);

function lessonPageCtrl($rootScope,$http, $scope, ipCookie) {
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


    angular.element(document.querySelector("#MyTab-Menu")).children("ul").children("li").on('click', function() {
        var tabId=angular.element(this).attr('aria-controls');
        switch (tabId) {
            case 'video':
                ipCookie('lessonTab', 0, { path: '/' });
                break;
            case 'text':
                ipCookie('lessonTab', 1, { path: '/' });
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
}