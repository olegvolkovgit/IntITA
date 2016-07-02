/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('lecturePreviewRevisionApp')
    .controller('lecturePreviewRevisionCtrl',lecturePreviewRevisionCtrl);

function lecturePreviewRevisionCtrl($rootScope,$scope, getLectureData,revisionMessage, revisionsActions) {
    //load from service lecture data for scope
    getLectureData.getData(idRevision).then(function(response){
        $rootScope.lectureData=response;
    });
    $scope.editPageRevision = function(pageId) {
        location.href=basePath+'/revision/editPageRevision?idPage='+pageId;
    };

    $scope.editRevision = function(url) {
        location.href = url;
    };
    //edit revision status
    $scope.sendRevision = function(id) {
        if($scope.disabled!=false){
            $scope.disabled=false;
            revisionsActions.sendRevision(id).then(function(){
                getLectureData.getData(idRevision).then(function(response){
                    $rootScope.lectureData=response;
                });
                $scope.disabled=true;
            });
        }
    };
    $scope.cancelSendRevision = function(id) {
        revisionsActions.cancelSendRevision(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        });
    };
    $scope.approveRevision = function(id) {
        revisionsActions.approveRevision(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        });
    };
    $scope.cancelRevision = function(id) {
        revisionsActions.cancelRevision(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        });
    };
    $scope.rejectRevision = function(id) {
        revisionsActions.rejectRevision(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        });
    };
    $scope.proposedToReleaseRevision = function(id) {
        revisionsActions.proposedToReleaseRevision(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        });
    };
    $scope.cancelPreReleaseRevision = function(id) {
        revisionsActions.cancelPreReleaseRevision(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        });
    };
    //canceled edit revision by the editor
    $scope.cancelEditByEditor = function(id) {
        revisionsActions.cancelEditByEditor(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        });
    };
    //canceled edit revision by the editor
    $scope.restoreEditByEditor = function(id) {
        revisionsActions.restoreEditByEditor(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        });
    };
    //send message to author of revision
    $scope.sendRevisionMessage = function(idRevision) {
        revisionMessage.sendMessage(idRevision);
    };
}
