/* Directives */
angular
    .module('teacherApp')
    .controller('teacherCtrl',teacherCtrl);

function teacherCtrl($http, $scope,$compile) {


    $scope.manageConsult = function(url)
    {
            $http({
                method: "POST",
                url:  url,
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function(data){
                $scope.fillContainer(data.data);
            });

    };


    $scope.fillContainer = function(data)
    {
        container = angular.element(document.querySelector("#pageContainer"));
        container.html('');
        $compile(container.html(data))($scope);
    }

    $scope.changeConsult = function(id,url)
    {
        $http({
            method: "POST",
            url:  url,
            data: $.param({id:id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            $scope.fillContainer(data.data);
        });
    }

    $scope.ediConsult = function(url)
    {
        var elemId = document.getElementsByName('id');
        var id = elemId[0].value;
        var consult = document.getElementById('consult').value;

        $http({
            method: "POST",
            url:  url,
            data: $.param({id:id, consult:consult}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            $scope.fillContainer(data.data);
            location.reload();
        });
    }

    $scope.removeConsult = function(id,url)
    {
        if(confirm('Ви впевнені що хочете вдалити консультанта?'))
        {
            $http({
                method: "POST",
                url:  url,
                data: $.param({id:id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function(data){
                $scope.fillContainer(data.data);
                location.reload();
            });
        }
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

}

