/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .controller('plainTaskCtrl',plainTaskCtrl);

function plainTaskCtrl($rootScope,$http, $scope, accessLectureService,openDialogsService) {
    $scope.sendPlainTaskAnswer=function(idLecture)
    {
        var button=angular.element(document.querySelector(".taskSubmit"));
        button.attr('disabled', true);
        var answer = $('[name=answer]').val();
        if(answer.trim() == '')
        {
            angular.element(document.querySelector("#flashMsg")).addClass('emptyFlash');
            button.removeAttr('disabled');
        }
        else
        {
            $http({
                method: "POST",
                url:  basePath + "/plainTask/saveAnswer",
                data: $.param({idLecture:idLecture,answer:answer}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function(){
                openDialogsService.openInformDialog();
                button.removeAttr('disabled');
            });
        }

    };
}