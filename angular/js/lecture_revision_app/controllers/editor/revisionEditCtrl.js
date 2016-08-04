angular
    .module('revisionEdit')
    .controller('CKEditorCtrl', CKEditorCtrl)

function CKEditorCtrl($compile, $scope, $http, $ngBootbox, getLectureData) {
    //load from service lecture data for scope
    getLectureData.getData(idRevision).then(function(response){
        $.each(response.pages, function(index) {
            if(response.pages[index]['id']==idPage){
                $scope.page=index+1;
                return false;
            }
            $scope.page=1;
        });
    });

    $scope.lectureLocation=window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/')+1);
    $scope.locationToPreview =$scope.lectureLocation+'#/page'+window.location.pathname.substring(window.location.pathname.lastIndexOf('/')+1);
    $scope.previewRevision = function(url) {
        location.href=url;
    };
    $scope.unableSkipTask = function(pageId){
        $ngBootbox.confirm('Ви впевнені, що хочете видалити завдання?')
            .then(function() {
                $http({
                    url: basePath + "/skipTask/unableSkipTask",
                    method: "POST",
                    data: $.param({pageId: pageId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                })
                    .success(function () {
                        location.reload();
                    })
                    .error(function () {
                        alert('error unableSkipTask');
                    })
            }, function() {
            });
    };
    $scope.unablePlainTask = function(pageId){
        $ngBootbox.confirm('Ви впевнені, що хочете видалити завдання?')
            .then(function() {
                $http({
                    url: basePath + "/plainTask/unablePlainTask",
                    method: "POST",
                    data: $.param({pageId: pageId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                })
                    .success(function (response) {
                        location.reload();
                    })
                    .error(function () {
                        alert('error unablePlainTask');
                    })
            }, function() {
            });
    };
    $scope.editorOptions = {
        language: lang
    };
    $scope.editorOptionsCode = {
        language: lang,
        enterMode: CKEDITOR.ENTER_BR
    };
    $scope.editorOptionsTask = {
        language: lang,
        toolbar: 'task'
    };
    $scope.editorOptionsAnswer = {
        language: lang,
        toolbar: 'answer',
        height: '40px'
        //enterMode: CKEDITOR.ENTER_BR
    };
    $scope.editorOptionsSkipTask = {
        language: lang,
        toolbar: 'skipTask'
    };
    $scope.$on("ckeditor.ready", function (event) {
        $scope.isReady = true;
    });

    $scope.getBlockHtml = function (idEl, element) {
        $http({
            url: basePath + '/revision/getLectureElement',
            method: "POST",
            data: $.param({idElement: idEl}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.editRedactor = response.data;
            var template = '<textarea data-ng-cloak class="openCKE" ' +
                'id="openCKE' + idEl + '"' +
                'ckeditor="editorOptions" name="editor" ng-model="editRedactor">' +
                '</textarea>';
            ($compile(template)($scope)).insertAfter(element);
            return true;
        }, function errorCallback() {
            alert($scope.errorMsg);
        });
    };
    $scope.getCodeHtml = function (idEl, element) {
        $http({
            url: basePath + '/revision/getLectureElement',
            method: "POST",
            data: $.param({idElement: idEl}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.editCodeRedactor = response.data;
            var template = '<div id="CKECodeEdit'+idEl+'"><textarea class="openCKE" id="CKECodeEdit" name="editor" >' +
                $scope.editCodeRedactor+'</textarea>'+
                '<input class="btn btn-primary codeBut" type="submit" value="Зберегти" ng-click="saveCodeBlock('+idEl+')">'+
                '<input class="btn btn-primary codeBut" type="submit" value="Закрити" ng-click="closeCodeBlock('+idEl+')">' +
                '<input class="btn btn-primary codeBut removeHtml" type="submit" value="Очистити форматування" ng-click="removeEditHtml()">' +
                '</div>';
            ($compile(template)($scope)).insertAfter(element);
            $scope.myEditCodeMirror = CodeMirror.fromTextArea(document.getElementById('CKECodeEdit'), {
                lineNumbers: true,             // показывать номера строк
                matchBrackets: true,             // подсвечивать парные скобки
                mode: "javascript",
                theme: "rubyblue",               // стиль подсветки
                indentUnit: 4                    // размер табуляции
            });
            return true;
        }, function errorCallback() {
            alert($scope.errorMsg);
        });
    };
    //init test form
    $scope.answers = [{"id":1},{"id":2},{"id":3},{"id":4},{"id":5}];
    var optionsNum = angular.element(document.querySelector("#optionsNum"));
    optionsNum.val(5);

    $scope.addAnswer = function () {
        $scope.answers.push({id: $scope.answers.length });
        optionsNum.val(parseInt(optionsNum.val()) + 1);
    };
    $scope.deleteAnswer = function () {
        $scope.answers.splice(-1, 1);
        if (optionsNum.val() > 0) {
            optionsNum.val(parseInt(optionsNum.val()) - 1);
        }
    };

    /*add Skip Task*/
    $scope.createSkipTaskCKE = function (url, pageId, revisionId,quizType) {
        var questionTemp = $scope.addSkipTaskQuest;
        var condition = $scope.addSkipTaskCond;

        var number=0;
        var question=questionTemp.replace( /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d]*)\">(.+?)<\/span>/g, function(p1,p2,p3,p4,p5) {
            number++;
            return '<span skip=\"'+number+'\:'+p3+'\" style=\"background:'+p4+'\">'+p5+'<\/span>';
        });
        if(number<1){
            bootbox.alert("Виділіть хоч одне слово-пропуск!");
            return;
        }
        text = question.replace( /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d]*)\">(.+?)<\/span>/g, function(p1,p2,p3,p4,p5) {
            return '<input type=text size="'+p5.length+'" id=skipTask'+p2+' caseInsensitive='+p3+' />';
        });
        pattern = /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d]*)\">(.+?)<\/span>/ig;

        var newSkipTask = {
            "pageId":pageId,
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
                bootbox.alert("Вибачте, але на сайті виникла помилка і додати завдання до заняття наразі неможливо. " +
                    "Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
                //location.reload();
            })
            .always(function () {
            });
    };

    //add content block
    $scope.addTextBlock = function(type){
        $scope.instructionStyle = false;
        document.getElementById('addBlock').style.display = 'block';
        document.getElementById('blockFormCode').style.display = 'none';
        document.getElementById('blockForm').style.display = 'block';
        document.getElementById('blockType').value = type;
    };
    $scope.addInstructionBlock = function(type){
        $scope.instructionStyle=true;
        document.getElementById('addBlock').style.display = 'block';
        document.getElementById('blockFormCode').style.display = 'none';
        document.getElementById('blockForm').style.display = 'block';
        document.getElementById('blockType').value = type;
    };
    $scope.addCodeBlock = function(type) {
        $scope.instructionStyle = false;
        document.getElementById('addBlock').style.display = 'block';
        document.getElementById('blockForm').style.display = 'none';
        document.getElementById('blockFormCode').style.display = 'block';
        document.getElementById('blockTypeCode').value = type;
        if (typeof myCodeMirror=='undefined') {
            myCodeMirror = CodeMirror.fromTextArea(document.getElementById('CKECode'), {
                lineNumbers: true,             // показывать номера строк
                matchBrackets: true,             // подсвечивать парные скобки
                mode: "javascript",
                theme: "rubyblue",               // стиль подсветки
                indentUnit: 4                    // размер табуляции
            });
        }
    };

    $scope.saveCodeBlock= function(idEl){
            $http({
                url: basePath+'/revision/editLectureElement',
                method: "POST",
                data: $.param({html_block: $scope.myEditCodeMirror.getValue(), idElement: idEl,
                    idRevision: idRevision, idPage: idPage}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            })
                .success(function (response) {
                    if(response.length==0){
                        $ngBootbox.alert($scope.saveMsg)
                            .then(function() {
                            });
                    } else {
                        $ngBootbox.alert(response)
                            .then(function() {
                            });
                    }
                })
                .error(function () {
                    alert($scope.errorMsg);
                })
    };
    $scope.closeCodeBlock= function(order){
        angular.element('#CKECodeEdit' + order).remove();
        angular.element('#t' + order).show();

        $.fn.yiiListView.update('blocks_list', {
            complete: function () {
                var template = angular.element('#blockList').html();
                angular.element('#blockList').empty();
                angular.element('#blockList').append(($compile(template)($scope)));
                setTimeout(function() {
                    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
                });
            }
        });
    };
    $scope.removeEditHtml= function(){
        $scope.myEditCodeMirror.setValue($scope.myEditCodeMirror.getValue().replace(/<\/?[^>]+>/g,''));
    };
    $scope.addPageVideo=function(idPage,idRevision){
        var pageVideo=angular.element(document.querySelector("#pageVideo"));
        $http({
            url: basePath+'/revision/addVideo',
            method: "POST",
            data: $.param({idPage: idPage, idRevision: idRevision, url: pageVideo.val()}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        })
            .success(function () {
                bootbox.alert('Відео додано', function () {
                    location.reload();
                });
            })
            .error(function () {
                bootbox.alert('Посилання на відео додати не вдалося');
            })
    };
    $scope.deleteVideo=function(idPage,idRevision,idElement){
        $ngBootbox.confirm('Ви впевнені, що хочете видалити відео?')
            .then(function() {
                $http({
                    url: basePath + '/revision/deleteVideo',
                    method: "POST",
                    data: $.param({idPage: idPage, idRevision: idRevision, pk: idElement}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    location.reload();
                }, function errorCallback() {
                    bootbox.alert("Видалити відео не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
            });
    };
    $scope.deleteTest=function(revisionId,pageId,idBlock){
        $ngBootbox.confirm('Ви впевнені, що хочете видалити тест?')
            .then(function() {
                $http({
                    url: basePath + '/revision/deleteTest',
                    method: "POST",
                    data: $.param({revisionId: revisionId,pageId: pageId,idBlock: idBlock}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    location.reload();
                }, function errorCallback() {
                    bootbox.alert("Видалити тест не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
            });
    };

    $scope.cancelQuiz=function() {
        location.reload();
    }
}

function blockValidation() {
    if(myCodeMirror.getValue().trim()==''){
        bootbox.alert('Блок не може бути пустий');
        return false;
    }else{
        return true;
    }
}
function removeHtml() {
    myCodeMirror.setValue(myCodeMirror.getValue().replace(/<\/?[^>]+>/g,''));
}

function showAddTaskFormCKE(taskType){
    task = taskType;
    document.getElementById('addTask').style.display = 'block';
    document.getElementById('buttonsPanel').style.display = 'none';
}

function showAddSkipTaskFormCKE(){
    document.getElementById('addSkipTask').style.display = 'block';
    document.getElementById('buttonsPanel').style.display = 'none';
}

function showAddTestFormCKE(testType){
    document.getElementById('testType').value = testType;
    document.getElementById('addTest').style.display = 'block';
    document.getElementById('buttonsPanel').style.display = 'none';
}
function showAddPlainTaskFormCKE(testType){
    document.getElementById('plainTaskType').value = testType;
    document.getElementById('addPlainTask').style.display = 'block';
    document.getElementById('buttonsPanel').style.display = 'none';
}

function hideFormCKE(id) {
    $form = document.getElementById(id);
    $form.style.display = 'none';
}
