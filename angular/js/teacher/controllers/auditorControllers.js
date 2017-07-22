/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('updateOfferTemplate', updateOfferTemplate)
    .controller('updateAgreementTemplate', updateAgreementTemplate)
    .controller('agreementTemplate', agreementTemplate)

function updateOfferTemplate ($scope, $http, $stateParams, $state) {
    $scope.changePageHeader('Редагувати текст оферти ('+$stateParams.lang+')');

    $scope.editOffer = function(lang){
        $http({
            method: "POST",
            url:  basePath+'/_teacher/_auditor/template/updateOffer',
            data: $jq.param({
                "lang":lang,
                "text": $jq("#offerText").val()
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).success(function(response) {
            bootbox.alert(response, function () {
                $state.go("auditor/offerTemplate", {}, {reload: true});
            })
        }).error(function(){
            bootbox.alert("Публічну оферту оновити не вдалося");
        });
    };
}

function updateAgreementTemplate ($scope, $http, $stateParams, $state, agreementsService) {
    $scope.changePageHeader('Паперовий договір');

    $scope.date = new Date();

    $scope.editorOptionsAgreement = {
        toolbar: 'agreement'
    };

    $http.get(basePath+'/angular/js/teacher/templates/accountancy/agreementExample.json').success(function(response) {
        $scope.writtenAgreement=response;
    });

    $scope.saveAgreementTemplate = function (template) {
        $http({
            method: "POST",
            url:  basePath+'/_teacher/_auditor/template/updateAgreementTemplate',
            data: $jq.param({template:template}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).success(function(response) {
            bootbox.alert('Шаблон успішно збережено');
        }).error(function(){
            bootbox.alert("Шаблон договору оновити не вдалося");
        });
    }

    agreementsService
        .getAgreementTemplate()
        .$promise
        .then(function successCallback(response) {
            $scope.agreementTemplate=response.data;
        }, function errorCallback() {
            bootbox.alert("Шаблон договору отримати не вдалося");
        });
}

function agreementTemplate ($scope, $http, $stateParams, $state, agreementsService) {
    $scope.changePageHeader('Паперовий договір');

    $scope.date = new Date();

    $http.get(basePath+'/angular/js/teacher/templates/accountancy/agreementExample.json').success(function(response) {
        $scope.writtenAgreement=response;
    });

    agreementsService
        .getAgreementTemplate()
        .$promise
        .then(function successCallback(response) {
            $scope.agreementTemplate=response.data;
        }, function errorCallback() {
            bootbox.alert("Шаблон договору отримати не вдалося");
        });
}