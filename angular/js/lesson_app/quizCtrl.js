/**
 * Created by Wizlight on 03.12.2015.
 */
angular
    .module('lessonApp')
    .controller('lessonQuizCtrl',lessonQuizCtrl)

/* Controllers */
function lessonQuizCtrl($rootScope,$http, $scope, ipCookie, $templateCache, $state, $stateParams) {
    $scope.sendTestAnswer=function(block_order,typeButton, test, testType, editMode){
        user=idUser;
        var checkAnswers=angular.element("#answers"+block_order+"  input:"+typeButton+":checked");
        if(checkAnswers.length==0){
            alert('Спочатку виберіть варіант відповіді');
            return false;
        }
        answers = getUserAnswers(testType);
        $http({
            method: "POST",
            url: basePath + "/tests/checkTestAnswer",
            data: $.param({
                user: user,
                test: test,
                answers: answers,
                testType: testType,
                editMode: editMode
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false,
        })
            .success(function () {
                if (editMode == 0 && user!=0) {
                    $scope.isTrueTestAnswer(user, test);
                }
            })
            .error(function () {
                    alert('error sendTestAnswer');
            })
    };
    $scope.isTrueTestAnswer = function (user, test){

        var command = {
            "user": user,
            "test" : test
        };
        var jqxhr = $.post( basePath +"/tests/getTestResult", JSON.stringify(command), function(){})
            .done(function(data) {
                if (data['status'] == '1' && data['lastTest']=='0') {
                    // оновлюємо модель з сервера
                    $http({
                        url: basePath + '/lesson/GetPageData',
                        method: "POST",
                        data: $.param({lecture: idLecture}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).then(function(response){
                        $rootScope.pageData = response.data;
                        console.log($rootScope.pageData);
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
                    // оновлюємо модель з сервера
                    jQuery('#mydialog2').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
                    $("#mydialog2").dialog().dialog("open");
                    $("#mydialog2").parent().css('border', '4px solid #339900');
                    return false;
                } else if(data['status'] == '1' && data['lastTest']=='1'){
                    jQuery('#dialogNextLecture').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
                    $("#dialogNextLecture").dialog().dialog("open");
                    $("#dialogNextLecture").parent().css('border', '4px solid #339900');
                    return false;
                } else {
                    jQuery('#mydialog3').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
                    $("#mydialog3").dialog().dialog("open");
                    $("#mydialog3").parent().css('border', '4px solid #cc0000');
                    return false;
                }
            })
            .fail(function() {
                alert("Вибачте, на сайті виникла помилка і ми не можемо перевірити Вашу відповідь.\n" +
                    "Спробуйте перезавантажити сторінку або напишіть нам на адресу Wizlightdragon@gmail.com.");
            })
            .always(function() {
            }, "json");
    };
}