/* Directives */
angular
    .module('mainApp')
    .controller('editProfileController',editProfileController)
    .controller('registrationFormController',registrationFormController)
    .controller('aboutUsCtrl',aboutUsCtrl)
    .controller('sendTeacherLetter',sendTeacherLetter)
    .controller('teacherResponse', teacherResponse);


/* Controllers */
function editProfileController($scope, $http, countryCity, specializations) {
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
        if(element[0].tagName=='INPUT' || element[0].tagName=='TEXTAREA')
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


    $scope.getCurrentSpecializations=function () {
        var promise = $http({
            url: basePath + "/studentreg/getcurrentspecializations",
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
    
    // specializations.getSpecializationsList().then(function (response) {
    //     $scope.specializations=response;
    // });

    specializations.getSpecializationsList().then(function (response) {
        $scope.specializations=response;
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

function registrationFormController($scope, countryCity, careerService, specializations) {
    $scope.educformOn=true;
    
    $scope.include = false;
    $scope.showInclude = function(){alert($scope.include)};

    countryCity.getCountriesList().then(function (response) {
        $scope.countriesList=response;
    });

    careerService.getCareersList().then(function (response) {
        $scope.careers=response;
    });

    specializations.getSpecializationsList().then(function (response) {
        $scope.specializations=response;
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

    $scope.$watch('educformOff', function() {
        if($scope.educformOff){
            $('input[name=educformOff]').val(true);
        }else{
            $('input[name=educformOff]').val(null);
        }
        console.log($('input[name=educformOff]').val());
    }, true);
}

function aboutUsCtrl($scope, $http) {
    $scope.getAboutUsData=function () {
        var promise = $http({
            url: basePath+"/aboutus/getaboutusdata",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.aboutUs=response.data;
        }, function errorCallback() {
            alert("Виникла помилка при завантажені даних сторінки 'Про нас'. Зв'яжіться з адміністратором сайту.");
        });
        return promise;
    };
    $scope.getAboutUsData();
    
    $scope.windowShow=function (buttonNumber, anchor) {
        if (anchor == 1) {
            $("body").animate({"scrollTop": 440}, "fast");
        }
        $scope.openPage=buttonNumber;
    }

    $scope.showAboutUs=function (buttonNumber) {
        if(($('#nextRow').is(':hidden') && $('#prevRow').is(':hidden'))){
            $scope.openPage=buttonNumber;
            $('body,html').animate({scrollTop: $("#anchorAboutUs").offset().top}, 400);
        }
    };
    
    $scope.nextPage=function (buttonNumber) {
        $scope.openPage=buttonNumber;
    }
}

function sendTeacherLetter($scope, $http) {
    $scope.sendLetter=function () {
        $http({
            url: basePath+"/teachers/teacherletter",
            method: "POST",
            data: $.param({
                firstname: $scope.firstname,lastname:$scope.lastname,
                age:$scope.age,education:$scope.education,phone:$scope.phone,
                courses:$scope.courses,email:$scope.email
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data,function () {
                location.reload();
            });
        }, function errorCallback() {
            bootbox.alert("Виникла помилка при відпправлені листа. Зв\'яжіться з адміністрацією.");
        });
    }
}
function teacherResponse($scope, $http) {
    $scope.knowldg = '0';
    $scope.behvr = '0';
    $scope.motivtn = '0';
    
    $('#material').raty({
        score: $scope.knowldg, 
        click: function (score) {
            $scope.knowledge = score;
        }
    });

    $('#behavior').raty({
        score: $scope.behvr, 
        click: function (score) {
            $scope.behavior = score;
        }
    });
    $('#motiv').raty({
        score: $scope.motivtn, 
        click: function (score) {
            $scope.motivation = score;
        }
    });

    $scope.sendResponse=function () {
        if($scope.tmpstr.length < min || $scope.tmpstr.length > max) return;
        $scope.text=$('.wysibb-text-editor').html();
        $http({
            url: basePath+"/profile/sendresponse/?idTeacher="+idTeacher,
            method: "POST", 
            data: $.param({
            knowledge: $scope.knowledge,behavior:$scope.behavior,
            motivation:$scope.motivation,text:$scope.text
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data.msg,function () {
                if(response.data.validation)
                    location.reload();
            });
        }, function errorCallback() {
            bootbox.alert("Виникла помилка при відпправлені відгука. Зв\'яжіться з адміністрацією.");
        });
    }

    var responseButton=document.getElementById('sendResponse');
    if(responseButton) {
        $('#sendResponse').tooltip();

        $('.responseBG').on('mousemove', function (e) { check_charcount($('.wysibb-text-editor'), max, min, e); });
        $('.BBCode').on('keypress', '.wysibb-text-editor', function (e) { check_charcount($(this), max, min, e); });
        function check_charcount(content, max, min, e) {
            $scope.tmpstr = content.text().replace(/\s/gm, '');
            if ($scope.tmpstr.length < min) {
                responseButton.setAttribute('title', minMsg);
                responseButton.setAttribute('style', 'background:gray');
            } else {
                responseButton.removeAttribute('title');
                responseButton.removeAttribute('style');
                if ($scope.tmpstr.length > max) {
                    responseButton.setAttribute('title', maxMsg);
                    responseButton.setAttribute('style', 'background:gray');
                }
            }
            if (e.which != 8 && $scope.tmpstr.length > max) {
                e.preventDefault();
            }
        }
    }
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
    })
    .directive('checkbox', function(){
        return {
            restrict: 'EA',
            require: 'ngModel',
            replace: true,
            template: '<span class="{{class}}"><input id="{{id}}" name="{{name}}" type="checkbox" style="display:none;" ng-checked="ngModel" disabled="{{disabled}}"/></span>',
            scope: {
                name:'@',
                class:  '@',
                id: '@',
                ngModel: '=',
                disabled:'@'
            },
            link: function(scope, element, attrs){
                element.removeAttr('id');
                element.bind('click', function(){
                    if(!attrs.disabled){
                        element.toggleClass('checked');
                        scope.ngModel = !scope.ngModel;
                        scope.$apply();
                    }

                })
            }
        };
    });
