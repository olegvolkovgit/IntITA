angular
    .module('teacherApp')
    .controller('paymentsCtrl', paymentsCtrl);

function paymentsCtrl($scope, $stateParams, $http,  $state) {
    if($stateParams.scenario=='payCourse'){
        $scope.courseId= $stateParams.id;
        $scope.moduleId= 0;
    }
    if($stateParams.scenario=='payModule'){
        $scope.moduleId= $stateParams.id;
        $scope.courseId= 0;
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
            $scope.educationForm=educationForm==1?'online':'offline';
            //todo
            // $scope.schemeType=1;
            $scope.schemeId=1;
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
            $state.go('students/agreement/:agreementId',{agreementId:response.data},{reload:true});
        }, function errorCallback() {
            bootbox.alert('Договір не вдалося створити. Спробуйте пізніше або зверніться до адміністратора');
        });
    };
}