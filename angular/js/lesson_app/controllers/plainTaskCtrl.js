/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .controller('plainTaskCtrl',plainTaskCtrl);

function plainTaskCtrl($rootScope,$http, $scope, accessLectureService) {
    $scope.sendPlainTaskAnswer=function(idLecture)
    {
        var answer = $('[name=answer]').val();
        if(answer.trim() == '')
        {
            alert('Спочатку дайте відповідь');
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
                alert('Ваша відповідь буде оброблена в найближчий час');
            });
        }

    };
}