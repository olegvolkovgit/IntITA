/* Directives */
angular
    .module('mainApp')
    .controller('editProfileController',editProfileController)
    .controller('registrationFormController',registrationFormController)
    .controller('aboutUsCtrl',aboutUsCtrl)
    .controller('sendTeacherLetter',sendTeacherLetter)
    .controller('teacherResponse', teacherResponse)
    .controller('promotionSchemesCtrl',promotionSchemesCtrl)


/* Controllers */
function editProfileController($scope, $http, countryCity, careerService, specializations, $q, $timeout, FileUploader, documentsServices) {
    $scope.focusField = function(model,select){
        $timeout(function () {
            $scope.$digest();
            if(typeof select!='undefined'){
                $scope.focusEmptyField(model);
                $scope.focusUiSelect(model);
            }else if(typeof model!='undefined'){
                $scope.focusEmptyField(model);
            }
        });
    };
    $scope.files = [];
    $scope.form = [];

    //init progress bar
    $scope.dataForm=[];
    $scope.form=[];
    $scope.form.careerStart=[];
    $scope.form.specializations=[];
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
    $('ui-select').each(function () {
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
            $('.tabs').children("ul").children("li:nth-child(2)").trigger('click');
        }else if(element.parent().parent().is('#mainreg') || element.parent().parent().parent().is('#mainreg')){
            $('.tabs').children("ul").children("li:first-child").trigger('click');
        }else{
            $('.tabs').children("ul").children("li:last-child").trigger('click');
        }
        if(element[0].tagName=='INPUT' || element[0].tagName=='TEXTAREA')
            element.focus();
        else element.click();
    };
    $scope.focusUiSelect=function (model) {
        var element = angular.element('[ng-model="'+model+'"]');
        if(element.parent().parent().is('#addreg') || element.parent().parent().parent().is('#addreg')){
            $('.tabs').children("ul").children("li:nth-child(2)").trigger('click');
        }else if(element.parent().parent().is('#mainreg') || element.parent().parent().parent().is('#mainreg')){
            $('.tabs').children("ul").children("li:first-child").trigger('click');
        }else{
            $('.tabs').children("ul").children("li:last-child").trigger('click');
        }
        var selectInput=element.find('input');
        selectInput.focus();
    };
    $scope.focusAvatar=function() {
       $('#avatar').trigger('click');
   };

    angular.element(document).ready(function () {
        $q.all([
            $scope.getCurrentCountryCity(),
            careerService.getCareersList(),
            $scope.getCurrentCareers(),
            $scope.getCurrentSpecializations(),
            specializations.getSpecializationsList()
        ]).then(function (response) {
            $scope.careers=response[1];
            $scope.currentCareers=response[2];
            $scope.currentSpecializations=response[3];
            $scope.specializations=response[4];

            $scope.currentCareers.forEach(function(item, key) {
                if (_.find($scope.currentCareers, ['id_career', item.id_career]) && _.find($scope.careers, ['id', item.id_career])) {
                    $scope.form.careerStart[key]=_.find($scope.careers, ['id', item.id_career]);
                }
            });
            $scope.currentSpecializations.forEach(function(item, key) {
                if (_.find($scope.currentSpecializations, ['id_specialization', item.id_specialization]) && _.find($scope.specializations, ['id', item.id_specialization])) {
                    $scope.form.specializations[key]=_.find($scope.specializations, ['id', item.id_specialization]);
                }
            });


            for (var key in $scope.dataForm) {
                if($scope.dataForm[key].trim()!='')
                    $scope.progress++;
            }
            if(typeof  $scope.form.selectedCountry!='undefined')
                $scope.progress++;
            if(typeof $scope.form.selectedCity!='undefined'){
                $scope.progress++;
            }
            if($scope.form.careerStart.length){
                $scope.progress++;
            }
            if($scope.form.specializations.length){
                $scope.progress++;
            }
            var percent = Math.round($scope.progress * (100 / ($scope.modelsArr.length + 1))).toFixed(0);
            var percentInStudentProfile = document.getElementById('percent').innerHTML = percent;

            $scope.writeRatingTable = function(percent) {
                var lineProgress = document.getElementById('gridProgress');
                var i = 0;
                j = 0;
                var count = 0;

                for (i; i < 10; i++) {
                    var ul = document.createElement('ul');

                    for (j; j < 10; j++) {
                        count++;
                        var li = document.createElement('li');
                        li.appendChild(document.createTextNode(' '));
                        ul.appendChild(li);
                        if (count > percent) {
                            li.style.background = '#d9e4ee';
                        }
                    }
                    j = 0;
                    lineProgress.insertBefore(ul, lineProgress.firstChild);
                }

                var crown = document.getElementById('crowns');
                crown.style.backgroundPositionX = -Math.ceil(percent / 10) * 25 + 'px';

            }

            $scope.writeRatingLine = function(percent) {

                var progresssLine = document.getElementById('progressLine');
                var i = 0;
                var count = 0;
                var ul = document.createElement('ul');
                for (i; i < 10; i++) {
                    count+=10;
                    var li = document.createElement('li');
                    li.appendChild(document.createTextNode(' '));
                    ul.appendChild(li);
                    var temp = count - percent;

                    if (count < percent || (temp < 5 && temp > 0)) {
                        li.style.background = '#4b75b4';
                    }
                }
                progressLine.appendChild(ul);

                var crown = document.getElementById('twoCrowns');
                if(percent === 100) {
                    crown.style.backgroundPositionX = '-25px';
                }
            }
            $scope.writeRatingTable(percent);
            $scope.writeRatingLine(percent);
            $scope.loadProgress=true;
        });
    });
    //init progress bar

    $scope.getCurrentCountryCity=function () {
        var promise = $http({
            url: basePath + "/studentreg/getcurrentcountrycity",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.form.selectedCountry=response.data.country;
            $scope.form.selectedCity=response.data.city;
        }, function errorCallback() {
            alert("Виникла помилка при завантажені країни-міста. Зв'яжіться з адміністратором сайту.");
        });
        return promise;
    };

    countryCity.getCountriesList().then(function (response) {
        $scope.countriesList=response;
    });

    //specializations list
    $scope.getCurrentSpecializations=function () {
        var promise = $http({
            url: basePath + "/studentreg/getcurrentspecializations",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            console.log("Виникла помилка при завантажені спеціалізацій яким надано перевагу. Зв'яжіться з адміністратором сайту.");
        });
        return promise;
    };
    //specializations list

    //careers list
    $scope.getCurrentCareers=function () {
        var promise = $http({
            url: basePath + "/studentreg/getcurrentcareers",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            console.log("Виникла помилка при завантажені кар'єр яким надано перевагу. Зв'яжіться з адміністратором сайту.");
        });
        return promise;
    };
    //careers list

    $scope.careersListToString = function(careers){
        var careersString=[];
        if(careers){
            careers.forEach(function(item) {
                careersString.push({
                    id: item.id,
                });
            });
            $('input[name=careers]').val(JSON.stringify(careersString));
        }
    };
    $scope.specializationsListToString = function(specializations){
        var specializationsString=[];
        if(specializations){
            specializations.forEach(function(item) {
                specializationsString.push({
                    id: item.id,
                });
            });
            $('input[name=specializations]').val(JSON.stringify(specializationsString));
        }
    };

    $scope.avatarStringToField = function(myCroppedImage){
        if(myCroppedImage){
            $('input[name=avatar]').val(myCroppedImage);
        }
    };

    $scope.sendForm=function (form) {
        $scope.careersListToString(form.careerStart);
        $scope.specializationsListToString(form.specializations);
        $scope.avatarStringToField($scope.myCroppedImage);
    };
    
    $scope.$watch('form.selectedCountry', function() {
        if(typeof $scope.form.selectedCountry!='undefined'){
            $("#StudentReg_country").val($scope.form.selectedCountry.id);
            countryCity.getCitiesList($scope.form.selectedCountry.id).then(function (response) {
                $scope.form.citiesList=response;
            });
        }else{
            $("#StudentReg_country").val(null);
        }
    }, true);

    $scope.$watch('form.selectedCity', function() {
        if(typeof $scope.form.selectedCity!='undefined'){
            $("#StudentReg_city").val($scope.form.selectedCity.id);
            $('input[name=cityTitle]').val($scope.form.selectedCity.title);
        }else{
            $("#StudentReg_city").val(null);
            $('input[name=cityTitle]').val(null);
        }
    }, true);

    $scope.modelWatch=function(model){
        if(model=='dataForm.birthday'){
            $scope.dataForm.birthday=angular.element('[ng-model="'+model+'"]').val();
        }
        if(model=='dataForm.document_issued_date'){
            $scope.dataForm.document_issued_date=angular.element('[ng-model="'+model+'"]').val();
        }
        if(model=='dataForm.phone'){
            $scope.dataForm.phone=angular.element('[ng-model="'+model+'"]').val();
        }
    }

    $scope.$watch('form.educformOff', function() {
        if($scope.form.educformOff){
            $('input[name=educformOff]').val(true);
        }else{
            $('input[name=educformOff]').val(null);
        }
    }, true);

    //crop image
    $scope.myImage='';
    $timeout(function(){
        $scope.$digest();
        $scope.myCroppedImage='';
    }, 1000);

    var handleFileSelect=function(evt) {
        var file=evt.currentTarget.files[0];
        var reader = new FileReader();
        reader.onload = function (evt) {
            $scope.$apply(function($scope){
                $scope.myImage=evt.target.result;
            });
        };
        reader.readAsDataURL(file);
    };
    angular.element(document.querySelector('#chooseAvatar')).on('change',handleFileSelect);

    //documents
    var documentUploader = $scope.documentUploader = new FileUploader({
        url: basePath+'/studentreg/uploadDocuments?type=1',
        removeAfterUpload: true
    });
    documentUploader.onCompleteAll = function() {
        $scope.loadDocuments();
    };
    documentUploader.onErrorItem = function(item, response, status, headers) {
        if(status==500)
            bootbox.alert("Виникла помилка при завантажені документа.");
    };

    var innUploader = $scope.innUploader = new FileUploader({
        url: basePath+'/studentreg/uploadDocuments?type=2',
        removeAfterUpload: true
    });
    innUploader.onCompleteAll = function() {
        $scope.loadDocuments();
    };
    innUploader.onErrorItem = function(item, response, status, headers) {
        if(status==500)
            bootbox.alert("Виникла помилка при завантажені документа.");
    };

    var certificateUploader = $scope.certificateUploader = new FileUploader({
        url: basePath+'/studentreg/uploadDocuments?type=3',
        removeAfterUpload: true
    });
    certificateUploader.onCompleteAll = function() {
        $scope.loadDocuments();
    };
    certificateUploader.onErrorItem = function(item, response, status, headers) {
        if(status==500)
            bootbox.alert("Виникла помилка при завантажені документа.");
    };

    documentUploader.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });
    innUploader.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });
    certificateUploader.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });
    documentUploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    innUploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    certificateUploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };

    $scope.loadDocuments=function () {
        documentsServices
            .getUserDocuments()
            .$promise
            .then(function (data) {
                $scope.userDocuments = data;
            });
    };
    $scope.loadDocuments();

    $scope.initDocument=function () {
        $scope.document = {
            type: null,
            number: null,
            issued: null,
            issued_date: null,
            registration_address: null
        };
    };
    $scope.initDocument();

    $scope.getDocumentsList=function () {
        documentsServices
            .getDocumentsTypes()
            .$promise
            .then(function (data) {
                $scope.documentsTypes = data;
            });
    };
    $scope.getDocumentsList();

    $scope.clearDocumentsFields=function (type) {
        documentsServices
            .getEditableDocument({type:type})
            .$promise
            .then(function (data) {
                if(data.id){
                    $scope.updateProperties(['type', 'number', 'issued','issued_date','registration_address'],data);
                }else{
                    $scope.initDocument();
                    $scope.document.type=type;
                }
            });
    };
    $scope.updateProperties = function(properties, data) {
        for(var i = 0; i < properties.length; i++){
            $scope.document[properties[i]] = data[properties[i]];
        }
    }

    $scope.saveDocumentsData=function () {
        if($("#issued_date").val()!=''){
            $scope.document.issued_date=$("#issued_date").val();
        }else{
            $scope.document.issued_date=null;
        }
        documentsServices
            .saveData($scope.document)
            .$promise
            .then(function (data) {
                if (data.message === 'OK') {
                    $scope.loadDocuments();
                    $scope.document.type=null;
                } else {
                    bootbox.alert('Виникла помилка:'+'<br>'+data.reason);
                }
            })
            .catch(function (error) {
                bootbox.alert('Виникла помилка:'+'<br>'+error.data.reason);
            });
    }

    $scope.removeDocument=function (id) {
        bootbox.confirm('Видалити дані документа?', function(result) {
            if(result)
                $http({
                    url: basePath + "/studentreg/removeuserdocument",
                    method: "POST",
                    data: $.param({id: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    $scope.loadDocuments();
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при видалені документу.");
                });
        });
    }
    $scope.removeDocumentsFile=function (id) {
        bootbox.confirm('Видалити файл?', function(result) {
            if(result)
                $http({
                    url: basePath + "/studentreg/removeuserdocumentsfile",
                    method: "POST",
                    data: $.param({id: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    $scope.loadDocuments();
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при видалені документу.");
                });
        });
    }

}

function registrationFormController($scope, countryCity, careerService, specializations,$timeout) {
    $scope.uiSelectInit = function(){
        $timeout(function () {
            $scope.$digest();
        });
    };
    $scope.careersListToString = function(careers){
        var careersString=[];
        if(careers){
            careers.forEach(function(item) {
                careersString.push({
                    id: item.id,
                });
            });
            $('input[name=careers]').val(JSON.stringify(careersString));
        }
    };
    $scope.specializationsListToString = function(specializations){
        var specializationsString=[];
        if(specializations){
            specializations.forEach(function(item) {
                specializationsString.push({
                    id: item.id,
                });
            });
            $('input[name=specializations]').val(JSON.stringify(specializationsString));
        }
    };
    $scope.avatarStringToField = function(myCroppedImage){
        if(myCroppedImage){
            $('input[name=avatar]').val(myCroppedImage);
        }
    };
    
    $scope.sendForm=function (form) {
        $scope.careersListToString(form.careerStart);
        $scope.specializationsListToString(form.specializations);
        $scope.avatarStringToField($scope.myCroppedImage);
    };
    $scope.dataForm=[];

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

    $scope.$watch('dataForm.selectedCountry', function() {
        if(typeof $scope.dataForm.selectedCountry!='undefined'){
            $("#StudentReg_country").val($scope.dataForm.selectedCountry.id);
            countryCity.getCitiesList($scope.dataForm.selectedCountry.id).then(function (response) {
                $scope.dataForm.citiesList=response;
            });
        }else{
            $("#StudentReg_country").val(null);
        }
    }, true);

    $scope.$watch('dataForm.selectedCity', function() {
        if(typeof $scope.dataForm.selectedCity!='undefined'){
            $("#StudentReg_city").val($scope.dataForm.selectedCity.id);
            $('input[name=cityTitle]').val($scope.dataForm.selectedCity.title);
        }else{
            $("#StudentReg_city").val(null);
            $('input[name=cityTitle]').val(null);
        }
    }, true);

    $scope.$watch('dataForm.educformOff', function() {
        if($scope.dataForm.educformOff){
            $('input[name=educformOff]').val(true);
        }else{
            $('input[name=educformOff]').val(null);
        }
    }, true);

    //crop image
    $scope.myImage='';
    $timeout(function(){
        $scope.$digest();
        $scope.myCroppedImage='';
    }, 1000);

    var handleFileSelect=function(evt) {
        var file=evt.currentTarget.files[0];
        var reader = new FileReader();
        reader.onload = function (evt) {
            $scope.$apply(function($scope){
                $scope.myImage=evt.target.result;
            });
        };
        reader.readAsDataURL(file);
    };
    angular.element(document.querySelector('#chooseAvatar')).on('change',handleFileSelect);
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

function promotionSchemesCtrl($scope, $http) {
    $scope.getPromotionSchemes=function (id, service) {
        var promise = $http({
            url: basePath+'/course/getPromotionSchemes',
            method: "POST",
            data: $.param({id: id, service: service}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };

    $scope.getPromotionSchemes(id, service).then(function (response) {
        $scope.promotions=response;
    });

    $scope.sendSchemaRequest=function(id,serviceType,schemesTemplate){
        $http({
            url: basePath+'/course/sendSchemaRequest?contentId='+id+'&serviceType='+serviceType+'&schemesTemplateId='+schemesTemplate,
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                location.reload();
            });
        }, function errorCallback() {
            bootbox.alert("Запит не вдалося надіслати.");
        });
    }
}

function updateChatName(){
    $.ajax({
        url: chatPath+'/chat/update/users/name',
        type: 'GET',
        headers: {'Content-Type': 'application/json;charset=UTF-8'},
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            console.log(response);
            bootbox.alert("Оновити ім'я в чаті не вдалося");
        },
        cache: false,
    });
}