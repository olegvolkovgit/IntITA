"use strict";

angular
  .module('teacherApp')
  .directive('companyRepresentatives', [
    '$filter',
    'NgTableParams',
    'companiesService',
    companyRepresentatives]);

function companyRepresentatives($filter, NgTableParams, companiesService) {
  function link($scope, element, attrs) {
    $scope.representativesTableParams = new NgTableParams({}, {
      getData: function (params) {
        return companiesService
          .representatives({companyId: $scope.companyId})
          .$promise
          .then(function (data) {
            params.total(data.count);
            return data.rows.map(mapForNgTable);
          });
      }
    });

    $scope.edit = function (id) {
      if (typeof $scope.editCallBack === 'function') {
        $scope.editCallBack(id)
      }
    };

    function mapForNgTable(item) {
      return {
        id: item.id,
        name: item.full_name,
        position: item.corporateEntityRepresentatives[0].position,
        order: item.corporateEntityRepresentatives[0].representative_order,
        hasCredentials: isHasCredentials(item.corporateEntityRepresentatives[0]),
        credentialsPeriod: getCredentialsPeriod(item.corporateEntityRepresentatives[0])
      }
    }

    function isHasCredentials(corporateEntityRepresentatives) {
      var
        now = new Date(),
        from = new Date(corporateEntityRepresentatives.createdAt),
        to = new Date(corporateEntityRepresentatives.deletedAt);
      return now >= from && now <= to;
    }

    function getCredentialsPeriod(corporateEntityRepresentatives) {
      var
        from = new Date(corporateEntityRepresentatives.createdAt),
        to = new Date(corporateEntityRepresentatives.deletedAt),
        dateFormat = 'dd.MM.yyyy',
        dateFormatFilter = $filter('shortDate'),
        result = 'З ' + dateFormatFilter(from, dateFormat);

      if (to.getFullYear() !== 9999) {
        result += ' по ' + dateFormatFilter(to, dateFormat);
      }

      return result;
    }

  }

  return {
    scope: {
      'companyId': '=companyId',
      'editCallBack' : '=editCallBack'
    },
    link: link,
    templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/representativesTable.html'
  }
}