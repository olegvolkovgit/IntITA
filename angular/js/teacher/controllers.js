/* Directives */
angular
    .module('teacherApp')
    .controller('teacherCtrl',teacherCtrl);

function teacherCtrl($http, $scope,$compile, $ngBootbox) {

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

}

