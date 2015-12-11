/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .controller('skipTaskCtrl',skipTaskCtrl);

function skipTaskCtrl($rootScope,$http, $scope, accessLectureService) {
    $scope.sendSkipTaskAnswer=function(id){

        var text = skipTaskQuestion.getElementsByTagName('input');
        var answers = [];
        var check = true;
        for(var i = 0; i < text.length;i++)
        {
            if(text[i].value == '')
            {
                check = false;
                alert('Заповніть поле ' + ++i);
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
                $scope.pageDataUpdate();
                $scope.openTrueDialog();
                return false;
            }
            else if(response.data == 'lastPage')
            {
                $scope.pageDataUpdate();
                $scope.openLastTrueDialog();
                accessLectureService.getAccessLectures();
                $rootScope.finishedLecture=1;
                return false;
            }
            else if(response.data == 'not done')
            {
                $scope.openFalseDialog();
                return false;
            }
        });
    };

    // оновлюємо модель з сервера
    $scope.pageDataUpdate = function (){
        $http({
            url: basePath + '/lesson/GetPageData',
            method: "POST",
            data: $.param({lecture: idLecture}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function(response){
            $rootScope.pageData = response.data;
            var count = $rootScope.pageData.length;

            for (var i = 0; i < count; i++) {
                if (i == (count - 1) && $rootScope.pageData[i]['isDone']){
                    $rootScope.lastAccessPage = i+1;
                    break;
                }
                if ($rootScope.pageData[i]['isDone'] && !$rootScope.pageData[i+1]['isDone']){
                    $rootScope.lastAccessPage = i+1;
                    break;
                }
            }
        });
    };
    // оновлюємо модель з сервера
    // Dialog windows
    $scope.openTrueDialog=function(){
        jQuery('#mydialog2').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
        $("#mydialog2").dialog().dialog("open");
        $("#mydialog2").parent().css('border', '4px solid #339900');
    };
    $scope.openLastTrueDialog=function(){
        jQuery('#dialogNextLecture').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
        $("#dialogNextLectureNG").dialog().dialog("open");
        $("#dialogNextLectureNG").parent().css('border', '4px solid #339900');
    };
    $scope.openFalseDialog=function(){
        jQuery('#mydialog3').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
        $("#mydialog3").dialog().dialog("open");
        $("#mydialog3").parent().css('border', '4px solid #cc0000');

    };
    // Dialog windows
}