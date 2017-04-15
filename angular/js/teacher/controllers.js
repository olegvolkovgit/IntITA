/* Directives */

angular
    .module('teacherApp')
    .controller('cabinetCtrl', cabinetCtrl);

angular
    .module('teacherApp')
    .controller('messagesCtrl', messagesCtrl);

angular
    .module('teacherApp')
    .controller('contentManagerCtrl', contentManagerCtrl);

angular
    .module('teacherApp')
    .controller('editTeacherRoleCtrl', editTeacherRoleCtrl);

angular
    .module('teacherApp')
    .controller('mailCtrl', mailCtrl);

angular
    .module('teacherApp')
    .controller('mainTeacherConsultantCtrl', mainTeacherConsultantCtrl);

angular
    .module('teacherApp')
    .controller('mainAccountantCtrl', mainAccountantCtrl);

angular
    .module('teacherApp')
    .controller('teacherProfileCtrl', teacherProfileCtrl);

function cabinetCtrl($http, $scope, $compile, $location, $state, $timeout,$rootScope, typeAhead, roleAttributeService) {
    //function back() redirect to prev link
    $rootScope.back = function () {
        window.history.back();
    };
    
    $scope.currentLanguage=currentLanguage;
    $scope.languages=['ua','en','ru'];
    $scope.changeLang = function (lang) {
        $http({
            method: "GET",
            url: basePath+'/_teacher/cabinet/changeLang?lg='+lang,
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function () {
            location.reload();
        });
    };

    $scope.countOfMessages = 0;
    var updateCounter = function() {
        $http.get(basePath+'/_teacher/cabinet/getNewMessages',{ignoreLoadingBar: true}).then(function(response){
            $scope.requests = response.data.requests;
            $scope.messages = response.data.messages;
        })
        $timeout(updateCounter, 10000);
    };
    updateCounter();

    $scope.changePageHeader = function (headerText) {
        angular.element(document.querySelector("#pageTitle")).text(headerText);

    };

    $scope.fillContainer = function (data) {
        container = angular.element(document.querySelector("#pageContainer"));
        container.html('');
        $compile(container.html(data))($scope);
    };

    //show information block during some time after some action
    $scope.addUIHandlers = function(msg) {
        holder = angular.element(document.querySelector("#operationMessageHolder"));
        holder.fadeIn();
        holder.html(msg);
        window.setTimeout(function(){ holder.fadeOut(); }, 3000);
    };

    $scope.ngLoad = function (url) {
        $http({
            method: "POST",
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function (data) {
            $scope.fillContainer(data.data);

        });
    };

    $scope.changeView = function (view) {
        $location.path(view);

    };
    //redirect to lecture page
    $scope.lectureLink = function (idLecture, idCourse) {
        $http
            .get(basePath + '/lesson/getLectureLink', {
                params: {
                    idLecture: idLecture,
                    idCourse: idCourse
                }
            })
            .then(function successCallback(response) {
                window.open(response.data);
            }, function errorCallback() {
                return false;
            });
    };
    //redirect to module page
    $scope.moduleLink = function (id) {
        $http({
            url: basePath + '/_teacher/cabinet/getModuleLink',
            method: "POST",
            data: $jq.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            window.open(response.data);
        }, function errorCallback() {
            return false;
        });
    };
    //redirect to course page
    $scope.courseLink = function (id) {
        $http({
            url: basePath + '/_teacher/cabinet/getCourseLink',
            method: "POST",
            data: $jq.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            window.open(response.data);
        }, function errorCallback() {
            return false;
        });
    };
    //redirect to service content
    $scope.serviceLink = function (id) {
        $http({
            url: basePath + '/_teacher/cabinet/getServiceLink',
            method: "POST",
            data: $jq.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            window.open(response.data);
        }, function errorCallback() {
            return false;
        });
    };
    //different typeaheads data
    var activeUsersTypeaheadUrl = basePath+'/_teacher/cabinet/activeUsersByQuery';
    var teachersTypeaheadUrl = basePath+'/_teacher/cabinet/teachersByQuery';
    var moduleTypeaheadUrl = basePath + '/_teacher/cabinet/modulesByQuery';
    var consultantTypeaheadUrl = basePath + '/_teacher/cabinet/consultantsByQuery';
    var authorsTypeaheadUrl = basePath+'/_teacher/cabinet/authorsByQuery';
    var teachersConsultantTypeaheadUrl = basePath+'/_teacher/cabinet/teacherConsultantsByQuery';
    var usersTypeaheadUrl = basePath+'/_teacher/cabinet/usersByQuery';
    var coursesTypeaheadUrl = basePath+'/_teacher/cabinet/coursesByQuery';
    var usersNotTeacherTypeaheadUrl = basePath+'/_teacher/cabinet/usersNotTeacherByQuery';
    var usersForRoleTypeaheadUrl = basePath+'/_teacher/cabinet/usersAddForm';
    var trainersTypeaheadUrl = basePath+'/_teacher/cabinet/trainers';
    var studentsTypeaheadUrl = basePath+'/_teacher/cabinet/studentsByQuery';
    var studentsWithoutTrainerTypeaheadUrl = basePath+'/_teacher/cabinet/studentsWithoutTrainerByQuery';
    var teacherConsultantsByQueryAndModuleTypeaheadUrl = basePath+'/_teacher/cabinet/teacherConsultantsByQueryAndModule';
    var groupTypeaheadUrl = basePath + '/_teacher/_supervisor/superVisor/groupsByQuery';

    $scope.getActiveUsers = function(value){
        return typeAhead.getData(activeUsersTypeaheadUrl,{query : value});
    };
    $scope.getTeachers = function(value){
        return typeAhead.getData(teachersTypeaheadUrl,{query : value});
    };
    $scope.getAuthors = function(value) {
        return typeAhead.getData(authorsTypeaheadUrl,{query : value});
    };
    $scope.getTeachersConsultant = function(value) {
        return typeAhead.getData(teachersConsultantTypeaheadUrl,{query : value});
    };
    $scope.getModules = function(value){
        return typeAhead.getData(moduleTypeaheadUrl,{query : value});
    };
    $scope.getConsultants = function(value){
        return typeAhead.getData(consultantTypeaheadUrl,{query : value});
    };
    $scope.getUsers = function(value){
        return typeAhead.getData(usersTypeaheadUrl,{query : value});
    };
    $scope.getCourses = function(value){
        return typeAhead.getData(coursesTypeaheadUrl,{query : value});
    };
    $scope.getUsersNotTeacher = function(value){
        return typeAhead.getData(usersNotTeacherTypeaheadUrl,{query : value});
    };
    $scope.getUsersForRole = function(role, value, organization){
        return typeAhead.getData(usersForRoleTypeaheadUrl,{role:role, query : value, organization:organization});
    };
    $scope.getTrainers = function(value){
        return typeAhead.getData(trainersTypeaheadUrl,{query : value});
    };
    $scope.getStudents = function(value){
        return typeAhead.getData(studentsTypeaheadUrl,{query : value});
    };
    $scope.getTeacherConsultantsByQueryAndModule = function(value,module){
        return typeAhead.getData(teacherConsultantsByQueryAndModuleTypeaheadUrl,{query : value,module:module});
    };
    $scope.getGroups = function(value){
        return typeAhead.getData(groupTypeaheadUrl,{query : value});
    };
    $scope.getStudentsWithoutTrainer = function(value){
        return typeAhead.getData(studentsWithoutTrainerTypeaheadUrl,{query : value});
    };
}

function messagesCtrl($http, $scope, $state, $compile, NgTableParams, $resource, $filter) {

    $scope.checkboxes = { 'checked': false, items: {} };

    // watch for check all checkbox
    $scope.$watch('checkboxes.checkAll', function() {
        if ($scope.checkboxes)
            angular.forEach($scope.receivedMessagesTable.data, function(item) {
                $scope.checkboxes.items[item.id_message] = $scope.checkboxes.checkAll;
            });

        });
    $scope.$watch('checkboxes.items', function(values) {
            $scope.deleteReceivedMessages = []
        for (var key in values) {
            if (values[key]){
                $scope.deleteReceivedMessages.push(key)
            }
        }
        if ($scope.deleteReceivedMessages.length < $scope.receivedMessagesTable.data.length && $scope.deleteReceivedMessages.length > 0)
            angular.element(document.querySelector("#select_all")).prop('indeterminate',true)
        else if ($scope.deleteReceivedMessages.length == 0){
            angular.element(document.querySelector("#select_all")).prop('indeterminate',false)
        }
    }, true);

    $scope.$watch('dt',function(){
        if ($scope.dt)
            $scope.params.filter()['message.create_date'] = $filter("shortDate")($scope.dt,'yyyy-MM-dd')
    });

    $scope.receivedMessagesTable = new NgTableParams({
        sorting: { 'message.create_date': "desc"},
    }, {
        getData: function (params) {
            delete $scope.deleteReceivedMessages;
            $scope.checkboxes = { 'checked': false, items: {} };
            return $resource(basePath + '/_teacher/messages/getUserReceiverMessages').get(params.url()).$promise.then(function (data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.sentMessagesTable = new NgTableParams({
        sorting: { 'message.create_date': "desc"}

    }, {
        getData: function (params) {
            return $resource(basePath + '/_teacher/messages/getUserSentMessages').get(params.url()).$promise.then(function (data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.deletedMessagesTable = new NgTableParams({
        sorting: { 'message.create_date': "desc"}
    }, {
        getData: function (params) {
            return $resource(basePath + '/_teacher/messages/getUserDeletedMessages').get(params.url()).$promise.then(function (data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.deleteMessages = function(){
        bootbox.confirm("Видалити обрані повідомлення?",function(result){
            if (result){
                $http({
                    method:'POST',
                    url:basePath+'/_teacher/messages/delete',
                    data: $jq.param({
                        data: JSON.stringify({
                            messages: $scope.deleteReceivedMessages,
                        })}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                }).success(function(response){
                    if (response == 'success'){
                        bootbox.alert('Операцію успішно виконано',function(){
                            $scope.receivedMessagesTable.reload().then(function successCallback() {
                                if(!$scope.receivedMessagesTable.data.length){
                                    $state.reload();
                                }
                            });
                        })
                    }
                    else{
                        bootbox.alert('Что-то пошло не так');
                    }
                }).error(function(){
                    bootbox.alert('Что-то пошло не так');
                })
            }
        } );
    };

    $scope.sendMessage = function (url) {
        receiver = $jq("#receiverId").val();
        if (receiver == "0") {
            bootbox.alert('Виберіть отримувача повідомлення.');
        } else {
            $http({
                method: "POST",
                url: url,
                data: $jq.param({
                    receiver: receiver,
                    subject: $jq("input[name=subject]").val(),
                    text: $jq("#text").val(),
                    scenario: "new"
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                if (response.data == "success") {
                    bootbox.alert("Ваше повідомлення успішно відправлено.", function () {
                        $state.go("messages", {}, {reload: true})
                    });
                } else {
                    bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                        "напишіть на адресу " + adminEmail, function () {
                        $state.go("messages", {}, {reload: true})
                    });
                }
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    };
    $scope.deleteMessage = function (idMessage, url, receiver) {
        bootbox.confirm('Ти дійсно хочеш видалити повідомлення?', function (result) {
            if (result)
                $http({
                    method: "POST",
                    url: url,
                    data: $jq.param({
                        data: JSON.stringify({
                            message: idMessage,
                            receiver: receiver
                        })
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                    cache: false
                }).then(function successCallback() {
                    $state.go('messages', {}, {reload: true});
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
        });
    };

    $scope.loadMessagesIndex = function () {
        $state.go("messages", {}, {reload: true});
    };

    $scope.reply = function (url) {
        var data = {
            receiver: $jq("input[name=receiver]").val(),
            parent: $jq("input[name=parent]").val(),
            subject: $jq("input[name=subject]").val(),
            text: $jq("#text").val()
        };
        $http({
            method: "POST",
            url: url,
            data: $jq.param(data),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function successCallback(response) {
            if (response.data == "success") {
                bootbox.alert("Ваше повідомлення успішно відправлено.", function () {
                    $state.go($state.current, {}, {reload: true});
                });
            } else {
                bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                    "напишіть на адресу " + adminEmail);
            }
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати.");
        });
    };

    $scope.forward = function (url) {
        forwardTo = $jq("input[name=forwardToId]").val();
        if (forwardTo == "0") {
            bootbox.alert('Виберіть отримувача повідомлення.');
        } else {
            $http({
                method: "POST",
                url: url,
                data: $jq.param({
                    subject: $jq("input[name=subject]").val(),
                    parent: $jq("input[name=parent]").val(),
                    forwardToId: forwardTo,
                    text: $jq("#text").val()
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                if (response.data == "success") {
                    bootbox.alert("Ваше повідомлення успішно відправлено.", function () {
                        $state.go($state.current, {}, {reload: true});
                    });
                } else {
                    bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                        "напишіть на адресу " + adminEmail);
                }
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    };

    $scope.loadForm = function (url, receiver, scenario, message, subject) {
        idBlock = "#collapse" + message;
        $jq(idBlock).show();
        id = "#form" + message;
        var command = {
            user: user,
            message: message,
            receiver: receiver,
            scenario: scenario,
            subject: subject
        };
        $http({
            method: "POST",
            url: url,
            data: $jq.param({form: JSON.stringify(command)}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function successCallback(response) {
            $jq(id).empty();
            ($compile($jq(id).append(response.data))($scope));
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати.");
        });
    };

    $scope.collapse = function (el) {
        $jq(el).toggle("medium");
    }
}

function contentManagerCtrl($scope, $location) {
    $scope.changePageHeader('Контент менеджер');
}

function editTeacherRoleCtrl($scope, DTOptionsBuilder, teacherService, $stateParams, roleAttributeService) {
    $scope.formData = {};
    $scope.userId=$stateParams.id;
    $scope.currentRole=$stateParams.role;

    $scope.loadTeacherData = function (userId, role) {
        teacherService.dataList({
            id: userId,
            currentRole: role
        }).$promise.then(function (response) {
            $scope.data = response;
        });
    };
    $scope.loadTeacherData($scope.userId, $scope.currentRole);

    $scope.dtModulesOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[2, 'desc']]);
    $scope.dtStudentsOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[2, 'desc']]);

    $scope.onSelectModule = function ($item) {
        $scope.selectedModule = $item;
    };
    $scope.reloadModule = function(){
        $scope.selectedModule=null;
    };
    $scope.onSelectUser = function ($item) {
        $scope.selectedUser = $item;
    };
    $scope.reloadUser = function(){
        $scope.selectedUser=null;
    };
    $scope.clearInputs=function () {
        $scope.formData.userSelected=null;
        $scope.selectedModule=null;
        $scope.selectedUser=null;
        $scope.formData.moduleSelected=null;
    };
    // params: role, role's attribute, users's id, attribute's id
    $scope.setTeacherRoleAttribute = function(role, attribute, userId, attributeId){
        if (attributeId && userId){
            roleAttributeService
                .setRoleAttribute({
                    'attribute': attribute,
                    'attributeValue':attributeId,
                    'role': role,
                    'userId' : userId
                })
                .$promise
                .then(function successCallback(response) {
                    if(response.data=='success'){
                        $scope.loadTeacherData($scope.userId, $scope.currentRole);
                        $scope.addUIHandlers('Операцію успішно виконано');
                    } else $scope.addUIHandlers(response.data);
                    $scope.clearInputs();
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }else{
            bootbox.alert("Введено не всі дані");
        }
    };

    // params: role, role's attribute, users's id, attribute's id
    $scope.cancelTeacherRoleAttribute = function(role, attribute, userId, attributeId){
        if (attributeId && userId){
            roleAttributeService
                .unsetRoleAttribute({
                    'attribute': attribute,
                    'attributeValue':attributeId,
                    'role': role,
                    'userId' : userId
                })
                .$promise
                .then(function successCallback(response) {
                    if(response.data=='success'){
                        $scope.loadTeacherData($scope.userId, $scope.currentRole);
                        $scope.addUIHandlers('Операцію успішно виконано');
                    }
                    else $scope.addUIHandlers(response.data);
                }, function errorCallback(data) {
                    console.log(data);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }else{
            bootbox.alert("Введено не всі дані");
        }

    };

    // params: role, role's attribute, users's id, attribute's id
    $scope.setTrainerRoleAttribute = function(role, attribute, userId, attributeId){
        if (attributeId && userId){
            roleAttributeService
                .setTrainerRoleAttribute({
                    'attribute': attribute,
                    'attributeValue':attributeId,
                    'role': role,
                    'userId' : userId
                })
                .$promise
                .then(function successCallback(response) {
                    if(response.data=='success'){
                        $scope.loadTeacherData($scope.userId, $scope.currentRole);
                        $scope.addUIHandlers('Операцію успішно виконано');
                    } else $scope.addUIHandlers(response.data);
                    $scope.clearInputs();
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }else{
            bootbox.alert("Введено не всі дані");
        }
    };

    // params: role, role's attribute, users's id, attribute's id
    $scope.cancelTrainerRoleAttribute = function(role, attribute, userId, attributeId){
        if (attributeId && userId){
            roleAttributeService
                .unsetTrainerRoleAttribute({
                    'attribute': attribute,
                    'attributeValue':attributeId,
                    'role': role,
                    'userId' : userId
                })
                .$promise
                .then(function successCallback(response) {
                    if(response.data=='success'){
                        $scope.loadTeacherData($scope.userId, $scope.currentRole);
                        $scope.addUIHandlers('Операцію успішно виконано');
                    }
                    else $scope.addUIHandlers(response.data);
                }, function errorCallback(data) {
                    console.log(data);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }else{
            bootbox.alert("Введено не всі дані");
        }

    };
}

function mailCtrl($scope, $http, $stateParams, $ngBootbox) {
    $scope.hideMailError = function () {
        $scope.usernameError = undefined;
    }
    $scope.addCorpAddress = function () {
        if ($scope.mailForm.mailAddress.$dirty && $scope.mailForm.mailAddress.$valid)
        {
            $http({
                method: 'POST',
                url: basePath+"/_teacher/user/addCorpMail",
                data: $jq.param({userId: $stateParams.id, address: $scope.address}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response) {
                    if (response.error == undefined) {
                        $scope.$emit('mailAddressCreated', response);
                        $ngBootbox.hideAll();
                    }
                    else{
                        $scope.usernameError = response.error.username[0];
                    }
            })
        }

    };

}

function mainTeacherConsultantCtrl($scope, $rootScope, $http) {
    $scope.getNewPlainTasksAnswers=function(){
        $http({
            method:'POST',
            url:basePath + '/_teacher/_teacher_consultant/teacherConsultant/getNewPlainTasksAnswersCount',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){;
            $rootScope.countOfNewPlainTasksAnswers=response;
        }).error(function(){
            console.log("Отримати дані про нові відповіді по простих завданнях не вдалося");
        })
    };
    $scope.getNewPlainTasksAnswers();
}

function mainAccountantCtrl($rootScope, paymentSchemaService) {
    paymentSchemaService.getActualSchemesRequests().$promise.then(function(response){
        $rootScope.countOfActualSchemesRequests=response[0];
    });
}

function teacherProfileCtrl($scope, usersService, $state) {
    $scope.changePageHeader('Профіль співробітника');
    $scope.loadTeacherProfileData=function(){
        var promise = usersService.teacherProfileData().$promise.then(
            function successCallback(response) {
                return response.data;
            }, function errorCallback() {
                bootbox.alert("Отримати дані профілю співробітника не вдалося");
            });
        return promise;
    };
    $scope.loadTeacherProfileData().then(function (data) {$scope.teacher=data});

    $scope.updateTeacherProfile= function () {
        usersService.updateTeacherProfile($scope.teacher).$promise.then(function (data) {
            if (data.message === 'OK') {
                bootbox.alert('Профіль співробітника успішно оновлено',function () {});
            } else {
                bootbox.alert('Під час оновлення профілю викладача виникла помилка');
            }
        });
    };
}