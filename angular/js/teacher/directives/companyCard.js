"use strict";

angular
  .module('teacherApp')
  .directive('companyCard', [
    '$q',
    'ngToast',
    'cityService',
    'companiesService',
    companyCard]);

function companyCard($q, ngToast, cityService, companiesService) {
  function link($scope, element, attrs) {
    function getCityTypeahead($viewValue) {
      return cityService.typeahead({
        query: $viewValue
      }).$promise;
    }

    function collectCompanyParams(response) {
      return {
        EDPNOU: response.EDPNOU,
        actual_address: response.actual_address,
        actual_address_city_code: response.actual_address_city_code,
        certificate_of_vat: response.certificate_of_vat,
        id: response.id,
        id_organization: response.id_organization,
        legal_address: response.legal_address,
        legal_address_city_code: response.legal_address_city_code,
        tax_certificate: response.tax_certificate,
        title: response.title,
        edpnou_issue_date: response.edpnou_issue_date=='0000-00-00 00:00:00'?'':new Date(response.edpnou_issue_date),
        certificate_of_vat_issue_date: response.certificate_of_vat_issue_date=='0000-00-00 00:00:00'?'':new Date(response.certificate_of_vat_issue_date),
        tax_certificate_issue_date: response.tax_certificate_issue_date=='0000-00-00 00:00:00'?'':new Date(response.tax_certificate_issue_date),
      }
    }

    function toast(type, message) {
      ngToast.create({
        dismissOnTimeout: true,
        dismissButton: true,
        className: type,
        content: message
      });
    }

    function dangerToast(message) {
      toast('danger', message);
    }

    function successToast(message) {
      toast('success', message);
    }

    if ($scope.companyId) {
      companiesService
        .get({id: $scope.companyId})
        .$promise
        .then(function (response) {
          $scope.company = collectCompanyParams(response);
          return $q.all([
            cityService.get({id: response.legal_address_city_code}).$promise,
            cityService.get({id: response.actual_address_city_code}).$promise
          ])
        })
        .then(function (data) {
          $scope.company.legal_address_city = data[0].title;
          $scope.company.actual_address_city = data[1].title;
        })
        .catch(dangerToast.bind(null, 'Виникла помилка.'));
    }

    $scope.company = {};
    $scope.datePopup = {};

    $scope.toggleDPPopup = function (name) {
      $scope.datePopup[name] = !$scope.datePopup[name];
    };

    $scope.save = function () {
      return companiesService
        .upsert($scope.company)
        .$promise
        .then(function (response) {
          if (response.message === 'OK') {
            if(!$scope.companyId){
                angular.copy({}, $scope.company);
                $scope.companyForm.$setPristine();
            }
            successToast('Зміни збережено');
          } else {
            dangerToast('Виникла помилка.');
          }
        })
        .catch(dangerToast.bind(null, 'Виникла помилка.'));
    };

    $scope.city = {
      legal: {
        loading: false,
        noResults: false,
        onSelect: function ($item, $model, $label, $event) {
          $scope.company.legal_address_city_code = $item.id;
        },
        getData: getCityTypeahead
      },
      actual: {
        loading: false,
        noResults: false,
        onSelect: function ($item, $model, $label, $event) {
          $scope.company.actual_address_city_code = $item.id;
        },
        getData: getCityTypeahead
      }
    }
  }

  return {
    scope: {
      'companyId': '=companyId',
    },
    link: link,
    templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/companyCard.html'
  }
}