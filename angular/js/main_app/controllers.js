/* Directives */
angular
    .module('mainApp')
    .controller('validationController',validationController);

/* Controllers */
function validationController($scope, $http) {
    $scope.getCountriesList=function () {
        var promise = $http({
            url: basePath + "/studentReg/getCountriesList",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            alert("Виникла помилка при завантажені списку країн. Зв'яжіться з адміністратором сайту.");
        });
        return promise;
    };

    $scope.getCitiesList=function (idCountry) {
        var promise = $http({
            url: basePath + "/studentReg/getCitiesList",
            method: "POST",
            data: $.param({id: idCountry}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            alert("Виникла помилка при завантажені списку міст. Зв'яжіться з адміністратором сайту.");
        });
        return promise;
    };

    $scope.getCountriesList().then(function (response) {
        $scope.countriesList=response;
        // $scope.countriesList.push({
        //     id: 0,
        //     title: 'не вибрано'
        // });
    });

    $scope.$watch('selectedCountry', function() {
        if(typeof $scope.selectedCountry!='undefined'){
            $scope.getCitiesList($scope.selectedCountry.id).then(function (response) {
                $scope.citiesList=response;
            });
        }
    }, true);
}

angular.module('mainApp.directives', [])
    .directive('pwCheck', [function () {
        return {
            require: 'ngModel',
            link: function (scope, elem, attrs, ctrl) {
                var me = attrs.ngModel;
                var matchTo = attrs.pwCheck;
                scope.$watchGroup([me, matchTo], function(value){
                    ctrl.$setValidity('pwmatch', value[0] === value[1] );
                });
            }
        }
    }])
    .directive('fileCheck', function() {
        var validFormats = ['jpg', 'png', 'gif','jpeg'];
        return {
            require: 'ngModel',
            link: function(scope, element, attributes, ngModelController) {
                var maxFileSize = Number(attributes.maxFileSize) || Number.MAX_VALUE;
                element.bind('change', function() {
                    var file = this.files[0];
                    ngModelController.$setValidity('size', file.size <= maxFileSize);
                    var value = element.val(),
                        ext = value.substring(value.lastIndexOf('.') + 1).toLowerCase();
                    ngModelController.$setValidity('fileType', validFormats.indexOf(ext) !== -1);
                    scope.$apply();
                });
            }
        };
    });