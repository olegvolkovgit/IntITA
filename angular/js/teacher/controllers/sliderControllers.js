angular
    .module('teacherApp')
    .controller('mainSliderTableCtrl',mainSliderTableCtrl)
    .controller('aboutUsSliderTableCtrl',aboutUsSliderTableCtrl)

function mainSliderTableCtrl ($http, $scope, DTOptionsBuilder,$state){
    $http.get(basePath + "/_teacher/_admin/carousel/getItemsList").then(function (data) {
        $scope.sliderList = data.data["data"];
    });
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
    }
}
function aboutUsSliderTableCtrl ($http, $scope, DTOptionsBuilder,$state){
    $http.get(basePath + "/_teacher/_admin/aboutusSlider/getItemsList").then(function (data) {
        $scope.sliderList = data.data["data"];
    });
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
}