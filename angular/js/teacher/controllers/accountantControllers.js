/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('agreementsCtrl', ['$scope', function ($scope) {
    }])

    .controller('agreementDetailCtrl', ['$scope', '$stateParams', function ($scope, $stateParams) {
        $scope.agreementId = $stateParams.agreementId;
    }])

    .controller('invoicesCtrl', ['$scope', 'invoicesService', 'NgTableParams', function ($scope, invoicesService, NgTableParams) {
    }])

    .controller('operationCtrl', ['$scope', 'agreementsService', 'invoicesService', '$state', function ($scope, agreements, invoices, $state) {
        $scope.$watch('providerId', function (newValue, oldValue) {
            $scope.currentProvider = $scope.typeaheadProviders[newValue];
            $scope.selected = '';
        });

        $scope.typeaheadProviders = [
            {
                name: 'номеру договору',
                searchField: 'number',
                provider: agreements,
                onSelect: function ($item, $model, $label, $event) {
                    $scope.agreementData = $item;
                    invoices.list({
                        pageCount: 0,
                        agreementId: $scope.agreementData.id
                    })
                        .$promise
                        .then(function (data) {
                            $scope.invoices = data;
                        });
                }
            },
            {
                name: 'номеру рахунку',
                searchField: 'number',
                provider: invoices,
                onSelect: function ($item, $model, $label, $event) {
                    $scope.invoiceData = $item;
                    agreements.getById({
                        id: $item.agreement_id.agreement_id
                    })
                        .$promise
                        .then(function (data) {
                            $scope.agreementData = data;
                            return invoices.list({
                                pageCount: 0,
                                agreementId: $scope.agreementData.id
                            })
                                .$promise
                                .then(function (data) {
                                    $scope.invoices = data;
                                })
                        })
                }
            },
            {
                name: 'користувачу'
            }];
        $scope.providerId = 0;
        $scope.agreementData = null;
        $scope.invoiceData = null;

        $scope.getTypeahead = function (value) {
            return $scope.currentProvider.provider
                .typeahead({
                    query: value
                })
                .$promise
                .then(function (response) {
                    return response.map(function (item) {
                        return item;
                    });
                });
        };

        $scope.createOperation = function () {
            $state.go('accountant/operation/create');
        }
    }])

    .controller('companyCtrl', function ($scope) {
        initCompanies();
    })

    .controller('representativeCtrl', function ($scope) {
        initCompanyRepresentatives();
        initRepresentatives();
    })

    .controller('operationTypeCtrl', function ($scope) {
        $jq('#operationTypes').DataTable({
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    })

    .controller('externalSourcesCtrl', function ($scope) {
        $jq('#externalSources').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    })

    .controller('cancelReasonTypeCtrl', function ($scope) {
        $jq('#cancelReasonTypes').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
