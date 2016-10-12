/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lecturePreviewRevisionApp')
    .controller('testCtrl',testCtrl);

function testCtrl($http, $scope) {
    $scope.sendTestAnswer = function (test, testType) {
        var button=angular.element(document.querySelector(".testSubmit"));
        button.attr('disabled', true);
        var checkAnswers = $("#answers" + test + "  input:input:checked:checked");
        if (checkAnswers.length == 0) {
            bootbox.alert('Виберіть хоч один варіант')
            button.removeAttr('disabled');
            return false;
        }
        $('#ajaxLoad').show();
        var answers = $scope.getUserAnswers(testType);
        $http({
            method: "POST",
            url: basePath + "/revision/checkTestAnswer",
            data: $.param({
                test: test,
                answers: answers,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function successCallback(response) {
            $('#ajaxLoad').hide();
            if(response.data)
                bootbox.alert("<span style='color:green'>Відповідь на завдання правильна</span>");
            else bootbox.alert("<span style='color:red'>Відповідь на завдання неправильна</span>");
            button.removeAttr('disabled');

        }, function errorCallback() {
            $('#ajaxLoad').hide();
            button.removeAttr('disabled');
            bootbox.alert("Вибачте, але на сайті виникла помилка. Зв'яжіться з адміністратором сайту.");
        });
    };
    $scope.getUserAnswers = function (testType) {
        if (testType == 1) {
            var answer = $('input[name="radioanswer"]:checked').attr("id");
            return answer;
        } else {
            var answers = $scope.getMultiplyAnswers();
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
}