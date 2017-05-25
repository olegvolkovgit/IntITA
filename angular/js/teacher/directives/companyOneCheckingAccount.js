"use strict";

angular
    .module('teacherApp')
    .directive('companyOneCheckingAccount', [
        '$state',
        'companiesService',
        'ngToast',
        companyOneCheckingAccount]);

function companyOneCheckingAccount($state, companiesService, ngToast) {
    function link($scope, element, attrs) {
        $scope.datePopup = {
            credentialsTo: false,
            credentialsFrom: false
        };
        $scope.checkingAccount = {
            'companyId': $scope.companyId,
            'checkingAccountId': $scope.checkingAccountId
        };

        $scope.toggleDPPopup = toggleDPPopup;

        if ($scope.companyId && $scope.checkingAccountId) {
            loadData();
        }

        $scope.save = function () {
            saveData($scope.checkingAccount);
        };

        $scope.revokeCredentials = function () {
            saveData({
                companyId: $scope.companyId,
                checkingAccountId: $scope.checkingAccountId,
                deletedAt: new Date()
            })
        };

        function saveData(data) {
            return companiesService
                .saveCheckingAccount(data)
                .$promise
                .then(function (response) {
                    successToast('Дані збережено');
                    if (response.id) {
                        $state.go("accountant.company.view.checkingAccounts.list", {
                            companyId: $scope.companyId,
                        });
                    } else {
                        return loadData()
                    }
                }).catch(function (error) {
                    console.error(error);
                    dangerToast('Виникла помилка')
                });
        }

        function loadData() {
            return companiesService
                .checkingAccounts({
                    companyId: $scope.checkingAccount.companyId,
                    checkingAccountId: $scope.checkingAccount.checkingAccountId
                })
                .$promise
                .then(function (data) {
                    if (data.rows.length) {
                        $scope.checkingAccount = setupModel(data.rows[0]);
                    } else {
                        dangerToast('Помилка завантаження данних');
                    }
                })
                .catch(function () {
                    dangerToast('Помилка завантаження данних');
                });

        }

        function toggleDPPopup(name) {
            $scope.datePopup[name] = !$scope.datePopup[name];
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

        function setupModel(data) {
            return {
                checkingAccountId: data.id,
                companyId: data.corporateEntity.id,
                bank_name: data.bank_name,
                bank_code: Number(data.bank_code),
                checking_account: Number(data.checking_account),
                checking_account_order: Number(data.checking_account_order),
                createdAt: new Date(data.createdAt),
                deletedAt: new Date(data.deletedAt)
            };
        }
    }

    return {
        scope: {
            'companyId': '=companyId',
            'checkingAccountId': '=checkingAccountId'
        },
        link: link,
        templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/oneCheckingAccount.html'
    }
}