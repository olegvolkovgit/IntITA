/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('addressCtrl', addressCtrl)

function addressCtrl($scope, $http, $resource, NgTableParams, $state) {
    $scope.changePageHeader('Адреса (країни, міста)');

    var url=basePath+"/_teacher/_super_admin/address";

    $scope.countriesTable = new NgTableParams({},
        {
            getData: function (params) {
                return $resource(url + "/getCountriesList").get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });

    $scope.citiesTable = new NgTableParams({},
        {
            getData: function (params) {
                return $resource(url + "/getCitiesList").get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        }
    );

    $scope.editCity = function () {
        country = $jq('#country').val();
        if (country == 0) {
            bootbox.alert('Виберіть країну.');
        } else {
            id = $jq('[name="id"]').val();
            titleUa = $jq('[name="titleUa"]').val();
            titleRu = $jq('[name="titleRu"]').val();
            titleEn = $jq('[name="titleEn"]').val();

            $http({
                method: "POST",
                url: url+"/updateCity",
                data: $jq.param({
                    id: id,
                    country: country,
                    titleUa: titleUa,
                    titleRu: titleRu,
                    titleEn: titleEn
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                bootbox.alert(response.data, function () {
                    $state.go("address", {}, {reload: true});
                });
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    };

    $scope.addCity = function () {
        country = $jq('#country').val();
        if (country == 0) {
            bootbox.alert('Виберіть країну.');
        } else {
            titleUa = $jq('[name="titleUa"]').val();
            titleRu = $jq('[name="titleRu"]').val();
            titleEn = $jq('[name="titleEn"]').val();

            $http({
                method: "POST",
                url: url + "/newCity",
                data: $jq.param({
                    country: country,
                    titleUa: titleUa,
                    titleRu: titleRu,
                    titleEn: titleEn
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                bootbox.alert(response.data, function () {
                    $state.go("address", {}, {reload: true});
                });
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    }
}