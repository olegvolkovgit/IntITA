"use strict";

angular
    .module('teacherApp')
    .directive('companyCheckingAccounts', [
        '$filter',
        'NgTableParams',
        'companiesService',
        companyCheckingAccounts]);

function companyCheckingAccounts($filter, NgTableParams, companiesService) {
    function link($scope, element, attrs) {
        $scope.checkingAccountsTableParams = new NgTableParams({}, {
            getData: function (params) {
                return companiesService
                    .checkingAccounts({companyId: $scope.companyId})
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
                bank_name: item.bank_name,
                bank_code: item.bank_code,
                checking_account: item.checking_account,
                checking_account_order: item.checking_account_order,
                hasCredentials: isHasCredentials(item),
                credentialsPeriod: getCredentialsPeriod(item)
            }
        }

        function isHasCredentials(checkingAccounts) {
            var
                now = new Date(),
                from = new Date(checkingAccounts.createdAt),
                to = new Date(checkingAccounts.deletedAt);
            return now >= from && now <= to;
        }

        function getCredentialsPeriod(checkingAccounts) {
            var
                from = new Date(checkingAccounts.createdAt),
                to = new Date(checkingAccounts.deletedAt),
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
            'editCallBack': '=editCallBack'
        },
        link: link,
        templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/checkingAccountsTable.html'
    }
}