/* Directives */

angular
    .module('teacherApp')
    .controller('teacherCtrl',teacherCtrl);

angular
    .module('teacherApp')
    .controller('messagesCtrl',messagesCtrl);


angular
    .module('teacherApp')
    .controller('mainSliderCtrl',mainSliderCtrl);

angular
    .module('teacherApp')
    .controller('aboutusSliderCtrl',aboutusSliderCtrl);

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
    .controller('sharedlinksCtrl',sharedlinksCtrl);
angular
    .module('teacherApp')
    .controller('responseCtrl',responseCtrl);

angular
    .module('teacherApp')
    .controller('graduateCtrl',graduateCtrl);

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

function messagesCtrl ($scope, $state){

}


function mainSliderCtrl ($scope, $http, $stateParams){
        initMainSliderList();
}

function aboutusSliderCtrl ($scope){
       initAboutusSliderList();
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

function teachersCtrl ($scope){
    initTeachersAdminTable();
}

function sharedlinksCtrl ($scope){
    initShareLinks();
}

function responseCtrl ($scope){
    initTeacherResponsesTable();
}

function graduateCtrl ($scope){
    initGraduatesTable();
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
    $http.get('/_teacher/_admin/config/getConfigList').then(function(data){
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

