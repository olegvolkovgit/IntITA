"use strict";

angular
  .module('teacherApp')
  .directive('companyServices', [
    '$filter',
    'NgTableParams',
    'companiesService',
    companyServices]);

function companyServices($filter, NgTableParams, companiesService) {
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

    $scope.delete = function () {
      console.log('DEADBEEF companyServices.js:30');
    };

    function mapForNgTable(item) {
      return {
        service_id: item.service_id,
        description: item.description,
        create_date: $filter('shortDate')(item.create_date, 'dd-MM-yyyy')
      }
    }
    //
    // function isHasCredentials(corporateEntityRepresentatives) {
    //   var
    //     now = new Date(),
    //     from = new Date(corporateEntityRepresentatives.createdAt),
    //     to = new Date(corporateEntityRepresentatives.deletedAt);
    //   return now >= from && now <= to;
    // }
    //
    // function getCredentialsPeriod(corporateEntityRepresentatives) {
    //   var
    //     from = new Date(corporateEntityRepresentatives.createdAt),
    //     to = new Date(corporateEntityRepresentatives.deletedAt),
    //     dateFormat = 'dd.MM.yyyy',
    //     dateFormatFilter = $filter('shortDate'),
    //     result = 'З ' + dateFormatFilter(from, dateFormat);
    //
    //   if (to.getFullYear() !== 9999) {
    //     result += ' по ' + dateFormatFilter(to, dateFormat);
    //   }
    //
    //   return result;
    // }

  }

  return {
    scope: {
      'companyId': '=companyId'
    },
    link: link,
    templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/servicesTable.html'
  }
}