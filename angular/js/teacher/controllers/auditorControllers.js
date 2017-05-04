/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('updateOfferTemplate', updateOfferTemplate)

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