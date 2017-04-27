"use strict";

angular
  .module('teacherApp')
  .directive('companyServices', [
    '$filter',
    'NgTableParams',
    'ngToast',
    'companiesService',
    companyServices]);

function companyServices($filter, NgTableParams, ngToast, companiesService) {
  function link($scope, element, attrs) {

    $scope.servicesTableParams = new NgTableParams({}, {
      getData: function (params) {
        return companiesService
          .servicesList({companyId: $scope.companyId})
          .$promise
          .then(function (data) {
            params.total(data.count);
            return data.rows.map(mapForNgTable);
          });
      }
    });

    $scope.delete = function (serviceId) {
      companiesService
        .unBindService({companyId:$scope.companyId, serviceId:serviceId})
        .$promise
        .then(function () {
          $scope.servicesTableParams.reload();
        })
        .catch(function (error) {
          dangerToast('Виникла помилка');
        })
    };

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


    function mapForNgTable(item) {
      return {
        service_id: item.service_id,
        description: item.description,
        create_date: $filter('shortDate')(item.create_date, 'dd-MM-yyyy')
      }
    }
  }

  return {
    scope: {
      'companyId': '=companyId'
    },
    link: link,
    templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/servicesTable.html'
  }
}