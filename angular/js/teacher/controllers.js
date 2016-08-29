/* Directives */

angular
    .module('teacherApp')
    .controller('teacherCtrl',teacherCtrl);

angular
    .module('teacherApp')
    .controller('messagesCtrl',messagesCtrl);

angular
    .module('teacherApp')
    .controller('addressCtrl',addressCtrl);

angular
    .module('teacherApp')
    .controller('studentCtrl',studentCtrl);

angular
    .module('teacherApp')
    .controller('contentManagerCtrl',contentManagerCtrl);

angular
    .module('teacherApp')
    .controller('teachersCtrl',teachersCtrl);

angular
    .module('teacherApp')
    .controller('permissionsCtrl',permissionsCtrl);

angular
    .module('teacherApp')
    .controller('payCtrl',payCtrl);

angular
    .module('teacherApp')
    .controller('moduleAddTeacherCtrl',moduleAddTeacherCtrl);


function teacherCtrl($http, $scope,$compile, $ngBootbox, $location, $state) {

    $scope.fillContainer = function(data)
    {
        container = angular.element(document.querySelector("#pageContainer"));
        container.html('');
        $compile(container.html(data))($scope);
    }

    $scope.ediConsult = function(url)
    {
        var elemId = document.getElementsByName('id');
        var id = elemId[0].value;
        var consult = document.getElementById('consult').value;

        $http({
            method: "POST",
            url:  url,
            data: $jq.param({id:id, consult:consult}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            $scope.fillContainer(data.data);
            $state.go($state.current, {}, {reload: true});
        });
    }

    $scope.ngLoad = function(url)
    {
        $http({
            method: "POST",
            url:  url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            $scope.fillContainer(data.data);

        });
    }

    $scope.ngLoadDashboard = function(url)
    {
        $http({
            method: "POST",
            url:  url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            console.log(url);
            $scope.fillContainer(data.data);
        });
    }

    $scope.loadTeacherPage = function(url,page)
    {
        $http({
            method: "POST",
            url:  url,
            data: $jq.param({page:page}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            $scope.fillContainer(data.data);
        });
    }
    $scope.changeView = function(view){
        $location.path(view);

    };



}

function messagesCtrl ($http, $scope, $state, $compile){
    $scope.sendMessage=function(url){
        receiver = $jq("#receiverId").val();
        if (receiver == "0") {
            bootbox.alert('Виберіть отримувача повідомлення.');
        } else {
            $http({
                method: "POST",
                url:  url,
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
                    bootbox.alert("Ваше повідомлення успішно відправлено.", function() {
                        $state.go("messages", {}, {reload: true})
                    });
                } else {
                    bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                        "напишіть на адресу " + adminEmail, function() {
                        $state.go("messages", {}, {reload: true})
                    });
                }
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    };
    $scope.deleteMessage=function(idMessage,url, receiver){
        bootbox.confirm('Ти дійсно хочеш видалити повідомлення?', function(result) {
            if(result)
                $http({
                    method: "POST",
                    url:  url,
                    data: $jq.param({data:JSON.stringify({
                        message: idMessage,
                        receiver: receiver
                    })}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                    cache: false
                }).then(function successCallback() {
                    $state.go($state.current, {}, {reload: true});
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
        });
    };
    
    $scope.loadMessagesIndex=function(){
        $state.go("messages", {}, {reload: true});
    };

    $scope.reply=function(url){
        var data = {
            receiver: $jq("input[name=receiver]").val(),
            parent: $jq("input[name=parent]").val(),
            subject: $jq("input[name=subject]").val(),
            text: $jq("#text").val()
        };
        $http({
            method: "POST",
            url:  url,
            data: $jq.param(data),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function successCallback(response) {
            if (response.data == "success") {
                bootbox.alert("Ваше повідомлення успішно відправлено.", function() {
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

    $scope.forward=function(url){
        forwardTo = $jq("input[name=forwardToId]").val();
        if (forwardTo == "0") {
            bootbox.alert('Виберіть отримувача повідомлення.');
        } else {
            $http({
                method: "POST",
                url:  url,
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
                    bootbox.alert("Ваше повідомлення успішно відправлено.", function() {
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
    
    $scope.loadForm=function(url, receiver, scenario, message, subject){
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
            url:  url,
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

    $scope.collapse=function (el) {
        $jq(el).toggle("medium");
    }
}

function addressCtrl ($scope, $http, DTOptionsBuilder, $state){
    $http.get(basePath + "/_teacher/_admin/address/getCitiesList").then(function (data) {
        $scope.citiesList = data.data["data"];
    });
    $scope.dtOptionsCity = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[ 0, "asc" ]]);

    $http.get(basePath + "/_teacher/_admin/address/getCountriesList").then(function (data) {
        $scope.countriesList = data.data["data"];
    });
    $scope.dtOptionsCountry = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[ 0, "asc" ]]);

    $scope.editCity= function(url){
        country = $jq('#country').val();
        if (country == 0) {
            bootbox.alert('Виберіть країну.');
        } else {
            id = $jq('[name="id"]').val();
            titleUa = $jq('[name="titleUa"]').val();
            titleRu = $jq('[name="titleRu"]').val();
            titleEn = $jq('[name="titleEn"]').val();

            $http({
                method: "POST",
                url:  url,
                data: $jq.param({
                    id:id,
                    country: country,
                    titleUa: titleUa,
                    titleRu: titleRu,
                    titleEn: titleEn
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                bootbox.alert(response.data, function (){
                    $state.go("admin/address", {}, {reload: true});
                });
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    };
    
    $scope.addCity= function(url){
        country = $jq('#country').val();
        if (country == 0) {
            bootbox.alert('Виберіть країну.');
        } else {
            titleUa = $jq('[name="titleUa"]').val();
            titleRu = $jq('[name="titleRu"]').val();
            titleEn = $jq('[name="titleEn"]').val();

            $http({
                method: "POST",
                url:  url,
                data: $jq.param({
                    country: country,
                    titleUa: titleUa,
                    titleRu: titleRu,
                    titleEn: titleEn
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                bootbox.alert(response.data, function (){
                    $state.go("admin/address", {}, {reload: true});
                });
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    }
}

function studentCtrl ($scope,$location){

}

function contentManagerCtrl ($scope,$location){

}


function moduleAddTeacherCtrl ($scope){
    var teachers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/module/teachersByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        url: user.url
                    };
                });
            }
        }
    });
    teachers.initialize();

    $jq('#typeahead').typeahead(null, {

            name: 'teachers',
            display: 'email',
            limit: 10,
            source: teachers,
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'немає користувачів з таким іменем або email\`ом',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
            }
        }
    );
    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#user").val(item.id);
    });
}

function teachersCtrl ($scope,$http, $state){
    $scope.setTeacherRole=function(url){
        var role = $jq("select[name=role] option:selected").val();
        var teacher = $jq("#teacher").val();
        $http({
            method: "POST",
            url:  url,
            data: $jq.param({role: role, teacher: teacher}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function successCallback(response) {
            bootbox.confirm(response.data, function () {
                $state.go("admin/users/teacher/:id", {id:teacher}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати.");
        });
    };

    $scope.addTeacherAttr=function(url, attr, id, role,header,redirect) {
        user = $jq('#user').val();
        if (!role) {
            role = $jq('#role').val();
        }
        var value = $jq(id).val();

        if (value == 0) {
            bootbox.alert('Введіть дані форми.');
        }
        if (parseInt(user && value)) {
            $http({
                method: "POST",
                url:  url,
                data: $jq.param({user: user, role: role, attribute: attr, attributeValue: value}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                if (response.data == "success") {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        $state.go($state.current, {}, {reload: true});
                    });
                } else {
                    switch (role) {
                        case "trainer":
                            bootbox.alert(response.data);
                            break;
                        case "author":
                            bootbox.alert("Обраний модуль вже присутній у списку модулів даного викладача");
                            break;
                        case "consultant":
                            bootbox.alert("Консультанту вже призначений даний модуль для консультацій");
                            break;
                        case "teacher_consultant":
                            bootbox.alert("Обраний модуль вже присутній у списку модулів даного викладача");
                            break;
                        default:
                            bootbox.alert("Операцію не вдалося виконати");
                            break;
                    }
                }
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    };

    $scope.cancelModuleAttr=function(url, id, attr, role, user, successUrl,tab,header){
        if (!user) {
            user = $jq('#user').val();
        }
        if (!role) {
            role = $jq('#role').val();
        }
        if (user && role) {
            $http({
                method: "POST",
                url: url,
                data: $jq.param({user: user, role: role, attribute: attr, attributeValue: id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                if (response.data == "success") {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        $state.go($state.current, {}, {reload: true});
                    });
                } else {
                    showDialog("Операцію не вдалося виконати.");
                }
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    };
}


function permissionsCtrl ($scope){
    initFreeLectures();
}

function payCtrl ($scope){
    initPayTypeaheads();
}

