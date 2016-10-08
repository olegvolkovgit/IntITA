angular
    .module('revisionEdit')
    .controller('skipTaskCtrl', skipTaskCtrl)

function skipTaskCtrl($scope, $http) {

    $scope.getDataSkipTask = function(id) {
        var promise = $http({
            url: basePath+'/revision/dataSkipTaskCondition',
            method: "POST",
            data: $.param({idBlock: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getDataSkipTask($scope.idBlock).then(function (response) {
        $scope.dataSkipTask=response;
    });

    $scope.editSkipTaskCKE = function (url, pageId, revisionId,quizType) {
        var questionTemp = $scope.dataSkipTask.source;
        var condition = $scope.dataSkipTask.condition;

        var number=0;
        var question=questionTemp.replace( /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d][^\>]*)\">(.+?)<\/span>/g, function(p1,p2,p3,p4,p5) {
            number++;
            return '<span skip=\"'+number+'\:'+p3+'\" style=\"background:'+p4+'\">'+p5+'<\/span>';
        });
        if(number<1){
            bootbox.alert("Виділіть хоч одне слово-пропуск!");
            return;
        }
        text = question.replace( /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d][^\>]*)\">(.+?)<\/span>/g, function(p1,p2,p3,p4,p5) {
            return '<input type=text size="'+p5.length+'" id=skipTask'+p2+' caseInsensitive='+p3+' />';
        });
        pattern = /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d][^\>]*)\">(.+?)<\/span>/ig;

        var newSkipTask = {
            "pageId":pageId,
            "idBlock":$scope.idBlock,
            "revisionId":revisionId,
            "idType":quizType,
            "question": question,
            "condition":condition,
            "text": text,
            "answer": []
        };
        while (result = pattern.exec(question)) {
            newSkipTask.answer.push({
                "index": result[1],
                "caseInsensitive":result[2],
                "value":  result[4].replace(/[\u200B-\u200D\uFEFF]/g, '')
            });
        }

        var jsonSkip = $.post(url, newSkipTask, function () {
        })
            .done(function () {
                bootbox.alert("Завдання успішно додано до лекції!", function () {location.reload()});
            })
            .fail(function () {
                return;
                bootbox.alert("Вибачте, але на сайті виникла помилка і додати завдання до заняття наразі неможливо. " +
                    "Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
            })
            .always(function () {
            });
    };
}

function checkAnswersCKE(answers){
    if($("textarea.testVariant").length<5){
        bootbox.alert("Мінімальна кількість варіантів відповіді не повина бути менше 5");
        return false;
    }
    if($("textarea.testVariant").length>10){
        bootbox.alert("Максимальна кількість варіантів відповіді не повина бути більше 10");
        return false;
    }
    if(answers.length==0){
        bootbox.alert("Виберіть хоч один правильний варіант перед створенням тесту");
        return false;
    }
}