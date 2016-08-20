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

    .controller('operationCtrl', ['$scope', '$state', 'agreementsService', 'invoicesService', 'userService', function ($scope, $state, agreements, invoices, user) {
        $scope.$watch('providerId', function (newValue, oldValue) {
            $scope.currentProvider = $scope.typeaheadProviders[newValue];
            $scope.selected = '';
        });

        $scope.typeaheadProviders = [
            {
                name: 'номеру договору',
                searchField: 'number',
                provider: agreements,
                label: function (agreements) {
                    return agreements ? ((agreements.number || '')+ ' від ' + (agreements.create_date || '')) : '';
                }
            },
            {
                name: 'номеру рахунку',
                searchField: 'number',
                provider: invoices,
                label: function (invoice) {
                    return invoice ? ((invoice.number || '')+ ' від ' + (invoice.date_created || '')+ ' (договір №' + (invoice.agreement_id.number || '')+ ')') : '';
                }
            },
            {
                name: 'користувачу',
                searchField: 'email',
                provider: user,
                label: function (user) {
                    return user ? ((user.firstName || '' ) + ' ' + (user.middleName || '') + ' ' + (user.secondName || '') + ', ' + (user.email || '')) : '';
                }
            }];
        $scope.providerId = 0;

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
