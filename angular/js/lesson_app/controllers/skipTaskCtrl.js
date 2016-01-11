/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .controller('skipTaskCtrl',skipTaskCtrl);

function skipTaskCtrl($rootScope,$http, $scope, accessLectureService,pagesUpdateService,openDialogsService) {
    $scope.sendSkipTaskAnswer=function(id){

        var text = skipTaskQuestion.getElementsByTagName('input');
        var answers = [];
        var check = true;
        for(var i = 0; i < text.length;i++)
        {
            if(text[i].value == '')
            {
                angular.element(document.querySelector("#skipTask"+parseInt(i+1))).addClass('emptyField');
                check = false;
            }
            else{
                angular.element(document.querySelector("#skipTask"+parseInt(i+1))).removeClass('emptyField');
            }
        }
        if(!check)
            return check;
        for(var i = 1; i<text.length + 1 ;i++)
        {
            var name = 'skipTask' + i;
            var skipBlock = document.getElementById(name);
            if(skipBlock != undefined){
                var skipText = skipBlock.value;
                var caseInsensitive = skipBlock.getAttribute('caseinsensitive');

                var arr = [];
                arr.push(skipText);
                arr.push(i);
                arr.push(caseInsensitive);

                answers.push(arr);
            }
        }
        var url = basePath + "/skipTask/saveSkipAnswer";
        $http({
            method: "POST",
            url:  url,
            data: $.param({answers: answers, id : id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(response){
            if (response.data == 'done') {
                pagesUpdateService.pagesDataUpdate();
                openDialogsService.openTrueDialog();
                return false;
            }
            else if(response.data == 'lastPage')
            {
                pagesUpdateService.pagesDataUpdate();
                openDialogsService.openLastTrueDialog();
                accessLectureService.getAccessLectures();
                $rootScope.finishedLecture=1;
                return false;
            }
            else if(response.data == 'not done')
            {
                openDialogsService.openFalseDialog();
                return false;
            }
        });
    };
}
$('html').on('keyup','.emptyField', function () {
    if($(this).hasClass("emptyField"))
    $(this).removeClass('emptyField');
});