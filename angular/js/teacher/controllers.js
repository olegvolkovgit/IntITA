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
    .controller('freelecturesCtrl',freelecturesCtrl);

angular
    .module('teacherApp')
    .controller('permissionsCtrl',permissionsCtrl);

angular
    .module('teacherApp')
    .controller('payCtrl',payCtrl);

angular
    .module('teacherApp')
    .controller('levelsCtrl',levelsCtrl)

angular
    .module('teacherApp')
    .controller('configCtrl',configCtrl)

angular
    .module('teacherApp')
    .controller('oldCtrl',oldCtrl)

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
            location.reload();
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

function messagesCtrl ($http, $scope, $state){
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

    $scope.loadMessagesIndex=function(){
        $state.go("messages", {}, {reload: true});
    }
}

function addressCtrl ($scope){
    initCountriesList();
    initCitiesList();
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
                        location.reload();
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
                        location.reload();
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

function freelecturesCtrl ($scope){
    initFreeLectures();
}

function permissionsCtrl ($scope){
    initFreeLectures();
}

function payCtrl ($scope){
    initPayTypeaheads();
}

function levelsCtrl ($scope){
    $jq('#levelsTable').DataTable({
            language: {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
            }
        }
    );
}

function configCtrl ($scope, $http, DTOptionsBuilder){
    $scope.configsite  =  null;
    $http.get(basePath+'/_teacher/_admin/config/getConfigList').then(function(data){
            $scope.configsite = data.data["data"];

    });
     $scope.dtOptions = DTOptionsBuilder.newOptions()
                                        .withPaginationType('simple_numbers')
                                        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json');;

    //initConfigTable();

}

function oldCtrl ($scope){
    initConfigTable();
}

