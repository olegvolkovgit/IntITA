/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('agreementsCtrl', ['$scope', 'agreementsService', 'paymentSchemaService', 'NgTableParams', 'lodash', 'agreementsInformation',
        function ($scope, agreements, paymentSchema, NgTableParams, _, agreementsInformation) {
            $scope.changePageHeader('Список договорів');
            $scope.currentDate = currentDate;
            $scope.agreementsTableParams = new NgTableParams({sorting: {create_date: "desc"}}, {
                getData: function (params) {
                    return agreements
                        .list(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            agreementsInformation.setInformation(data);
                            return data.rows;
                        });
                }
            });

            $scope.confirm = function (id) {
                return agreements
                    .confirm({id: id})
                    .$promise
                    .then(function (data) {
                        $scope.agreementsTableParams.reload();
                        return data;
                    });
            };

            $scope.cancel = function (id) {
                bootbox.confirm('Ви впевнені, що хочете скасувати договір?', function (result) {
                    if (result) {
                        return agreements
                            .cancel({id: id})
                            .$promise
                            .then(function (data) {
                                $scope.agreementsTableParams.reload();
                                return data;
                            });
                    }
                });
            };

            $scope.getSchemas = paymentSchema
                .query()
                .$promise
                .then(function (data) {
                    return data.map(function (item) {
                        return {id: item.pay_count, title: item.title_ua}
                    })
                });
        }])

    .controller('agreementDetailCtrl', ['$scope', '$stateParams', function ($scope, $stateParams) {
        $scope.changePageHeader('Договір та його рахунки');
        $scope.agreementId = $stateParams.agreementId;
    }])

    .controller('invoiceDetailCtrl', ['$scope', '$stateParams', function ($scope, $stateParams) {
        $scope.changePageHeader('Рахунок');
        $scope.invoiceId = $stateParams.invoiceId;
    }])

    .controller('invoicesCtrl', ['$scope', 'invoicesService', 'NgTableParams', function ($scope, invoicesService, NgTableParams) {
        $scope.changePageHeader('Рахунки');
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
        'lodash',
        'agreementsService',
        'invoicesService',
        'userService',
        'operationsService',
        'externalPaymentsService',
        'ngToast',
        function ($scope, $state, $q, _, agreements, invoices, user, operations, externalPayments, ngToast) {
            $scope.Math = window.Math;
            $scope.typeaheadProviders = {
                user: {
                    name: 'користувачу',
                    searchField: 'email',
                    provider: user,
                    label: function (user) {
                        return user ? (((user.firstName || '' ) + ' ' + (user.middleName || '') + ' ' + (user.secondName || '') + ' <' + (user.email || '')) + '>').trim() : '';
                    },
                    onSelect: function ($model) {
                        $scope.operation.userId = $model.id;
                        $scope.updateUserData({id: $scope.operation.userId});
                        $scope.updateAgreementData({'extraParams[user_id]': $scope.operation.userId})
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
                        $scope.clearOperation();
                        $scope.operation.agreementId = $model.id;
                        $scope.operation.userId = $model.user_id.user_id;
                        $scope.updateUserData({id: $model.user_id.user_id});
                        $scope.updateAgreementData({'extraParams[id]': $model.id});
                        $scope.updateInvoiceData({'extraParams[agreement_id]': $scope.operation.agreementId});

                    }
                },
                invoice: {
                    name: 'номеру рахунку',
                    searchField: 'number',
                    provider: invoices,
                    label: function (invoice) {
                        return invoice ? ((invoice.number || '') + ' від ' + (invoice.date_created || '') + ' сума ' + (invoice.summa || '') +
                        ' (погашено: ' + (invoice.paidAmount || '0') + ')') : '';
                    },
                    onSelect: function ($model) {
                        $scope.operation.invoiceId = $model.id;
                        $scope.operation.agreementId = $model.agreement_id.agreement_id;
                        $scope.updateInvoiceData({'extraParams[id]': $model.id});
                        $scope.updateAgreementData({'extraParams[id]': $model.agreement_id.agreement_id})
                            .then(function () {
                                $scope.operation.userId = $scope.agreementsList[0].user_id;
                                $scope.updateUserData({id: $scope.operation.userId})
                            });
                    }
                }
            };

            $scope.operation = {
                addInvoice: function addInvoice(id) {
                    if (id && _.find($scope.operation.invoices, ['id', id]) === undefined) {
                        $scope.operation.invoices.push(_.find($scope.invoicesList, ['id', id]));
                    }
                },
                removeInvoice: function removeInvoice(id) {
                    _.remove($scope.operation.invoices, function (item) {
                        $scope.operation.sum = $scope.operation.sum - item.amount;
                        return item.id == id
                    });
                }
            };

            $scope.initData = function initData() {
                $scope.externalPayment = {};
                $scope.providerId = 'user';
                $scope.currentProvider = $scope.typeaheadProviders[$scope.providerId];
                $scope.operation.userId = null;
                $scope.operation.agreementId = null;
                $scope.operation.invoiceId = null;
                $scope.operation.invoices = [];
                $scope.operation.sum = 0;
                $scope.usersList = [];
                $scope.agreementsList = [];
                $scope.invoicesList = [];
                $scope.selected = '';
                $scope.toastMessages = [];
            };
            $scope.initData();

            $scope.clearDocument = function clearDocument($event, $selectedIndex) {
                $scope.externalPayment = {};
            };
            $scope.clearOperation = function () {
                $scope.operation.invoiceId = null;
                $scope.operation.invoices = [];
                $scope.operation.sum = 0;
            };

            $scope.invoicesSum = function () {
                return $scope.operation.invoices.reduce(function (sum, item) {
                    var roundSum = Number(parseFloat(sum).toFixed(2));
                    $scope.operation.sum = sum = roundSum + Number(item.amount);
                    return $scope.operation.sum
                }, 0);
            };

            $scope.cleanUp = function cleanUp() {
                $scope.initData();
                angular.element(document.querySelector('#selectedPayment')).val('');
            };

            $scope.invoiceById = function invoiceById(id) {
                return $scope.invoicesList.filter(function (item) {
                    return item.id == id
                })[0];
            };

            $scope.externalPaymentsReload = function (externalPaymentId) {
                externalPayments
                    .getById({id: externalPaymentId})
                    .$promise
                    .then(function (data) {
                        data.amount = Number(data.amount);
                        $scope.externalPayment = data;
                    })
            };

            $scope.updateOperationInvoicesData = function () {
                $scope.operation.invoices.forEach(function (item, key) {
                    if (_.find($scope.operation.invoices, ['id', item.id]) && _.find($scope.invoicesList, ['id', item.id])) {
                        $scope.operation.invoices[key] = _.find($scope.invoicesList, ['id', item.id]);
                    }
                });
                $scope.operation.invoices.forEach(function (item, key) {
                    if ($scope.operation.invoices[key].paidAmount == $scope.operation.invoices[key].summa)
                        $scope.operation.removeInvoice($scope.operation.invoices[key].id);
                });
            };

            $scope.$watch('providerId', function (newValue, oldValue) {
                if (newValue != oldValue) {
                    $scope.currentProvider = $scope.typeaheadProviders[newValue];
                    $scope.selected = '';
                }
            });

            $scope.$watch('operation.agreementId', function (newValue, oldValue) {
                if (newValue != oldValue && newValue != null) {
                    $scope.clearOperation();
                    $scope.updateInvoiceData({'extraParams[agreement_id]': newValue})
                        .then(function (data) {
                            data.forEach(function (invoice) {
                                if (invoice.paidAmount != invoice.summa)
                                    $scope.operation.addInvoice(invoice.id);
                            })

                        });
                }
            });

            $scope.$watch('operation.userId', function (newValue, oldValue) {
                if (newValue != oldValue && newValue != null) {
                    $scope.clearOperation();
                    $scope.updateAgreementData({'extraParams[user_id]': newValue});
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
                                ngToast.create({
                                    dismissOnTimeout: false,
                                    dismissButton: true,
                                    className: 'success',
                                    content: 'Нове надходження коштів успішно створено'
                                });
                                $scope.formDirty = false;
                                $scope.externalPayment = {};
                                return data;
                            }
                        })
                } else {
                    return $q.when($scope.externalPayment);
                }
            };

            $scope.createOperation = function createOperation() {
                $scope.toastMessages = '';
                ngToast.dismiss();
                $scope.loaderControl.show();
                var sendData = {};
                sendData.userId = $scope.operation.userId;
                sendData.agreementId = $scope.operation.agreementId;
                sendData.invoices = $scope.operation.invoices.map(function (item) {
                    return {id: item.id, amount: item.amount}
                });

                $scope.getExternalPayment()
                    .then(
                        function success(data) {
                            if (sendData.agreementId) {
                                sendData.sourceId = data.id;
                                sendData.amount = $scope.operation.sum;
                                return operations
                                    .create(null, sendData)
                                    .$promise;
                            }
                        }
                    )
                    .then(
                        function (response) {
                            if ($scope.externalPayment.id)
                                $scope.externalPaymentsReload($scope.externalPayment.id);
                            if ($scope.operation.agreementId)
                                $scope.updateInvoiceData({'extraParams[agreement_id]': $scope.operation.agreementId})
                                    .then(
                                        function success() {
                                            $scope.updateOperationInvoicesData();
                                        }
                                    )
                            if (response) {
                                if (response.status !== 'error') {
                                    if (response.message && response.message.length) {
                                        if (_.isArray(response.message)) {
                                            response.message.forEach(function (item) {
                                                $scope.toastMessages += item + '<br>';
                                            });
                                            ngToast.create({
                                                dismissOnTimeout: false,
                                                dismissButton: true,
                                                className: 'success',
                                                content: response.message
                                            });
                                        } else {
                                            ngToast.create({
                                                dismissOnTimeout: false,
                                                dismissButton: true,
                                                className: 'success',
                                                content: 'Операція пройшла успішно'
                                            });
                                        }
                                    }
                                } else {
                                    ngToast.create({
                                        dismissOnTimeout: false,
                                        dismissButton: true,
                                        className: 'danger',
                                        content: response.message
                                    })
                                }
                            }
                            $scope.loaderControl.hide();
                        })
                    .catch(
                        function (response) {
                            if (response.message) {
                                $scope.formDirty = true;
                                response.message.forEach(function (item) {
                                    $scope.toastMessages += item + '<br>';
                                });
                                ngToast.create({
                                    dismissOnTimeout: false,
                                    dismissButton: true,
                                    className: 'danger',
                                    content: $scope.toastMessages,
                                })
                            } else {
                                ngToast.create({
                                    dismissOnTimeout: false,
                                    dismissButton: true,
                                    className: 'danger',
                                    content: "Виникла помилка"
                                })
                            }
                            $scope.loaderControl.hide();
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
                        $scope.invoicesList = data.rows.map(function (item) {
                            item.paidAmount = 0;
                            item.summa = Number(item.summa);
                            item.internalPayment.forEach(function (pays) {
                                item.paidAmount = Number(item.paidAmount) + Number(pays.summa);
                            });
                            item.amount = item.summa - item.paidAmount;
                            return item;
                        });
                        defer.resolve(data.rows);
                    });

                return defer.promise;
            };

            $scope.showAgreement = function showAgreement(id) {
                if (id) {
                    $state.go('accountant/agreement/', {agreementId: id});
                }
            };

            $scope.showInvoice = function showInvoice(id) {
                if (id) {
                    $state.go('accountant/invoice/', {invoiceId: id});
                }
            };
        }])

    .controller('companiesCtrl', function ($scope, NgTableParams, companiesService) {
        $scope.changePageHeader('Компанії');
        $scope.companiesTable = new NgTableParams({sorting: {}}, {
            getData: function (params) {
                return companiesService
                    .list(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
    })
    .controller('oneCompanyCtrl', function ($scope, $state) {
        $scope.changePageHeader($state.params.header);
        if ($state.is('accountant.company.view')) {
            $state.go('.card');
        }
        $scope.companyId = $state.params.companyId;
        $scope.representativeId = $state.params.representativeId;
    })

    .controller('representativesCtrl', function ($scope, NgTableParams, $resource) {
        $scope.changePageHeader('Представники');
        $scope.companyRepresentativesTable = new NgTableParams({
            sorting: {},
        }, {
            getData: function (params) {
                return $resource(basePath + '/_teacher/_accountant/representative/getCompanyRepresentativesList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    // return data.rows;
                    return data.data;
                });
            }
        });

        $scope.representativesTable = new NgTableParams({
            sorting: {},
        }, {
            getData: function (params) {
                return $resource(basePath + '/_teacher/_accountant/representative/getRepresentativesList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });
    })

    .controller('oneRepresentativeCtrl', function ($scope, $http, $state) {
        $scope.changePageHeader('Представник');

        $scope.$watch('newRepresentative', function () {
            if ($scope.newRepresentative)
                $jq('#typeaheadRepresentative').css('background-color', '#eee');
            else $jq('#typeaheadRepresentative').css('background-color', 'inherit');
        });

        $scope.addRepresentative = function (url) {
            var error = false;
            if ($jq('#representative').val() == 0 && !($jq('[name="full_name"]').val())) {
                bootbox.alert('Виберіть існуючого представника зі списку або додайте нового.');
                error = true;
            }
            if ($jq('#companyId').val() == 0) {
                bootbox.alert('Виберіть існуючу компанію зі списку або створіть нову');
                error = true;
            }
            if (!error) {
                $http({
                    url: url,
                    method: "POST",
                    data: $jq.param({
                        representative: $jq('#representative').val(),
                        fullName: $jq('[name="full_name"]').val(),
                        position: $jq('[name="position"]').val(),
                        company: $jq('#companyId').val(),
                        order: $jq('[name="order"]').val(),
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    bootbox.alert(response.data, function () {
                        $state.go("accountant/representative", {}, {reload: true});
                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            }
        }
    })

    .controller('operationTypeCtrl', function ($scope, $http, $resource, NgTableParams) {
        $jq('#operationTypes').DataTable({
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );

        $scope.operationTypesTable = new NgTableParams({
            sorting: {},
        }, {
            getData: function (params) {
                return $resource(basePath + '/_teacher/_accountant/operationType/loadList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });

        $scope.deleteOperationType = function (id) {
            bootbox.confirm('Ви впевнені що хочете видалити тип проплати ' + id + '?', function (result) {
                if (result) {
                    $http({
                        method: 'POST',
                        url: basePath + '/_teacher/_accountant/operationType/delete',
                        data: $jq.param({id: id}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    })
                        .success(function (data) {
                            bootbox.alert('Тип проплат видалений.', function () {
                                $scope.operationTypesTable.reload();
                            })
                        })
                        .error(function () {
                            bootbox.alert('Операцію не вдалося виконати.')
                        })
                }
            })

        }
    })

    .controller('externalSourcesTableCtrl', function ($scope, externalSourcesService, NgTableParams, $http) {
        $scope.changePageHeader('Джерела зовнішніх коштів');

        $scope.externalSourcesParams = new NgTableParams({}, {
            getData: function (params) {
                return externalSourcesService
                    .getExternalSourcesList(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });

        $scope.deleteExternalSources = function (id) {
            bootbox.confirm('Ви впевнені що хочете видалити зовнішнє джерело коштів?', function (result) {
                if (result) {
                    $http({
                        url: basePath + '/_teacher/_accountant/externalSources/delete',
                        method: "POST",
                        data: $jq.param({id: id}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).then(function successCallback(response) {
                        $scope.externalSourcesParams.reload();
                    }, function errorCallback() {
                        bootbox.alert("Операцію не вдалося виконати.");
                    });
                }
            });
        }
    })

    .controller('cancelReasonTypeCtrl', function ($http, $scope, NgTableParams, auditorService) {
        $scope.changePageHeader('Додати причину відміни проплат');

        $scope.cancelReasonTypeTableParams = new NgTableParams({}, {
            getData: function (params) {
                return auditorService
                    .cancelReasonTypeList(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });

        $scope.deleteCancelReasonTypes = function (id) {
            bootbox.confirm('Ви впевнені що хочете видалити причину відміни проплат?', function (result) {
                if (result != null) {
                    $http({
                        url: basePath + '/_teacher/_auditor/cancelReasonType/delete',
                        method: "POST",
                        data: $jq.param({id: id}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).then(function successCallback() {
                        $scope.cancelReasonTypeTableParams.reload();
                    }, function errorCallback() {
                        bootbox.alert("Операцію не вдалося виконати.");
                    });
                } else {
                    bootbox.alert("Операцію не вдалося виконати.");
                }
            });
        }
    })

    .controller('paymentsSchemaCtrl', ['$scope', '$stateParams', function ($scope, $stateParams) {
        $scope.schemeType = defineSchemaType($stateParams.schemeType);
    }])
    .controller('addPaymentsSchemaCtrl',
        [
            '$scope',
            '$stateParams',
            'ngToast',
            'userService',
            'courseService',
            'moduleService',
            'paymentSchemaService',
            function ($scope, $stateParams, ngToast, user, course, module, paymentSchema) {
                $scope.schemeType = defineSchemaType($stateParams.schemeType);

                $scope.paymentSchema = {
                    educationForm: 1
                };

                $scope.user = {
                    isSelect: $scope.schemeType === 'user',
                    typeahead: function getUserTypeahead(value) {
                        return user.typeahead({query: value}).$promise
                    },
                    label: function (user) {
                        return user ? ((user.firstName || '' ) + ' ' + (user.middleName || '') + ' ' + (user.secondName || '') + ', ' + (user.email || '')) : '';
                    },
                    onSelect: selectFromTypeahead.bind(null, $scope.paymentSchema, 'userId', 'id')
                };

                $scope.course = {
                    isSelect: $scope.schemeType === 'user' || $scope.schemeType === 'course',
                    typeahead: function getCourseTypeahead(value) {
                        return course.typeahead({query: value}).$promise
                    },
                    label: function (course) {
                        return course ? ((course.title_ua || '' ) + ', ' + (course.language || '')) : '';
                    },
                    onSelect: selectFromTypeahead.bind(null, $scope.paymentSchema, 'courseId', 'course_ID')
                };

                $scope.module = {
                    isSelect: $scope.schemeType === 'user' || $scope.schemeType === 'module',
                    typeahead: function getModuleTypeahead(value) {
                        return module.typeahead({query: value}).$promise
                    },
                    label: function (module) {
                        return module ? ((module.title_ua || '' ) + ', ' + (module.language || '')) : '';
                    },
                    onSelect: selectFromTypeahead.bind(null, $scope.paymentSchema, 'moduleId', 'module_ID')
                };

                $scope.startDateOptions = new DateOptions();
                $scope.endDateOptions = new DateOptions();

                $scope.createSchema = function () {
                    paymentSchema
                        .create($scope.paymentSchema)
                        .$promise
                        .then(function (data) {
                            if (data.message === 'OK') {
                                ngToast.create({
                                    content: 'Схема створена успішно'
                                })
                            } else {
                                ngToast.create({
                                    className: 'danger',
                                    content: "Під час створення схеми виникла помилка."
                                })
                            }
                        });
                }
            }
        ]
    )

    .controller('externalSourceCtrl', function ($scope, $http, $stateParams, externalSourcesService) {
        $scope.loadExternalSourceData = function (id) {
            externalSourcesService.externalSource({'id': id}).$promise
                .then(function successCallback(response) {
                    $scope.source = response;
                    $scope.source.cash = Number($scope.source.cash);
                }, function errorCallback() {
                    bootbox.alert("Отримати дані джерела коштів не вдалося");
                });
        };

        if ($stateParams.id) {
            $scope.modelId = $stateParams.id;
            $scope.loadExternalSourceData($scope.modelId);
        }
        $scope.sendExternalSourceForm = function (scenario, name, cash, modelId) {
            if (scenario == 'create') $scope.createExternalSource(name, cash);
            else if (scenario == 'update') $scope.updateExternalSource(modelId, name, cash);
        };

        $scope.clearForm = function () {
            $scope.source.name = null;
            $scope.externalSourceForm.name.$setPristine();
        };

        $scope.createExternalSource = function (name, cash) {
            $http({
                url: basePath + '/_teacher/_accountant/externalSources/createExternalSource',
                method: "POST",
                data: $jq.param({
                    name: name,
                    cash: cash
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                $scope.addUIHandlers(response.data);
                $scope.clearForm();
            }, function errorCallback() {
                bootbox.alert("Створити зовнішнє джерело не вдалося. Помилка сервера.");
            });
        };

        $scope.updateExternalSource = function (id, name, cash) {
            $http({
                url: basePath + '/_teacher/_accountant/externalSources/updateExternalSource',
                method: "POST",
                data: $jq.param({
                    id: id,
                    name: name,
                    cash: cash
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                $scope.addUIHandlers(response.data);
            }, function errorCallback() {
                bootbox.alert("Оновити зовнішнє джерело не вдалося. Помилка сервера.");
            });
        };
    })

    .controller('datePickerCtrl', function ($scope) {
        $scope.startDateOptions = new ExternalPaymentDateOptions();
    })

    .controller('paymentsSchemaTemplateTableCtrl', ['$scope', '$stateParams', 'NgTableParams', 'paymentSchemaService', '$http', '$attrs',
        function ($scope, $stateParams, NgTableParams, paymentSchemaService, $http, $attrs) {
            $scope.changePageHeader('Шаблони схем');

            $scope.schemesTemplateTableParams = new NgTableParams({organization: $attrs.organization}, {
                getData: function (params) {
                    return paymentSchemaService
                        .schemesTemplatesList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });
        }])

    .controller('paymentsSchemesTableCtrl', ['$scope', 'NgTableParams', 'paymentSchemaService', '$http', '$attrs',
        function ($scope, NgTableParams, paymentSchemaService, $http, $attrs) {
            $scope.changePageHeader('Список застосованих шаблонів');

            $scope.mainTemplateTableParams = new NgTableParams({}, {
                getData: function (params) {
                    return paymentSchemaService
                        .mainAppliedTemplatesList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });
            $scope.servicesTemplateTableParams = new NgTableParams({organization: $attrs.organization}, {
                getData: function (params) {
                    return paymentSchemaService
                        .servicesAppliedTemplatesList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });
            $scope.usersTemplateTableParams = new NgTableParams({
                sorting: {id: "desc"},
                organization: $attrs.organization
            }, {
                getData: function (params) {
                    return paymentSchemaService
                        .usersAppliedTemplatesList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });

            $scope.cancelPaymentScheme = function (id) {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/cancelPaymentScheme',
                    method: "POST",
                    data: $jq.param({
                        id: id,
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    $scope.servicesTemplateTableParams.reload();
                    $scope.usersTemplateTableParams.reload();
                }, function errorCallback() {
                    bootbox.alert("Скасувати не вдалося");
                });
            }
        }])

    .controller('paymentsSchemaTemplateCtrl', ['$scope', 'lodash', '$http', '$state', '$stateParams', function ($scope, _, $http, $state, $stateParams) {
        $scope.changePageHeader('Створення та редагування шаблонів схем');
        $scope.loadSchemesTemplate = function (templateId) {
            $http({
                url: basePath + '/_teacher/_accountant/paymentSchema/getSchemesTemplate',
                method: "POST",
                data: $jq.param({
                    templateId: templateId,
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                $scope.schemes = response.data.schemes;
                $scope.schemes.forEach(function (item) {
                    item.discount = Number(item.discount);
                    item.loan = Number(item.loan);
                    item.pay_count = Number(item.pay_count);
                    item.contract = Boolean(item.contract);
                });
                $scope.template = {
                    id: response.data.id,
                    name_ua: response.data.template_name_ua,
                    name_ru: response.data.template_name_ru,
                    name_en: response.data.template_name_en,
                    description_ua: response.data.description_ua,
                    description_ru: response.data.description_ru,
                    description_en: response.data.description_en,
                    schemes: $scope.schemes,
                };
            }, function errorCallback() {
                bootbox.alert("Отримати дані шаблона схем не вдалося");
            });
        };

        if ($stateParams.id) {
            $scope.loadSchemesTemplate($stateParams.id);
        }

        $scope.schemes = [
            {pay_count: 1, discount: 30, loan: 0, name: 'Проплата наперед', contract: false},
            {pay_count: 2, discount: 10, loan: 0, name: '2 проплати', contract: false},
            {pay_count: 4, discount: 8, loan: 0, name: '4 проплати', contract: false},
            {pay_count: 12, discount: 0, loan: 0, name: 'помісячно', contract: false},
            {pay_count: 24, discount: 0, loan: 24, name: '24 проплати', contract: true},
            {pay_count: 36, discount: 0, loan: 24, name: '36 проплат', contract: true},
            {pay_count: 48, discount: 0, loan: 24, name: '48 проплат', contract: true},
            {pay_count: 60, discount: 0, loan: 24, name: '60 проплат', contract: true},
        ];

        $scope.template = {
            name: '',
            schemes: $scope.schemes,
        }

        $scope.payCount = [
            {value: 1, name: 'Проплата наперед'},
            {value: 2, name: '2 проплати'},
            {value: 3, name: '3 проплати'},
            {value: 4, name: '4 проплати'},
            {value: 6, name: '6 проплат'},
            {value: 12, name: 'помісячно'},
            {value: 24, name: '24 проплати'},
            {value: 36, name: '36 проплат'},
            {value: 48, name: '48 проплат'},
            {value: 60, name: '60 проплат'},
        ]

        $scope.updateScheme = function (payCount, index) {
            $scope.schemes[index]['name'] = _.find($scope.payCount, ['value', payCount]).name;
            if (payCount > 12) {
                $scope.schemes[index]['discount'] = 0;
            } else {
                $scope.schemes[index]['loan'] = 0;
            }
        };

        $scope.operation = {
            addScheme: function addScheme() {
                $scope.schemes.push({pay_count: 1, discount: 0, loan: 0, name: 'Проплата наперед'});
            },
            removeScheme: function removeScheme(index) {
                _($scope.schemes)
                    .splice(index, 1)
                    .value();
            }
        };

        $scope.createTemplate = function (template) {
            var check = true;
            var msgError = '';
            if (_.filter(template.schemes, ['pay_count', 1]).length == 0) {
                msgError = 'Шаблон схем обов\'язково має містити схему "проплата наперід"';
                check = false;
            }
            template.schemes.forEach(function (item) {
                if (_.filter(template.schemes, ['pay_count', item.pay_count]).length > 1) {
                    msgError = 'Шаблон схем не може містити схеми з однаковою кількість проплат';
                    check = false;
                    return false;
                }
            });
            if (check) {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/createSchemeTemplate',
                    method: "POST",
                    data: $jq.param({
                        template: JSON.stringify(template),
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    bootbox.alert(response.data, function () {
                        $state.go("accountant/paymentSchemas/schemas/template", {}, {reload: true});
                    });
                }, function errorCallback() {
                    bootbox.alert("Створити шаблон схем не вдалося. Помилка сервера.");
                });
            } else {
                bootbox.alert(msgError);
            }
        };

        $scope.updateTemplate = function (template) {
            var check = true;
            var msgError = '';
            if (_.filter(template.schemes, ['pay_count', 1]).length == 0) {
                msgError = 'Шаблон схем обов\'язково має містити схему "проплата наперід"';
                check = false;
            }
            template.schemes.forEach(function (item) {
                if (_.filter(template.schemes, ['pay_count', item.pay_count]).length > 1) {
                    msgError = 'Шаблон схем не може містити схеми з однаковою кількість проплат';
                    check = false;
                    return false;
                }
            });
            if (check) {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/updateSchemeTemplate',
                    method: "POST",
                    data: $jq.param({
                        template: JSON.stringify(template),
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    bootbox.alert(response.data, function () {
                        $state.reload();
                    });
                }, function errorCallback() {
                    bootbox.alert("Оновити шаблон схем не вдалося. Помилка сервера.");
                });
            } else {
                bootbox.alert(msgError);
            }
        };
    }])

    .controller('paymentsSchemaTemplateApplyCtrl', ['$scope', 'lodash', '$http', '$state', '$stateParams', 'paymentSchemaService', '$q', '$rootScope',
        function ($scope, _, $http, $state, $stateParams, paymentSchemaService, $q, $rootScope) {

            if ($stateParams.id) {
                $scope.changePageHeader('Редагування застосованого шаблону схем');
            } else {
                $scope.changePageHeader('Застосування шаблону схем');
            }

            $scope.paymentSchema = {};
            $scope.today = function () {
                var nowDate = new Date();
                nowDate.setHours(0, 0, 0, 0);
                $scope.paymentSchema.startDate = nowDate;
            };
            $scope.today();

            $scope.loadService = function (id) {
                if (id) {
                    var promise = $http({
                        url: basePath + '/_teacher/_accountant/paymentSchema/getServiceContent',
                        method: "POST",
                        data: $jq.param({
                            serviceId: id,
                        }),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).then(function successCallback(response) {
                        return response.data;
                    }, function errorCallback() {
                        bootbox.alert("Вибачте, виникла помилка при завантажені сервісу.");
                    });
                    return promise;
                }
            };
            $scope.loadUserName = function (id) {
                if (id) {
                    var promise = $http({
                        url: basePath + '/_teacher/user/loadUserName',
                        method: "POST",
                        data: $jq.param({
                            userId: id,
                        }),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).then(function successCallback(response) {
                        return response.data;
                    }, function errorCallback() {
                        bootbox.alert("Вибачте, виникла помилка при завантажені ім'я користувача.");
                    });
                    return promise;
                }
            };
            $scope.loadTemplates = function () {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/getSchemesTemplatesList?organization=1',
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $scope.templates = response.data;
                    if ($stateParams.request) {
                        paymentSchemaService.getSchemesRequest({id_message: $stateParams.request}).$promise.then(function (response) {
                            $q.all([$scope.loadUserName(response.id_user), $scope.loadService(response.id_service)]).then(function (results) {
                                $scope.userSelected = results[0];
                                $scope.paymentSchema = {
                                    userId: response.id_user,
                                    courseId: results[1]['courseId'],
                                    moduleId: results[1]['moduleId'],
                                    template: _.find($scope.templates, ['id', response.id_schema_template]),
                                    serviceType: 1,
                                    request: $stateParams.request,
                                }
                                if ($scope.paymentSchema.courseId) {
                                    $http.get(basePath + "/course/getCourseTitle/?id=" + $scope.paymentSchema.courseId).then(function (response) {
                                        $scope.selectedCourse = response.data;
                                    });
                                }
                                if ($scope.paymentSchema.moduleId) {
                                    $http.get(basePath + "/module/getModuleTitle/?id=" + $scope.paymentSchema.moduleId).then(function (response) {
                                        $scope.selectedModule = response.data;
                                    });
                                }
                            });
                        });
                    }
                    // else if($stateParams.id){
                    //     $scope.loadAppliedTemplateData($stateParams.id);
                    // }
                }, function errorCallback() {
                    bootbox.alert("Отримати шаблони схем не вдалося");
                });
            };
            $scope.loadTemplates();

            $scope.startDateOptions = new DateOptions();
            $scope.endDateOptions = new DateOptions();

            $scope.onSelectCourse = function ($item) {
                $scope.paymentSchema['courseId'] = $item.id;
            };
            $scope.reloadCourse = function () {
                $scope.paymentSchema['courseId'] = null;
            };
            $scope.onSelectModule = function ($item) {
                $scope.paymentSchema['moduleId'] = $item.id;
            };
            $scope.reloadModule = function () {
                $scope.paymentSchema['moduleId'] = null;
            };
            $scope.onSelectUser = function ($item) {
                $scope.paymentSchema['userId'] = $item.id;
            };
            $scope.reloadUser = function () {
                $scope.paymentSchema['userId'] = null;
            };

            //load service title
            $scope.loadModuleTitle = function (moduleId) {
                $http.get(basePath + "/module/getModuleTitle/?id=" + moduleId).then(function (response) {
                    $scope.selectedModule = response.data;
                });
            };
            $scope.loadCourseTitle = function (courseId) {
                $http.get(basePath + "/course/getCourseTitle/?id=" + courseId).then(function (response) {
                    $scope.selectedCourse = response.data;
                });
            };

            $scope.loadAppliedTemplateData = function (id) {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/getPaymentSchemeData',
                    method: "POST",
                    data: $jq.param({id: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $q.all([$scope.loadUserName(response.data.userId), $scope.loadService(response.data.serviceId)]).then(function (results) {
                        $scope.userSelected = results[0];
                        $scope.paymentSchema = {
                            id: response.data.id,
                            userId: response.data.userId,
                            courseId: results[1]['courseId'],
                            moduleId: results[1]['moduleId'],
                            serviceType: Number(response.data.serviceType ? response.data.serviceType : 1),
                            template: _.find($scope.templates, ['id', response.data.id_template]),
                            startDate: response.data.startDate ? new Date(response.data.startDate) : null,
                            endDate: response.data.endDate ? new Date(response.data.endDate) : null,
                        };
                        if ($scope.paymentSchema.courseId) {
                            $scope.loadCourseTitle($scope.paymentSchema.courseId);
                        }
                        if ($scope.paymentSchema.moduleId) {
                            $scope.loadModuleTitle($scope.paymentSchema.moduleId);
                        }
                    });
                }, function errorCallback() {
                    bootbox.alert("Отримати дані акційної схеми не вдалося");
                });
            };

            $scope.sendFormApplyTemplate = function (scenario) {
                if (scenario == 'create') $scope.applyTemplate();
                else $scope.updateAppliedTemplate();
            };

            $scope.applyTemplate = function () {
                paymentSchemaService
                    .applyTemplate($scope.paymentSchema)
                    .$promise
                    .then(function (data) {
                        if (data.message === 'OK') {
                            bootbox.alert('Шаблон схем успішно застосовано', function () {
                                if ($stateParams.request) {
                                    paymentSchemaService.getActualSchemesRequests().$promise.then(function (response) {
                                        $rootScope.countOfActualSchemesRequests = response[0];
                                        $state.go("accountant/schemesrequests", {}, {reload: true});
                                    });
                                } else {
                                    $state.reload();
                                }
                            });
                        } else {
                            bootbox.alert(data.reason);
                        }
                    })
                    .catch(function (error) {
                        bootbox.alert(error.data.reason);
                    });
            };

            $scope.updateAppliedTemplate = function () {
                // paymentSchemaService
                //     .updateAppliedTemplate($scope.paymentSchema)
                //     .$promise
                //     .then(function (data) {
                //         if (data.message === 'OK') {
                //             bootbox.alert('Шаблон схем успішно оновлено', function () {
                //                 $state.reload();
                //             });
                //         } else {
                //             bootbox.alert(data.reason);
                //         }
                //     });
            };

            $scope.services = [
                {
                    name: 'Курси',
                    value: 1
                },
                {
                    name: 'Модулі',
                    value: 2
                }
            ];
        }])
    .controller('documentsCtrl', ['$scope', '$stateParams', 'NgTableParams', 'accountantService', '$http', '$attrs',
        function ($scope, $stateParams, NgTableParams, accountantService, $http, $attrs) {
            $scope.changePageHeader('Копії документів');

            $scope.docStatus = [{id: 0, title: 'не перевірені'}, {id: 1, title: 'перевірені'}];
            $scope.documentsTableParams = new NgTableParams({organization: $attrs.organization}, {
                getData: function (params) {
                    return accountantService
                        .documentsList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });

            $scope.createDocumentsFolder = function () {
                $http({
                    method: 'POST',
                    url: basePath + '/_teacher/_accountant/accountant/createDocumentsFolder',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    bootbox.alert("Папку створено");
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }

            $scope.getDocument = function (documentID) {
                bootbox.alert({
                    message: "<img width='100%' src='" + basePath + '/_teacher/_accountant/accountant/getDocument?id=' + documentID + "'>",
                    size: 'large'
                })

            }

        }])
    .controller('promotionPaymentsSchemesTableCtrl', ['$scope', 'NgTableParams', 'paymentSchemaService', '$http', '$attrs',
        function ($scope, NgTableParams, paymentSchemaService, $http, $attrs) {
            $scope.changePageHeader('Список акцій застосованих до сервісів');

            $scope.promotionPaymentsSchemaTableParams = new NgTableParams({organization: $attrs.organization}, {
                getData: function (params) {
                    return paymentSchemaService
                        .promotionPaymentsSchemaList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });

            $scope.cancelPromotionPaymentScheme = function (id) {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/cancelPromotionPaymentScheme',
                    method: "POST",
                    data: $jq.param({
                        id: id,
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    $scope.promotionPaymentsSchemaTableParams.reload();
                }, function errorCallback() {
                    bootbox.alert("Скасувати не вдалося");
                });
            }
        }])
    .controller('displayPromotionSchemesCtrl', ['$scope', 'lodash', '$http', '$state', '$stateParams', 'paymentSchemaService', '$filter',
        function ($scope, _, $http, $state, $stateParams, paymentSchemaService, $filter) {
            $scope.paymentSchema = {};
            $scope.today = function () {
                var nowDate = new Date();
                nowDate.setHours(0, 0, 0, 0);
                $scope.paymentSchema.showDate = nowDate;
                $scope.paymentSchema.startDate = nowDate;
            };
            $scope.today();

            $scope.loadPromotionData = function (id) {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/getPromotionSchemeData',
                    method: "POST",
                    data: $jq.param({id: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $scope.paymentSchema = {
                        id: response.data.id,
                        courseId: response.data.courseId,
                        moduleId: response.data.moduleId,
                        template: _.find($scope.templates, ['id', response.data.id_template]),
                        serviceType: Number(response.data.serviceType ? response.data.serviceType : 1),
                        showDate: response.data.showDate ? new Date(response.data.showDate) : null,
                        startDate: response.data.startDate ? new Date(response.data.startDate) : null,
                        endDate: response.data.endDate ? new Date(response.data.endDate) : null,
                    }
                    if (response.data.courseId) {
                        $scope.loadCourseTitle(response.data.courseId);
                    }
                    if (response.data.moduleId) {
                        $scope.loadModuleTitle(response.data.moduleId);
                    }
                }, function errorCallback() {
                    bootbox.alert("Отримати дані акційної схеми не вдалося");
                });
            };

            if ($stateParams.id) {
                $scope.changePageHeader('Редагування акційної схеми');
            } else {
                $scope.changePageHeader('Відображення акційних схем для сервісів');
            }

            $scope.loadTemplates = function () {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/getSchemesTemplatesList?organization=1',
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $scope.templates = response.data;
                    if ($stateParams.id) {
                        $scope.loadPromotionData($stateParams.id);
                    }
                }, function errorCallback() {
                    bootbox.alert("Отримати шаблони схем не вдалося");
                });
            };
            $scope.loadTemplates();

            $scope.sendFormPromotion = function (scenario) {
                if (scenario == 'create') $scope.applyPromotionTemplate();
                else $scope.updatePromotionTemplate();
            };

            $scope.startShowOptions = new DateOptions();
            $scope.startDateOptions = new DateOptions();
            $scope.endDateOptions = new DateOptions();

            $scope.onSelectCourse = function ($item) {
                $scope.paymentSchema['courseId'] = $item.id;
            };
            $scope.reloadCourse = function () {
                $scope.paymentSchema['courseId'] = null;
            };
            $scope.onSelectModule = function ($item) {
                $scope.paymentSchema['moduleId'] = $item.id;
            };
            $scope.reloadModule = function () {
                $scope.paymentSchema['moduleId'] = null;
            };
            //load service title
            $scope.loadModuleTitle = function (moduleId) {
                $http.get(basePath + "/module/getModuleTitle/?id=" + moduleId).then(function (response) {
                    $scope.selectedModule = response.data;
                });
            };
            $scope.loadCourseTitle = function (courseId) {
                $http.get(basePath + "/course/getCourseTitle/?id=" + courseId).then(function (response) {
                    $scope.selectedCourse = response.data;
                });
            };

            $scope.applyPromotionTemplate = function () {
                paymentSchemaService
                    .applyPromotionTemplate($scope.paymentSchema)
                    .$promise
                    .then(function (data) {
                        if (data.message === 'OK') {
                            bootbox.alert('Акційний шаблон схем успішно застосовано', function () {
                                $state.reload();
                            });
                        } else {
                            bootbox.alert(data.reason);
                        }
                    });
            }

            $scope.updatePromotionTemplate = function () {
                paymentSchemaService
                    .updatePromotionTemplate($scope.paymentSchema)
                    .$promise
                    .then(function (data) {
                        if (data.message === 'OK') {
                            bootbox.alert('Акційний шаблон схем успішно оновлено', function () {
                                $state.reload();
                            });
                        } else {
                            bootbox.alert(data.reason);
                        }
                    });
            }

            $scope.services = [
                {
                    name: 'Курси',
                    value: 1
                },
                {
                    name: 'Модулі',
                    value: 2
                }
            ];
        }])
    .controller('schemesRequestsTableCtrl', ['$scope', '$stateParams', 'NgTableParams', 'paymentSchemaService', '$http', '$rootScope',
        function ($scope, $stateParams, NgTableParams, paymentSchemaService, $http, $rootScope) {
            $scope.changePageHeader('Запити на застосування схем проплат');

            $scope.status = [
                {id: '0', title: 'нові'},
                {id: '1', title: 'в процесі'},
                {id: '2', title: 'затвердженні'},
                {id: '3', title: 'відхилені'},
                {id: '4', title: 'нові та в процесі'}
            ];

            $scope.schemesRequestsTableParams = new NgTableParams({filter: {'status': '4'}}, {
                getData: function (params) {
                    return paymentSchemaService
                        .schemesRequestsList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });

            $scope.setRequestStatus = function (idMessage, status) {
                $http({
                    url: basePath + '/_teacher/_accountant/paymentSchema/setRequestStatus',
                    method: "POST",
                    data: $jq.param({idMessage: idMessage, status: status}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    paymentSchemaService.getActualSchemesRequests().$promise.then(function (response) {
                        $rootScope.countOfActualSchemesRequests = response[0];
                        $scope.schemesRequestsTableParams.reload();
                    });
                }, function errorCallback() {
                    bootbox.alert("Змінити статус не вдалося");
                });
            };
            $scope.rejectRequest = function (idMessage) {
                bootbox.dialog({
                        title: "Ти впевнений, що хочеш відхилити запит?",
                        message: '<div class="panel-body"><div class="row"><form role="form" name="rejectMessage"><div class="form-group col-md-12">' +
                        '<textarea class="form-control" style="resize: none" rows="6" id="rejectMessageText" ' +
                        'placeholder="тут можна залишити коментар, причина відхилення запиту на застосування схеми проплат, яка надійде користувачу на його email"></textarea>' +
                        '</div></form></div></div>',
                        buttons: {
                            success: {
                                label: "Підтвердити", className: "btn btn-primary",
                                callback: function () {
                                    var comment = $jq('#rejectMessageText').val();
                                    paymentSchemaService.rejectSchemesRequest({
                                        id_message: idMessage,
                                        reject_comment: comment
                                    }).$promise.then(function () {
                                        $scope.schemesRequestsTableParams.reload();
                                    });
                                    paymentSchemaService.getActualSchemesRequests().$promise.then(function (response) {
                                        $rootScope.countOfActualSchemesRequests = response[0];
                                    });
                                }
                            },
                            cancel: {
                                label: "Скасувати", className: "btn btn-default",
                                callback: function () {
                                }
                            }
                        }
                    }
                );
            };
            $scope.setComment = function (idMessage, oldComment) {
                if (typeof oldComment == 'undefined') oldComment = '';
                bootbox.dialog({
                        title: "Коментар до запиту",
                        message: '<div class="panel-body"><div class="row"><form role="form" name="commentMessage"><div class="form-group col-md-12">' +
                        '<textarea class="form-control" style="resize: none" rows="6" id="commentMessageText" ' +
                        'placeholder="тут можна залишити коментар до запиту, котрий бачить лише бухгалтер">' + oldComment + '</textarea>' +
                        '</div></form></div></div>',
                        buttons: {
                            success: {
                                label: "Підтвердити", className: "btn btn-primary",
                                callback: function () {
                                    var comment = $jq('#commentMessageText').val();
                                    paymentSchemaService.setRequestComment({
                                        id_message: idMessage,
                                        comment: comment
                                    }).$promise.then(function () {
                                        $scope.schemesRequestsTableParams.reload();
                                    });
                                }
                            },
                            cancel: {
                                label: "Скасувати", className: "btn btn-default",
                                callback: function () {
                                }
                            }
                        }
                    }
                );
            };
        }])

    .controller('userAgreementsCtrl', ['$scope', 'agreementsService', 'NgTableParams', 'lodash', '$stateParams', 'paymentSchemaService', 'agreementsInformation',
        function ($scope, agreements, NgTableParams, _, $stateParams, paymentSchema, agreementsInformation) {
            $scope.changePageHeader('Договори студента');
            $scope.currentDate = currentDate;
            $scope.userAgreementsTableParams = new NgTableParams({
                user: $stateParams.studentId,
                sorting: {create_date: "desc"}
            }, {
                getData: function (params) {
                    return agreements
                        .userAgreements(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            agreementsInformation.setInformation(data);
                            return data.rows;
                        });
                }
            });

            $scope.getSchemas = paymentSchema
                .query()
                .$promise
                .then(function (data) {
                    return data.map(function (item) {
                        return {id: item.pay_count, title: item.title_ua}
                    })
                });
        }])
    .controller('trainerUsersAgreementsCtrl', ['$scope', 'agreementsService', 'NgTableParams', 'lodash', '$stateParams', 'paymentSchemaService', 'agreementsInformation',
        function ($scope, agreements, NgTableParams, _, $stateParams, paymentSchema, agreementsInformation) {
            $scope.changePageHeader('Договори студентів закріплених за тренером');
            $scope.currentDate = currentDate;
            $scope.trainerUsersAgreementsTableParams = new NgTableParams({
                user: $stateParams.studentId,
                sorting: {create_date: "desc"}
            }, {
                getData: function (params) {
                    return agreements
                        .trainerUsersAgreements(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            agreementsInformation.setInformation(data);
                            return data.rows;
                        });
                }
            });

            $scope.getSchemas = paymentSchema
                .query()
                .$promise
                .then(function (data) {
                    return data.map(function (item) {
                        return {id: item.pay_count, title: item.title_ua}
                    })
                });
        }])
    .controller('agreementsRequestsTableCtrl', ['$scope', '$stateParams', 'NgTableParams', 'agreementsService', '$http', '$rootScope',
        function ($scope, $stateParams, NgTableParams, agreementsService, $http, $rootScope) {
            $scope.changePageHeader('Запити на затвердження паперових договорів');

            $scope.status = [
                {id: 'null', title: 'нові'},
                {id: '1', title: 'затвердженні'},
                {id: '0', title: 'відхилені'},
            ];

            $scope.agreementsRequestsTableParams = new NgTableParams({filter: {'status': 'null'}}, {
                getData: function (params) {
                    return agreementsService
                        .agreementsRequestsList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });
        }])

    .controller('writtenAgreementsTableCtrl', ['$scope', '$stateParams', 'NgTableParams', 'agreementsService', '$http', '$rootScope',
        function ($scope, $stateParams, NgTableParams, agreementsService, $http, $rootScope) {
            $scope.changePageHeader('Паперові договора');

            $scope.status = [
                {id: '1', title: 'затвердженні і згенеровані'},
                {id: '2', title: 'очікують затвердження користувача'},
                {id: '3', title: 'затверджені користувачем, але не згенеровані'},
            ];

            $scope.writtenAgreementsTableParams = new NgTableParams({filter: {'status': '3'},
                sorting: {
                    updatedAt: 'desc'
                },}, {
                getData: function (params) {
                    return agreementsService
                        .writtenAreementsList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });
        }])

    .controller('writtenAgreementsAppliedTableCtrl', ['$scope', '$stateParams', 'NgTableParams', 'agreementsService', '$http', '$rootScope',
        function ($scope, $stateParams, NgTableParams, agreementsService, $http, $rootScope) {
            $scope.changePageHeader('Застосовані паперові договора до сервісів');

            $scope.writtenAgreementsAppliedTableParams = new NgTableParams({}, {
                getData: function (params) {
                    return agreementsService
                        .writtenAreementsAppliedList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });

            $scope.cancelAppliedAgreement = function (id) {
                bootbox.confirm('Ти впевнений, що хочеш скасувати шаблон?', function (result) {
                    if (result) {
                        agreementsService.cancelAppliedAgreement({service_id: id}).$promise
                            .then(function (data) {
                                $scope.writtenAgreementsAppliedTableParams.reload();
                            });
                    }
                });
            };

            $scope.loadTemplates = function () {
                $http({
                    url: basePath + '/_teacher/_accountant/template/GetTemplatesList',
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $scope.templates = response.data;
                }, function errorCallback() {
                    bootbox.alert("Отримати шаблони схем не вдалося");
                });
            };
            $scope.loadTemplates();

            $scope.formData = {};
            $scope.clearInputs=function () {
                $scope.formData.service_id=null;
                $scope.serviceSelected=null;
            };

            $scope.onSelectService = function ($item) {
                $scope.formData.service_id = $item.id;
            };

            $scope.reloadService = function(){
                $scope.formData.service_id=null;
            };

            $scope.setWrittenAgreementTemplateForService = function(data){
                if (data.written_agreement_template_id && data.service_id){
                    agreementsService
                        .applyWrittenAgreementForService(data)
                        .$promise
                        .then(function successCallback(response) {
                            $scope.writtenAgreementsAppliedTableParams.reload();
                            $scope.clearInputs();
                        }, function errorCallback(response) {
                            console.log(response);
                            bootbox.alert("Операцію не вдалося виконати");
                        });
                }else{
                    bootbox.alert("Користувача або модуль не вибрано");
                }
            }
        }])

    .controller('writtenAgreementViewCtrl', ['$scope', 'agreementsService', '$stateParams','$state',
        function ($scope, agreementsService, $stateParams, $state) {
            $scope.date = new Date();
            $scope.options={};

            $scope.editorOptionsAgreement = {
                toolbar: 'agreement',
                height: '1000'
            };

            $scope.getAgreementTemplate = function(id){
                agreementsService
                    .getAgreementTemplate({agreementId: id, id: $scope.options.selectedTemplate})
                    .$promise
                    .then(function successCallback(response) {
                        $scope.options.selectedTemplate= response.data.id;
                        $scope.agreementTemplate = response.data.template;
                    }, function errorCallback() {
                        bootbox.alert("Шаблон договору отримати не вдалося");
                    });
            }

            $scope.getAgreementRequestStatus = function (request) {
                agreementsService
                    .getAgreementRequestStatus({'idMessage': request})
                    .$promise
                    .then(function (data) {
                        $scope.agreementRequestStatus = data.status;
                    });
            };
            if($stateParams.request){
                $scope.getAgreementRequestStatus($stateParams.request);
            }


            $scope.writtenAgreementPreview = function (agreementId) {
                agreementsService
                    .getWrittenAgreementData({'id': agreementId})
                    .$promise
                    .then(function (data) {
                        $scope.getAgreementTemplate(agreementId);
                        $scope.writtenAgreement = data;
                        if($stateParams.request){
                         $scope.getAgreementRequestStatus($stateParams.request);
                        }
                    });
            };

            $scope.checkAgreementPdf = function (agreementId) {
                agreementsService
                    .checkAgreementPdf({agreementId:agreementId})
                    .$promise
                    .then(function (response) {
                        $scope.actualAgreement=response.data;
                        if ($scope.actualAgreement) {
                            if (parseInt($scope.actualAgreement.checked)) {
                                $scope.pdfAgreement=true;
                            }else{
                                $scope.pdfAgreement=false;
                                $scope.agreementTemplate = $scope.actualAgreement.html_for_edit;
                            }
                        }else{
                            $scope.pdfAgreement=false;
                        }
                        $scope.writtenAgreementPreview(agreementId);
                    });
            };

            $scope.getAgreementContract = function (agreementId) {
                agreementsService
                    .getAgreementContract({'id': agreementId})
                    .$promise
                    .then(function (response) {
                        $scope.contract = response;
                    });
            };

            $scope.checkWrittenAgreement = function (data, agreementTemplate) {
                agreementsService
                    .approveAgreement(
                        {
                            'idRequest': $stateParams.request, 'writtenAgreementId': $stateParams.id, 'sessionTime': data.sessionTime,
                            'id_agreement': data.agreement.id,
                            'html_for_pdf': document.getElementById('printableArea').innerHTML,
                            'html_for_edit': agreementTemplate
                        })
                    .$promise
                    .then(function (response) {
                        $scope.checkAgreementPdf(data.agreement.id);
                    })
                    .catch(function (error) {
                        bootbox.alert(error.data.reason);
                    })
            };

            $scope.cancelAgreementRequestToUser = function (data, id) {
                agreementsService
                    .cancelAgreementRequestToUser({'id':id})
                    .$promise
                    .then(function (response) {
                        $scope.checkAgreementPdf(data.agreement.id);
                    })
                    .catch(function (error) {
                        bootbox.alert(error.data.reason);
                    })
            };

            $scope.sendAgreementRequestToUser = function (data, agreementTemplate) {
                agreementsService
                    .agreementRequestToUser(
                        {
                            'id_agreement':data.agreement.id,
                            'html_for_pdf': document.getElementById('printableArea').innerHTML,
                            'html_for_edit': agreementTemplate
                        })
                    .$promise
                    .then(function (response) {
                        $scope.checkAgreementPdf(data.agreement.id);
                    })
                    .catch(function (error) {
                        bootbox.alert(error.data.reason);
                    })
            };

            $scope.rejectAgreementRequest = function (agreementId) {
                bootbox.dialog({
                        title: "Ти впевнений, що хочеш відхилити запит?",
                        message: '<div class="panel-body"><div class="row"><form role="form" name="rejectMessage"><div class="form-group col-md-12">' +
                        '<textarea class="form-control" style="resize: none" rows="6" id="rejectMessageText" ' +
                        'placeholder="тут можна залишити коментар, причина відхилення запиту на затвердження договору, яка надійде користувачу на його email"></textarea>' +
                        '</div></form></div></div>',
                        buttons: {
                            success: {
                                label: "Підтвердити", className: "btn btn-primary",
                                callback: function () {
                                    var comment = $jq('#rejectMessageText').val();
                                    agreementsService.rejectAgreementRequest({
                                        id_message: $stateParams.request,
                                        reject_comment: comment
                                    }).$promise.then(function () {
                                        $scope.writtenAgreementPreview(agreementId);
                                    });
                                }
                            },
                            cancel: {
                                label: "Скасувати", className: "btn btn-default",
                                callback: function () {
                                }
                            }
                        }
                    }
                );
            };

            $scope.loadWrittenAgreementTemplates=function(){
                return agreementsService
                    .getTemplatesList()
                    .$promise
                    .then(function (data) {
                        $scope.writtenTemplates=data;
                    });
            };
            $scope.loadWrittenAgreementTemplates();

            $scope.editUserAgreement=function () {
                if(!$scope.editModeAgreement){
                    $scope.options.updatedUserAgreement=$scope.agreementTemplate;
                    $scope.editModeAgreement=true;
                }else{
                    $scope.agreementTemplate=$scope.options.updatedUserAgreement;
                    $scope.editModeAgreement=false;
                }
            }

            $scope.saveUpdateAgreement =function (agreement, template) {
                agreementsService
                    .saveUpdateAgreement({agreementId:agreement.id,template: template})
                    .$promise
                    .then(function (data) {
                        $scope.editUserAgreement();
                    });
            }

            $scope.removeWrittenAgreement = function (data, id) {
                bootbox.confirm('Ви впевнені, що хочете скасувати договір?', function (result) {
                    if (result) {
                        agreementsService
                            .removeWrittenAgreement(
                                {'id':id})
                            .$promise
                            .then(function (response) {
                                $state.go('accountant/writtenAgreementsList');
                            })
                            .catch(function (error) {
                                bootbox.alert(error.data.reason);
                            })
                        }
                    });
            }

            $scope.getAgreementPdf = function (id) {
                agreementsService
                    .getAgreementFile({'id':id})
                    .$promise
                    .then(function (response) {
                        $scope.agreementPdf=response.data;
                    })
                    .catch(function (error) {
                        bootbox.alert("Отримати файл договору не вдалося");
                    })
            }
        }])
    .controller('writtenAgreementTemplate', ['$scope', '$http', '$stateParams', '$state', 'agreementsService',
        function ($scope, $http, $stateParams, $state, agreementsService) {
            $scope.changePageHeader('Шаблон паперового договору');

            $scope.date = new Date();

            $scope.editorOptionsAgreement = {
                toolbar: 'agreement'
            };

            $http.get(basePath + '/angular/js/teacher/templates/accountancy/agreementExample.json').success(function (response) {
                $scope.writtenAgreement = response;
            });

            $scope.saveAgreementTemplate = function (agreement, action) {
                if(!agreement.template || !agreement.name){
                    bootbox.alert('Тіло шаблону або назва не може бути пустою');
                }else{
                    $http({
                        method: "POST",
                        url: basePath + '/_teacher/_accountant/template/'+action,
                        data: $jq.param({template: agreement}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        cache: false
                    }).success(function (response) {
                        bootbox.alert('Шаблон успішно збережено', function () {
                            $state.go('accountant/writtenAgreementsList');
                        });
                    }).error(function () {
                        bootbox.alert("Шаблон договору створити не вдалося");
                    });
                }
            }

            if($stateParams.id){
                agreementsService
                    .getAgreementTemplate({id: $stateParams.id})
                    .$promise
                    .then(function successCallback(response) {
                        $scope.agreementTemplate = response.data;
                    }, function errorCallback() {
                        bootbox.alert("Шаблон договору отримати не вдалося");
                    });
            }
        }])
    .controller('agreementTemplatesList', ['$scope', '$http', '$stateParams', '$state', 'agreementsService','NgTableParams',
        function ($scope, $http, $stateParams, $state, agreementsService,NgTableParams) {
            $scope.changePageHeader('Шаблони паперових договорів');

            $scope.templatesTableParams = new NgTableParams({}, {
                getData: function (params) {
                    return agreementsService
                        .writtenAgreementsTemplateList(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });
            $scope.getDocument = function (documentID) {
                bootbox.alert({
                    message: "<img width='100%' src='" + basePath + '/_teacher/_accountant/accountant/getDocument?id=' + documentID + "'>",
                    size: 'large'
                })
            }
        }])
    .controller('agreementsForGroupCtrl', ['$scope','$compile','$http','$stateParams',
        function ($scope, $compile, $http, $stateParams) {
            $scope.checkboxes = {'checked': false, items: {}};

            $scope.$watch('checkboxes.items', function (values) {
                $scope.selectedStudents = []
                for (var key in values) {
                    if (values[key]) {
                        $scope.selectedStudents.push(key)
                    }
                }
                if ($scope.selectedStudents.length < $scope.offlineStudentsTableParams.data.length && $scope.selectedStudents.length > 0)
                    angular.element(document.querySelector("#select_all")).prop('indeterminate', true)
                else if ($scope.selectedStudents.length == 0) {
                    angular.element(document.querySelector("#select_all")).prop('indeterminate', false)
                }
            }, true);

            $scope.setService=function (type, id) {
                if(type=='module'){
                    $scope.selectedCourseService=null;
                } else $scope.selectedModuleService=null;
                $scope.selectedContent=id;
                $scope.serviceType=type;
                var schemesBlock=$jq('#agreementBlock');
                schemesBlock.show();
                ($compile(schemesBlock)($scope));
            }

            $scope.loadTemplates = function () {
                $http({
                    url: basePath + '/_teacher/_accountant/template/getTemplatesList',
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $scope.templates = response.data;
                }, function errorCallback() {
                    bootbox.alert("Отримати шаблони схем не вдалося");
                });
            };
            $scope.loadTemplates();

            $scope.createStudentsAgreement = function (moduleId, courseId, serviceType, scheme, templateId, allStudents, students) {
                if(typeof scheme == 'object'){
                    bootbox.alert("Спочатку обери схему проплати");
                }else{
                    var scheme = JSON.parse(scheme);
                    $scope.disabledButton=true;
                    $http({
                        url: basePath + '/_teacher/_accountant/agreements/setAgreementForStudents',
                        method: "POST",
                        data:$jq.param({moduleId: moduleId, courseId: courseId, serviceType: serviceType,
                            scheme:scheme, templateId:templateId, allStudents:allStudents,students:students, group:  $stateParams.id }),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).then(function successCallback(response) {
                        $scope.disabledButton=false;
                        bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        $scope.disabledButton=false;
                        bootbox.alert(response.data.reason);
                    });
                }
            };
        }])
    .filter('timestamp', function(){
        return function(input) {
            return Date.parse( angular.isString(input) ? input.replace(/\-/g, '/') : input );
        }
    })

function selectFromTypeahead(context, field, modelField, $item, $model, $label, $event) {
    context[field] = $model[modelField];
}

function defineSchemaType(input) {
    return ['module', 'user', 'course'].indexOf(input) >= 0 ? input : 'default'
}

function DateOptions() {
    this.popupOpened = false;
    this.maxDate = new Date(2020, 5, 22);
    this.minDate = new Date();
    this.startingDay = 1;
}

DateOptions.prototype.open = function () {
    this.popupOpened = true;
};

function ExternalPaymentDateOptions() {
    this.popupOpened = false;
    this.startingDay = 1;
}

ExternalPaymentDateOptions.prototype.open = function () {
    this.popupOpened = true;
};