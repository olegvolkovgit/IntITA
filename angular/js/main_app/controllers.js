/* Directives */
angular
    .module('mainApp')
    .controller('editProfileController',editProfileController)
    .controller('registrationFormController',registrationFormController);

/* Controllers */
function editProfileController($scope, $http, countryCity) {
    //init progress bar
    $scope.dataForm=[];
    $scope.modelsArr=[];
    $scope.progress = 1;
    $scope.avatar=avatar;
    if (avatar == 'noname.png') {
        $scope.progress--;
    }
    $('.indicator').each(function () {
        $scope.modelsArr.push({
            name:$(this).attr('ng-model'),
            msg:$(this).attr('data-source')
        });
    });
    $('#progressBar').show();
    $('#gridBlock').show();

    $scope.focusEmptyField=function (model) {
        var element = angular.element('[ng-model="'+model+'"]');
        if(element.parent().parent().is('#addreg') || element.parent().parent().parent().is('#addreg')){
            $('.tabs').children("ul").children("li:last-child").trigger('click');
        }else{
            $('.tabs').children("ul").children("li:first-child").trigger('click');
        }
        if(element[0].tagName=='INPUT')
            element.focus();
        else element.click();
    };
    $scope.focusAvatar=function() {
       $('#avatar').trigger('click');
   };

    angular.element(document).ready(function () {
        $scope.getCurrentCountryCity().then(function(){
            //get progress
            for (var key in $scope.dataForm) {
                if($scope.dataForm[key].trim()!='')
                    $scope.progress++;
            }
            if(typeof  $scope.selectedCountry!='undefined')
                $scope.progress++;
            if(typeof $scope.selectedCity!='undefined'){
                $scope.progress++;
            }

            var percent = Math.round($scope.progress * (100 / ($scope.modelsArr.length+1))).toFixed(0);
            var percentForGrid = percent - 1;
            var maskMargin = Math.round(percent / 10).toFixed(0) * 30;
            $('#percent').text(percent);
            $("#progressMask").css('margin-left', maskMargin);
            $("#indicators").append("<img src='"+basePath+"/images/icons/crown.png'>");
            var gridML = (percent % 10) * 30;
            var gridMT = (percent - (percent % 10));
            var marginCrowns = (percentForGrid - (percentForGrid % 10)) / 10 * 25 + 25;
            if (percent == 100) {
                $("#twoCrowns img").css('margin-left', -25);
                marginCrowns = 250;
            }
            $("#gridMask").css('margin-left', gridML).css('margin-top', -gridMT);
            $("#crowns img").css('margin-left', -marginCrowns);
        });
    });
    //init progress bar

    $scope.getCurrentCountryCity=function () {
        var promise = $http({
            url: basePath + "/studentreg/getcurrentcountrycity",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.selectedCountry=response.data.country;
            $scope.selectedCity=response.data.city;
        }, function errorCallback() {
            alert("Виникла помилка при завантажені країни-міста. Зв'яжіться з адміністратором сайту.");
        });
        return promise;
    };

    countryCity.getCountriesList().then(function (response) {
        $scope.countriesList=response;
    });

    $scope.$watch('selectedCountry', function() {
        if(typeof $scope.selectedCountry!='undefined'){
            $("#StudentReg_country").val($scope.selectedCountry.id);
            countryCity.getCitiesList($scope.selectedCountry.id).then(function (response) {
                $scope.citiesList=response;
            });
        }else{
            $("#StudentReg_country").val(null);
        }
    }, true);

    $scope.$watch('selectedCity', function() {
        if(typeof $scope.selectedCity!='undefined'){
            $("#StudentReg_city").val($scope.selectedCity.id);
            $('input[name=cityTitle]').val($scope.selectedCity.title);
        }else{
            $("#StudentReg_city").val(null);
            $('input[name=cityTitle]').val(null);
        }
    }, true);

    $scope.modelWatch=function(model){
        if(model=='dataForm.birthday'){
            $scope.dataForm.birthday=angular.element('[ng-model="'+model+'"]').val();
        }
        if(model=='dataForm.phone'){
            $scope.dataForm.phone=angular.element('[ng-model="'+model+'"]').val();
        }
    }
}

function registrationFormController($scope, countryCity) {
    countryCity.getCountriesList().then(function (response) {
        $scope.countriesList=response;
    });

    $scope.$watch('selectedCountry', function() {
        if(typeof $scope.selectedCountry!='undefined'){
            $("#StudentReg_country").val($scope.selectedCountry.id);
            countryCity.getCitiesList($scope.selectedCountry.id).then(function (response) {
                $scope.citiesList=response;
            });
        }else{
            $("#StudentReg_country").val(null);
        }
    }, true);

    $scope.$watch('selectedCity', function() {
        if(typeof $scope.selectedCity!='undefined'){
            $("#StudentReg_city").val($scope.selectedCity.id);
            $('input[name=cityTitle]').val($scope.selectedCity.title);
        }else{
            $("#StudentReg_city").val(null);
            $('input[name=cityTitle]').val(null);
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