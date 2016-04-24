/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .controller('testCtrl',testCtrl);

function testCtrl($rootScope,$http, $scope, accessLectureService,pagesUpdateService,openDialogsService) {

    $scope.sendTestAnswer = function (block_order, typeButton, test, testType, editMode) {
        var button=angular.element(document.querySelector(".testSubmit"));
        button.attr('disabled', true);
        user = idUser;
        var checkAnswers = $("#answers" + block_order + "  input:" + typeButton + ":checked");
        if (checkAnswers.length == 0) {
            openDialogsService.openFalseDialog();
            button.removeAttr('disabled');
            return false;
        }
        $('#ajaxLoad').show();
        answers = $scope.getUserAnswers(testType);
        var lesson = idLecture;
        var page = $rootScope.currentPage;
        $http({
            method: "POST",
            url: basePath + "/tests/checkTestAnswer",
            data: $.param({
                user: user,
                test: test,
                answers: answers,
                testType: testType,
                editMode: editMode,
                lesson: lesson,
                page: page
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        })
            .success(function () {
                $('#ajaxLoad').hide();
                if (user != 0) {
                    $scope.isTrueTestAnswer(user, test);
                }
                button.removeAttr('disabled');
            })
            .error(function () {
                $('#ajaxLoad').hide();
                button.removeAttr('disabled');
                console.log('error sendTestAnswer');
            })
    };
    $scope.getUserAnswers = function (testType) {
        if (testType == 1) {
            answer = $('input[name="radioanswer"]:checked').attr("id");
            return answer;
        } else {
            answers = $scope.getMultiplyAnswers();
            return answers;
        }
    };
    $scope.getMultiplyAnswers = function () {
        var answers = $('input[name="checkboxanswer"]:checked');
        var answersValue = [];
        for (var i = 0, l = answers.length; i < l; i++) {
            answersValue.push(answers[i].id);
        }
        return answersValue;
    };
    $scope.isTrueTestAnswer = function (user, test) {
        var command = {
            "user": user,
            "test": test
        };
        var jqxhr = $.post(basePath + "/tests/getTestResult", JSON.stringify(command), function () {
        })
            .done(function (data) {
                if (data['status'] == '1' && data['lastTest'] == '0') {
                    pagesUpdateService.pagesDataUpdate();
                    openDialogsService.openTrueDialog();
                    return false;
                } else if (data['status'] == '1' && data['lastTest'] == '1') {
                    pagesUpdateService.pagesDataUpdate();
                    openDialogsService.openLastTrueDialog();
                    accessLectureService.getAccessLectures();
                    $rootScope.finishedLecture = 1;
                    return false;
                } else {
                    openDialogsService.openFalseDialog();
                    return false;
                }
            })
            .fail(function () {
                bootbox.alert("Вибачте, на сайті виникла помилка і ми не можемо перевірити Вашу відповідь.\n" +
                    "Спробуйте перезавантажити сторінку або напишіть адміністратору");
            })
            .always(function () {
            }, "json");
    };
}