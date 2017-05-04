angular
    .module('teacherApp')
    .controller('mainSliderTableCtrl',mainSliderTableCtrl)
    .controller('mainSliderCtrl',mainSliderCtrl)
    .controller('aboutUsSliderTableCtrl',aboutUsSliderTableCtrl)
    .controller('aboutUsSliderCtrl',aboutUsSliderCtrl)

function mainSliderTableCtrl ($http, $scope, DTOptionsBuilder,$state){
    var url=basePath + "/_teacher/_super_admin";

    $scope.changePageHeader('Слайдер на головній сторінці');
    $scope.loadMainSliderList=function(){
        $http.get(url+"/carousel/getItemsList").then(function (data) {
            $scope.sliderList = data.data["data"];
        });
    };
    $scope.loadMainSliderList();
    
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[0, 'asc']]);

    $scope.deleteSlide=function(id) {
        bootbox.confirm('Видалити слайд?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url+"/carousel/delete?id="+id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    bootbox.alert("Слайд видалено.", function () {
                        $state.go("carousel", {}, {reload: true});
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
        $http.get(url+'/carousel/'+action+'/order/' + order).then(function successCallback() {
            $scope.loadMainSliderList();
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати.");
        });
    }
}

function mainSliderCtrl ($http, $scope,$state){
    var url=basePath + "/_teacher/_super_admin";

    $scope.changePageHeader('Слайдер на головній сторінці');
    
    $scope.deleteSlide=function(id) {
        bootbox.confirm('Видалити слайд?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url+"/carousel/delete?id="+id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    bootbox.alert("Слайд видалено.", function () {
                        $state.go("carousel", {}, {reload: true});
                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            } else {
                bootbox.alert("Операцію відмінено.");
            }
        });
    };
}

function aboutUsSliderTableCtrl ($http, $scope, DTOptionsBuilder,$state){
    var url=basePath + "/_teacher/_super_admin";

    $scope.changePageHeader('Слайдер на сторінці Про нас');
    $scope.loadAboutUsSliderList=function(){
        $http.get(url+"/aboutusSlider/getItemsList").then(function (data) {
            $scope.sliderList = data.data["data"];
        });
    };
    $scope.loadAboutUsSliderList();
    
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[0, 'asc']]);

    $scope.deleteSlideAboutUs=function(id) {
        bootbox.confirm('Видалити слайд?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url+"/aboutusSlider/delete?id="+id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    bootbox.alert("Слайд видалено.", function () {
                        $state.go("aboutusSlider", {}, {reload: true});
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
        $http.get(url+'/aboutusSlider/'+action+'/order/' + order).then(function successCallback() {
            $scope.loadAboutUsSliderList();
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати.");
        });
    }
}

function aboutUsSliderCtrl ($http, $scope,$state){
    var url=basePath + "/_teacher/_super_admin";

    $scope.changePageHeader('Слайдер на сторінці Про нас');
    
    $scope.saveSliderTextPosition= function (id){
        bootbox.confirm('Зберегти позицію тексту?', function (result) {
            if (result) {
                var text = document.getElementById('textPosition');
                var sliderBox=document.getElementById('sliderContainer');
                var left=(text.offsetLeft+text.offsetWidth/2)/sliderBox.offsetWidth*100;
                var top=text.offsetTop/sliderBox.offsetHeight*100;
                if($scope.sliderColorPreview())
                    var color=$scope.sliderColorPreview();
                else return;

                $jq.ajax({
                    url: url+"/aboutusSlider/saveTextPosition",
                    type: "POST",
                    data: {
                        'id': id,
                        'left': left,
                        'top': top,
                        'color': color
                    },
                    async: true,
                    success: function () {
                        bootbox.alert("Позицію тексту збережено", function () {
                        });
                    },
                    error: function () {
                        showDialog("Операцію не вдалося виконати.");
                    }
                });
            }
        });
    }
    $scope.sliderColorPreview= function (){
        var text = document.getElementById('textPosition');
        var color=document.getElementById('textColor').value;
        var regHEX = /^#(?:[0-9a-f]{3}){1,2}$/i;
        if (!regHEX.test(color)) {
            bootbox.alert('Заданий колір не відповідає HEX формату');
            return false;
        }else{
            text.style.color=color;
            return color;
        }
    };

    $scope.deleteSlideAboutUs=function(id) {
        bootbox.confirm('Видалити слайд?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url+"/aboutusSlider/delete?id="+id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    bootbox.alert("Слайд видалено.", function () {
                        $state.go("aboutusSlider", {}, {reload: true});
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