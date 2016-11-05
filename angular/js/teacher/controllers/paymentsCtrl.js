angular
    .module('teacherApp')
    .controller('paymentsCtrl', paymentsCtrl);

function paymentsCtrl(paymentsService, $scope, $stateParams, $http,  $state) {
    if(typeof $stateParams.id!='undefined'){
        paymentsService
            .scheme({courseId: $stateParams.id,educationFormId:1})
            .$promise
            .then(function (data) {
                $scope.onlineSchemeData = data;
            });
        paymentsService
            .scheme({courseId: $stateParams.id,educationFormId:2})
            .$promise
            .then(function (data) {
                $scope.offlineSchemeData = data;
            });
    }
    // if($stateParams.educationForm==1){
    //     $scope.selectedSchemeOnline.scheme=$stateParams.scheme;
    // }else{
    //     $scope.selectedSchemeOffline.scheme=$stateParams.scheme;
    // }

    if($stateParams.scenario=='payCourse'){
        $scope.active=$stateParams.educationForm-1;
    }

    $scope.createAccount=function (url, course, module, scenario, offerScenario, schema, educationForm) {
        if(scenario=="Course"){
            $scope.getScheme();
        } else if(scenario=="Module"){
            $scope.educationForm=educationForm;
            $scope.schemeType=1;
        }

        if ($scope.schemeType == 0) {
            bootbox.alert("Виберіть схему проплати.");
        } else {
            if (offerScenario != "noOffer") {
                if (1 <=  $scope.schemeType <= 8) {
                    $state.go('publicOffer/course/:course/module/:module/scenario/:scenario/educationForm/:educationForm/scheme/:scheme',
                        {course:course,module:module,scenario:scenario,educationForm:$scope.educationForm,scheme:$scope.schemeType}, {reload: true});
                } else {
                    bootbox.alert("Неправильно вибрана схема проплати.");
                }
            } else {
                $scope.createAgreement(url, $scope.schemeType, course, $scope.educationForm, module, scenario);
            }
        }
    };

    $scope.createAgreement=function (url, schema, course, educationForm, module, scenario) {
        $http({
            method: 'POST',
            url: url,
            data: $jq.param({
                payment: schema,
                course: course,
                educationForm: educationForm,
                module: module,
                scenario: scenario
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            $state.go('students/agreement/:agreementId',{agreementId:response.data},{reload:true});
        }, function errorCallback() {
            bootbox.alert('Договір не вдалося створити. Спробуйте пізніше або зверніться до адміністратора');
        });
    };

    $jq('html').on('click','.paymentPlan_value',function () {
        $jq('img.icoCheck').hide();
        $jq('img.icoNoCheck').show();
        $jq(this).next('span').find('img.icoNoCheck').hide();
        $jq(this).next('span').find('img.icoCheck').show();
    });

    $scope.getScheme=function () {
        if(typeof $scope.onlineSchemeData.selectedForm=='undefined' || typeof $scope.offlineSchemeData.selectedForm=='undefined'){
            bootbox.alert('Виберіть спочатку схему проплати');
            return false;
        }else{
            $scope.educationForm=$scope.onlineSchemeData.selectedForm?1:2;
            $scope.schemeType=$scope.onlineSchemeData.selectedSchemeType?$scope.onlineSchemeData.selectedSchemeType:$scope.offlineSchemeData.selectedSchemeType;
        }
    }
}