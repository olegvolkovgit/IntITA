/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lecturePreviewRevisionApp')
    .controller('skipTaskCtrl',skipTaskCtrl);

function skipTaskCtrl($http, $scope) {
    $scope.sendSkipTaskAnswer=function(id){
        var button=angular.element(document.querySelector(".taskSubmit"));
        button.attr('disabled', true);
        for(var i = 0; i < skipTaskQuestion.getElementsByTagName('input').length;i++) {
            skipTaskQuestion.getElementsByTagName('input')[i].value=skipTaskQuestion.getElementsByTagName('input')[i].value.trim();
        }
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
        if(!check){
            button.removeAttr('disabled');
            return check;
        }
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
        var url = basePath + "/revision/checkSkipAnswer";
        $('#ajaxLoad').show();
        $http({
            method: "POST",
            url:  url,
            data: $.param({answers: answers, id : id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function successCallback(response) {
            $('#ajaxLoad').hide();
            if(response.data == 'noAnswers') {
                bootbox.alert("<span style='color:red'>Виникла помилка при збережені відповідей на завдання. Перезбережіть завдання ревізії або зв\'яжіться з адміністрацією</span>")
            }else if(response.data)
                bootbox.alert("<span style='color:green'>Відповідь на завдання вірна</span>");
            else bootbox.alert("<span style='color:red'>Відповідь на завдання не вірна</span>");
            button.removeAttr('disabled');

        }, function errorCallback() {
            $('#ajaxLoad').hide();
            button.removeAttr('disabled');
            bootbox.alert("Вибачте, але на сайті виникла помилка. Зв'яжіться з адміністратором сайту.");
        });
    };
}
$('html').on('keyup','.emptyField', function () {
    if($(this).hasClass("emptyField"))
    $(this).removeClass('emptyField');
});