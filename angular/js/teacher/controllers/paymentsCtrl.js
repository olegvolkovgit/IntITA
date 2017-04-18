angular
    .module('teacherApp')
    .controller('paymentsCtrl', paymentsCtrl);

function paymentsCtrl($scope, $stateParams, $http,  $state) {
    $scope.contentId= $stateParams.id;
    if($stateParams.scenario=='payCourse'){
        $scope.serviceType='course';
    }
    if($stateParams.scenario=='payModule'){
        $scope.serviceType='module';
    }
    $scope.setForm=$stateParams.form;
    $scope.schemeId=$stateParams.schemeId;

    $scope.createAccount=function (url, course, module, scenario, offerScenario, schema, educationForm, selectedScheme) {
        if(scenario=="Course"){
            if(typeof selectedScheme=='undefined') {
                bootbox.alert('Виберіть спочатку схему проплати');
                return false;
            }else{
                $scope.educationForm=selectedScheme.educForm;
                $scope.schemeId=selectedScheme.schemeId;
            }
        } else if(scenario=="Module"){
            $scope.educationForm=selectedScheme.educForm;
            $scope.schemeId=selectedScheme.schemeId;
        }

        if ($scope.schemeId == 0) {
            bootbox.alert("Виберіть схему проплати.");
        } else {
            if (offerScenario != "noOffer") {
                $state.go('publicOffer/course/:course/module/:module/scenario/:scenario/:form/scheme/:schemeId',
                    {course:course,module:module,scenario:scenario,form:$scope.educationForm,schemeId:$scope.schemeId}, {reload: true});
            } else {
                $scope.createAgreement(url, $scope.schemeId, course, $scope.educationForm, module, scenario);
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
            $state.go('student/agreement/:agreementId',{agreementId:response.data},{reload:true});
        }, function errorCallback() {
            bootbox.alert('Договір не вдалося створити. Спробуйте пізніше або зверніться до адміністратора');
        });
    };
}