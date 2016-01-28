/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .controller('plainTaskCtrl',plainTaskCtrl);

function plainTaskCtrl($rootScope,$http, $scope, accessLectureService,openDialogsService,pagesUpdateService) {
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
            }).then(function(response){
                if (response.data == 'done') {
                    pagesUpdateService.pagesDataUpdate();
                    openDialogsService.openInformDialog();
                    button.removeAttr('disabled');
                    return false;
                } else if(response.data == 'lastPage') {
                    pagesUpdateService.pagesDataUpdate();
                    openDialogsService.openInformDialog();
                    accessLectureService.getAccessLectures();
                    $rootScope.finishedLecture=1;
                    button.removeAttr('disabled');
                    return false;
                } else {
                    alert('На сайті виникли проблеми і Твоя відповідь не була збережена. Спробуй ще раз або звернися до адміністратора сайту.')
                    button.removeAttr('disabled');
                    return false;
                }
            });
        }

    };
}