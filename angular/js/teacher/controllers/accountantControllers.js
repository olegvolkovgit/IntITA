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

    .controller('operationCtrl', ['$scope', '$state', function ($scope, $state) {
        $scope.createOperation = function createOperation() {
            $state.go('accountant/operation/create');
        };
    }])

    .controller('createOperationCtrl', [
        '$scope',
        '$state',
        '$q',
        'agreementsService',
        'invoicesService',
        'userService',
        'operationsService',
        'externalPaymentsService',
        function ($scope, $state, $q, agreements, invoices, user, operations, externalPayments) {
            $scope.initData = function initData() {
                $scope.externalPayment = {};
                $scope.typeaheadProviders = {
                    user: {
                        name: 'користувачу',
                        searchField: 'email',
                        provider: user,
                        label: function (user) {
                            return user ? ((user.firstName || '' ) + ' ' + (user.middleName || '') + ' ' + (user.secondName || '') + ', ' + (user.email || '')) : '';
                        },
                        onSelect: function ($model) {
                            $scope.operation.userId = $model.id;
                            $scope.updateUserData({id: $scope.operation.userId});
                            $scope.updateAgreementData({user_id: $scope.operation.userId})
                                .then(function (data) {
                                    if (data && data.length) {
                                        $scope.operation.agreementId = data[0].id;
                                    }
                                });
                        }
                    },
                    agreement: {
                        name: 'номеру договору',
                        searchField: 'number',
                        provider: agreements,
                        label: function (agreements) {
                            return agreements ? ((agreements.number || '') + ' від ' + (agreements.create_date || '')) : '';
                        },
                        onSelect: function ($model) {
                            $scope.operation.agreementId = $model.id;
                            $scope.operation.userId = $model.user_id.user_id;
                            $scope.updateUserData({id: $model.user_id.user_id});
                            $scope.updateAgreementData({id: $model.id});
                            $scope.updateInvoiceData({agreement_id: $scope.operation.agreementId});

                        }
                    },
                    invoice: {
                        name: 'номеру рахунку',
                        searchField: 'number',
                        provider: invoices,
                        label: function (invoice) {
                            return invoice ? ((invoice.number || '') + ' від ' + (invoice.date_created || '') + ' сума ' + (invoice.summa || '')) : '';
                        },
                        onSelect: function ($model) {
                            $scope.operation.invoiceId = $model.id;
                            $scope.operation.agreementId = $model.agreement_id.agreement_id;
                            $scope.updateInvoiceData({id: $model.id});
                            $scope.updateAgreementData({id: $model.agreement_id.agreement_id})
                                .then(function () {
                                    $scope.operation.userId = $scope.agreementsList[0].user_id.user_id;
                                    $scope.updateUserData({id: $scope.operation.userId})
                                });
                        }
                    }
                };
                $scope.providerId = 'user';
                $scope.currentProvider = $scope.typeaheadProviders[$scope.providerId];
                $scope.operation = {
                    userId: null,
                    agreementId: null,
                    invoiceId: null,
                    invoicesId: [],
                    sum: 0,
                    addInvoice: function addInvoice(id) {
                        if ($scope.operation.invoicesId.indexOf(id) === -1) {
                            $scope.operation.invoicesId.push(id);
                        }
                    },
                    removeInvoice: function removeInvoice(id) {
                        $scope.operation.invoicesId = $scope.operation.invoicesId.filter(function (item) {
                            return item != id
                        })
                    }
                };
                $scope.usersList = [];
                $scope.agreementsList = [];
                $scope.invoicesList = [];
                $scope.selected = '';
            };

            $scope.initData();

            $scope.cleanUp = function cleanUp() {
                $scope.initData();
            };

            $scope.invoiceById = function invoiceById(id) {
                return $scope.invoicesList.filter(function (item) {
                    return item.id == id
                })[0];
            };

            $scope.$watch('providerId', function (newValue, oldValue) {
                if (newValue != oldValue) {
                    $scope.currentProvider = $scope.typeaheadProviders[newValue];
                    $scope.selected = '';
                }
            });

            $scope.$watch('operation.agreementId', function (newValue, oldValue) {
                if (newValue != oldValue) {
                    $scope.updateInvoiceData({agreement_id: newValue});
                }
            });

            $scope.$watch('operation.userId', function (newValue, oldValue) {
                if (newValue != oldValue) {
                    $scope.updateAgreementData({user_id: newValue});
                }
            });

            $scope.getTypeahead = function getTypeahead(value) {
                return $scope.currentProvider.provider
                    .typeahead({
                        query: value
                    })
                    .$promise
            };

            $scope.onSelect = function onSelect($item, $model, $label, $event) {
                $scope.currentProvider.onSelect($model);
            };

            $scope.getExternalPayment = function () {
                if (!$scope.externalPayment.id) {
                    return externalPayments
                        .create($scope.externalPayment)
                        .$promise
                        .then(function (data) {
                            if (data.status && data.status == 'error') {
                                return $q.reject(data);
                            } else {
                                return data
                            }
                        })
                } else {
                    return $q.when($scope.externalPayment);
                }
            };

            $scope.createOperation = function createOperation() {
                var sendData = {};
                for (var name in $scope.operation) {
                    if (typeof $scope.operation[name] !== 'function') {
                        sendData[name] = $scope.operation[name];
                    }
                }

                $scope.getExternalPayment()
                    .then(
                        function success(data) {
                            sendData.sourceId = data.id;
                            operations.create(null, sendData);
                        }
                    )
                    .catch(function (data) {
                        console.log(data);
                    });
            };

            $scope.updateUserData = function updateUserSelect(params) {
                var defer = $q.defer();
                user
                    .query(params)
                    .$promise
                    .then(function (data) {
                        $scope.usersList = data;
                        defer.resolve(data);
                    });

                return defer.promise;
            };

            $scope.updateAgreementData = function updateAgreementSelect(params) {
                var defer = $q.defer();
                agreements
                    .list(params)
                    .$promise
                    .then(function (data) {
                        $scope.agreementsList = data.rows;
                        defer.resolve(data.rows);
                    });

                return defer.promise;
            };

            $scope.updateInvoiceData = function updateInvoiceData(params) {
                var defer = $q.defer();

                invoices
                    .list(params)
                    .$promise
                    .then(function (data) {
                        $scope.invoicesList = data.rows;
                        defer.resolve(data.rows);
                    });

                return defer.promise;
            };

            $scope.showAgreement = function showAgreement(id) {
                if (id) {
                    $state.go('accountant/agreement/', {agreementId: id});
                }
            };

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
