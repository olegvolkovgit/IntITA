angular
    .module('teacherApp')
    .controller('mainSliderTableCtrl',mainSliderTableCtrl)
    .controller('aboutUsSliderTableCtrl',aboutUsSliderTableCtrl)

function mainSliderTableCtrl ($http, $scope, DTOptionsBuilder,$state){
    $scope.loadMainSliderList=function(){
        $http.get(basePath + "/_teacher/_admin/carousel/getItemsList").then(function (data) {
            $scope.sliderList = data.data["data"];
        });
    };
    $scope.loadMainSliderList();
    
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[0, 'asc']]);

    $scope.deleteSlide=function(url) {
        bootbox.confirm('Видалити слайд?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    bootbox.alert("Слайд видалено.", function () {
                        $state.go("admin/carousel", {}, {reload: true});
                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            } else {
                bootbox.alert("Операцію відмінено.");
            }
        });
    };

    $scope.mainSlideAction=function(action,order) {
        var url = basePath+'/_teacher/_admin/carousel/'+action+'/order/' + order;
        $http.get(url).then(function successCallback() {
            $scope.loadMainSliderList();
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати.");
        });
    }
}
function aboutUsSliderTableCtrl ($http, $scope, DTOptionsBuilder,$state){
    $scope.loadAboutUsSliderList=function(){
        $http.get(basePath + "/_teacher/_admin/aboutusSlider/getItemsList").then(function (data) {
            $scope.sliderList = data.data["data"];
        });
    };
    $scope.loadAboutUsSliderList();
    
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[0, 'asc']]);

    $scope.deleteSlideAboutUs=function(url) {
        bootbox.confirm('Видалити слайд?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    bootbox.alert("Слайд видалено.", function () {
                        $state.go("admin/aboutusSlider", {}, {reload: true});
                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            } else {
                bootbox.alert("Операцію відмінено.");
            }
        });
    }

    $scope.aboutUsSlideAction=function(action,order) {
        var url = basePath+'/_teacher/_admin/aboutusSlider/'+action+'/order/' + order;
        $http.get(url).then(function successCallback() {
            $scope.loadAboutUsSliderList();
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати.");
        });
    }
}