/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('agreementsCtrl', ['$scope', 'agreementsService', 'paymentSchemaService', 'NgTableParams','lodash','$filter',
        function ($scope, agreements, paymentSchema, NgTableParams, _,$filter) {
            $scope.currentDate = currentDate;
            $scope.agreementsTableParams = new NgTableParams({sorting: { create_date: "desc" } }, {
                getData: function (params) {
                    return agreements
                        .list(params.url())
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            data.rows.forEach(function(row) {
                                var paid=0;
                                //get paid sum for agreement
                                row.internalPayment.forEach(function (pay) {
                                    paid = paid+Number(pay.summa);
                                });
                                row.paidAmount=paid;
                                //get agreement payment_date and expiration_date
                                for (var index = 0; index < row.invoice.length; ++index) {
                                    var invoicePaid=0;
                                    _.filter(row.internalPayment, ['invoice_id', row.invoice[index].id]).forEach(function (pay) {
                                        invoicePaid = invoicePaid+Number(pay.summa);
                                    });
                                    if(invoicePaid<row.invoice[index].summa){
                                        row.payment_date=row.invoice[index].payment_date;
                                        row.expiration_date=row.invoice[index].expiration_date;
                                        break;
                                    }
                                }
                            });
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
                bootbox.confirm('Ви впевнені, що хочете скасувати договір?', function(result) {
                    if(result){
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
        $scope.agreementId = $stateParams.agreementId;
    }])

    .controller('invoiceDetailCtrl', ['$scope', '$stateParams', function ($scope, $stateParams) {
        $scope.invoiceId = $stateParams.invoiceId;
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
        'lodash',
        'agreementsService',
        'invoicesService',
        'userService',
        'operationsService',
        'externalPaymentsService',
        'ngToast',
        function ($scope, $state, $q, _, agreements, invoices, user, operations, externalPayments, ngToast) {
            $scope.typeaheadProviders = {
                user: {
                    name: 'користувачу',
                    searchField: 'email',
                    provider: user,
                    label: function (user) {
                        return user ? (((user.firstName || '' ) + ' ' + (user.middleName || '') + ' ' + (user.secondName || '') + ' <' + (user.email || ''))+'>').trim(): '';
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
                        ' (погашено: ' +(invoice.paidAmount || '0')+ ')') : '';
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
                        $scope.operation.sum=$scope.operation.sum-item.amount;
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
            $scope.clearOperation = function() {
                $scope.operation.invoiceId = null;
                $scope.operation.invoices = [];
                $scope.operation.sum = 0;
            };

            $scope.invoicesSum = function () {
                return $scope.operation.invoices.reduce(function (sum, item) {
                    $scope.operation.sum=sum += Number(item.amount);
                    return $scope.operation.sum;
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
                    .getById({id:externalPaymentId})
                    .$promise
                    .then(function (data) {
                        data.amount=Number(data.amount);
                        $scope.externalPayment=data;
                    })
            };

            $scope.updateOperationInvoicesData = function () {
                $scope.operation.invoices.forEach(function(item, key) {
                    if (_.find($scope.operation.invoices, ['id', item.id]) && _.find($scope.invoicesList, ['id', item.id])) {
                        $scope.operation.invoices[key]=_.find($scope.invoicesList, ['id', item.id]);
                    }
                });
                $scope.operation.invoices.forEach(function(item, key) {
                    if($scope.operation.invoices[key].paidAmount==$scope.operation.invoices[key].summa)
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
                            data.forEach(function(invoice) {
                                if(invoice.paidAmount!=invoice.summa)
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
                                    dismissOnTimeout:false,
                                    dismissButton:true,
                                    className:'success',
                                    content:'Нове надходження коштів успішно створено'
                                });
                                $scope.formDirty=false;
                                $scope.externalPayment = {};
                                return data;
                            }
                        })
                } else {
                    return $q.when($scope.externalPayment);
                }
            };

            $scope.createOperation = function createOperation() {
                $scope.toastMessages='';
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
                            if(sendData.agreementId){
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
                            if($scope.externalPayment.id)
                                $scope.externalPaymentsReload($scope.externalPayment.id);
                            if($scope.operation.agreementId)
                                $scope.updateInvoiceData({'extraParams[agreement_id]': $scope.operation.agreementId})
                                    .then(
                                        function success() {
                                            $scope.updateOperationInvoicesData();
                                        }
                                    )
                            if(response){
                                if (response.status !== 'error') {
                                    if (response.message && response.message.length) {
                                        if (_.isArray(response.message)) {
                                            response.message.forEach(function(item) {
                                                $scope.toastMessages+=item+'<br>';
                                            });
                                            ngToast.create({
                                                dismissOnTimeout:false,
                                                dismissButton:true,
                                                className:'success',
                                                content:response.message
                                            });
                                        } else {
                                            ngToast.create({
                                                dismissOnTimeout:false,
                                                dismissButton:true,
                                                className:'success',
                                                content:'Операція пройшла успішно'
                                            });
                                        }
                                    }
                                } else {
                                    ngToast.create({
                                        dismissOnTimeout:false,
                                        dismissButton:true,
                                        className:'danger',
                                        content:response.message
                                    })
                                }
                            }
                            $scope.loaderControl.hide();
                        })
                    .catch(
                        function (response) {
                            if (response.message) {
                                $scope.formDirty=true;
                                response.message.forEach(function(item) {
                                    $scope.toastMessages+=item+'<br>';
                                });
                                ngToast.create({
                                    dismissOnTimeout:false,
                                    dismissButton:true,
                                    className:'danger',
                                    content : $scope.toastMessages,
                                })
                            } else {
                                ngToast.create({
                                    dismissOnTimeout:false,
                                    dismissButton:true,
                                    className:'danger',
                                    content:"Виникла помилка"
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
                            item.paidAmount=0;
                            item.summa = Number(item.summa);
                            item.internalPayment.forEach(function(pays) {
                                item.paidAmount=Number(item.paidAmount)+Number(pays.summa);
                            });
                            item.amount = item.summa-item.paidAmount;
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

    .controller('companiesCtrl', function ($scope, $http, $state, NgTableParams, $resource) {
        $scope.changePageHeader('Компанії');
        $scope.companiesTable = new NgTableParams({
            sorting: {},
        }, {
            getData: function (params) {
                return $resource(basePath + '/_teacher/_accountant/company/getCompaniesList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });
    })
    .controller('oneCompanyCtrl', function ($scope, $http, $state, NgTableParams, $resource) {
        $scope.changePageHeader('Компанія');

        $scope.addCompany=function(url) {
            $http({
                url: url,
                method: "POST",
                data: $jq.param({
                    title: $jq('[name="title"]').val(),
                    EDPNOU: $jq('[name="edpnou"]').val(),
                    certificate_of_vat: $jq('[name="certificate_of_vat"]').val(),
                    edpnou_issue_date: $jq('#edpnou_issue_date').val(),
                    certificate_of_vat_issue_date: $jq('#certificate_of_vat_issue_date').val(),
                    tax_certificate: $jq('[name="tax_certificate"]').val(),
                    tax_certificate_issue_date: $jq('#tax_certificate_issue_date').val(),
                    legal_address: $jq('[name="legal_address"]').val(),
                    legal_address_city_code: $jq('#cityLegal').val(),
                    legal_address_city_value: $jq('[name="cityLegal"]').val(),
                    actual_address: $jq('[name="actual_address"]').val(),
                    actual_address_city_code: $jq('#cityActual').val(),
                    actual_address_city_value: $jq('[name="cityActual"]').val()
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                bootbox.alert(response.data, function(){
                    if(response.data != "Неправильні дані.")
                        $state.go("accountant/company", {}, {reload: true});
                });
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
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
        
        $scope.$watch('newRepresentative', function() {
            if ($scope.newRepresentative)
                $jq('#typeaheadRepresentative').css('background-color', '#eee');
            else $jq('#typeaheadRepresentative').css('background-color', 'inherit');
        });

        $scope.addRepresentative=function(url) {
            var error=false;
            if ($jq('#representative').val() == 0 && !($jq('[name="full_name"]').val())) {
                bootbox.alert('Виберіть існуючого представника зі списку або додайте нового.');
                error=true;
            } if($jq('#companyId').val()==0){
                bootbox.alert('Виберіть існуючу компанію зі списку або створіть нову');
                error=true;
            }
            if(!error) {
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
            bootbox.confirm('Ви впевнені що хочете видалити тип проплати ' + id + '?',function (result) {
                if(result){
                    $http({
                        method:'POST',
                        url:basePath+'/_teacher/_accountant/operationType/delete',
                        data: $jq.param({id:id}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    })
                        .success(function (data) {
                            bootbox.alert('Тип проплат видалений.',function () {
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

        $scope.deleteExternalSources=function (id){
            bootbox.confirm('Ви впевнені що хочете видалити зовнішнє джерело коштів?', function(result) {
                if (result) {
                    $http({
                        url: basePath+'/_teacher/_accountant/externalSources/delete',
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

    .controller('cancelReasonTypeCtrl', function ($scope) {
        $jq('#cancelReasonTypes').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
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
                  educationForm : 1
                };

                $scope.user = {
                    isSelect : $scope.schemeType === 'user',
                    typeahead: function getUserTypeahead(value) {
                        return user.typeahead({query: value}).$promise
                    },
                    label: function (user) {
                        return user ? ((user.firstName || '' ) + ' ' + (user.middleName || '') + ' ' + (user.secondName || '') + ', ' + (user.email || '')) : '';
                    },
                    onSelect: selectFromTypeahead.bind(null, $scope.paymentSchema, 'userId', 'id')
                };

                $scope.course = {
                    isSelect : $scope.schemeType === 'user' || $scope.schemeType === 'course',
                    typeahead: function getCourseTypeahead(value) {
                        return course.typeahead({query: value}).$promise
                    },
                    label: function (course) {
                        return course ? ((course.title_ua || '' ) + ', ' + (course.language || '')) : '';
                    },
                    onSelect: selectFromTypeahead.bind(null, $scope.paymentSchema, 'courseId', 'course_ID')
                };

                $scope.module = {
                    isSelect : $scope.schemeType === 'user' || $scope.schemeType === 'module',
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
                                    content : 'Схема створена успішно'
                                })
                            } else {
                                ngToast.create({
                                    className:'danger',
                                    content:"Під час створення схеми виникла помилка."
                                })
                            }
                        });
                }
            }
        ]
    )

    .controller('externalSourceCtrl', function ($scope, $http, $stateParams, externalSourcesService) {
        $scope.loadExternalSourceData=function(id){
            externalSourcesService.externalSource({'id':id}).$promise
                .then(function successCallback(response) {
                    $scope.source=response;
                    $scope.source.cash=Number($scope.source.cash);
                }, function errorCallback() {
                    bootbox.alert("Отримати дані джерела коштів не вдалося");
                });
        };
        
        if($stateParams.id){
            $scope.modelId=$stateParams.id;
            $scope.loadExternalSourceData($scope.modelId);
        }
        $scope.sendExternalSourceForm= function (scenario, name, cash, modelId) {
            if(scenario=='create') $scope.createExternalSource(name, cash);
            else if(scenario=='update') $scope.updateExternalSource(modelId, name, cash);
        };

        $scope.clearForm = function () {
            $scope.source.name=null;
            $scope.externalSourceForm.name.$setPristine();
        };
        
        $scope.createExternalSource= function (name, cash) {
            $http({
                url: basePath+'/_teacher/_accountant/externalSources/createExternalSource',
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

        $scope.updateExternalSource= function (id, name, cash) {
            $http({
                url: basePath+'/_teacher/_accountant/externalSources/updateExternalSource',
                method: "POST",
                data: $jq.param({
                    id:id,
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

    .controller('paymentsSchemaTemplateTableCtrl', ['$scope', '$stateParams', 'NgTableParams','paymentSchemaService',
        function ($scope, $stateParams, NgTableParams,paymentSchemaService) {
            $scope.changePageHeader('Шаблони схем');

            $scope.schemesTemplateTableParams = new NgTableParams({}, {
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

    .controller('paymentsSchemesTableCtrl', ['$scope', 'NgTableParams','paymentSchemaService','$http',
        function ($scope, NgTableParams,paymentSchemaService, $http) {
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
            $scope.servicesTemplateTableParams = new NgTableParams({}, {
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
            $scope.usersTemplateTableParams = new NgTableParams({}, {
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

            $scope.cancelPaymentScheme=function(id){
                $http({
                    url: basePath+'/_teacher/_accountant/paymentSchema/cancelPaymentScheme',
                    method: "POST",
                    data: $jq.param({
                        id:id,
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
    
    .controller('paymentsSchemaTemplateCtrl', ['$scope', 'lodash', '$http', '$state','$stateParams', function ($scope, _, $http, $state, $stateParams) {
        $scope.changePageHeader('Створення та редагування шаблонів схем');
        $scope.loadSchemesTemplate=function(templateId){
            $http({
                url: basePath+'/_teacher/_accountant/paymentSchema/getSchemesTemplate',
                method: "POST",
                data: $jq.param({
                    templateId:templateId,
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                $scope.schemes=response.data.schemes;
                $scope.schemes.forEach(function(item) {
                    item.discount=Number(item.discount);
                    item.loan=Number(item.loan);
                    item.pay_count=Number(item.pay_count);
                });
                $scope.template={
                    id:response.data.id,
                    name:response.data.template_name,
                    schemes:$scope.schemes,
                };
            }, function errorCallback() {
                bootbox.alert("Отримати дані шаблона схем не вдалося");
            });
        };

        if($stateParams.id) {
            $scope.loadSchemesTemplate($stateParams.id);
        }
        
        $scope.schemes = [
            {pay_count:1,discount:30,loan:0,name:'Проплата наперед'},
            {pay_count:2,discount:10,loan:0,name:'2 проплати'},
            {pay_count:4,discount:8,loan:0,name:'4 проплати'},
            {pay_count:12,discount:0,loan:0,name:'Оплата за рік помісячно'},
            {pay_count:24,discount:0,loan:24,name:'Кредитування на 2 роки'},
            {pay_count:36,discount:0,loan:24,name:'Кредитування на 3 роки'},
            {pay_count:48,discount:0,loan:24,name:'Кредитування на 4 роки'},
            {pay_count:60,discount:0,loan:24,name:'Кредитування на 5 роки'},
        ];

        $scope.template={
            name:'',
            schemes:$scope.schemes,
        }
        
        $scope.payCount = [
            {value: 1, name: 'Проплата наперед'},
            {value: 2, name: '2 проплати'},
            {value: 3, name: '3 проплати'},
            {value: 4, name: '4 проплати'},
            {value: 6, name: '6 проплат'},
            {value: 12, name: 'Оплата за рік помісячно'},
            {value: 24, name: 'Кредитування на 2 роки'},
            {value: 36, name: 'Кредитування на 3 роки'},
            {value: 48, name: 'Кредитування на 4 роки'},
            {value: 60, name: 'Кредитування на 5 роки'},
        ]

        $scope.updateScheme = function(payCount,index){
            $scope.schemes[index]['name']=_.find($scope.payCount, ['value', payCount]).name;
            if(payCount>12){
                $scope.schemes[index]['discount']=0;
            }else {
                $scope.schemes[index]['loan']=0;
            }
        };

        $scope.operation = {
            addScheme: function addScheme() {
                $scope.schemes.push({pay_count:1,discount:0,loan:0,name:'Проплата наперед'});
            },
            removeScheme: function removeScheme(index) {
                _($scope.schemes)
                    .splice(index, 1)
                    .value();
            }
        };

        $scope.createTemplate= function (template) {
            var check=true;
            var msgError='';
            if(_.filter(template.schemes, ['pay_count', 1]).length==0){
                msgError='Шаблон схем обов\'язково має містити схему "проплата наперід"';
                check=false;
            }
            template.schemes.forEach(function(item) {
                if(_.filter(template.schemes, ['pay_count', item.pay_count]).length>1){
                    msgError='Шаблон схем не може містити схеми з однаковою кількість проплат';
                    check=false;
                    return false;
                }
            });
            if(check) {
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
            }else{
                bootbox.alert(msgError);
            }
        };

        $scope.updateTemplate= function (template) {
            var check=true;
            var msgError='';
            if(_.filter(template.schemes, ['pay_count', 1]).length==0){
                msgError='Шаблон схем обов\'язково має містити схему "проплата наперід"';
                check=false;
            }
            template.schemes.forEach(function(item) {
                if(_.filter(template.schemes, ['pay_count', item.pay_count]).length>1){
                    msgError='Шаблон схем не може містити схеми з однаковою кількість проплат';
                    check=false;
                    return false;
                }
            });
            if(check){
                $http({
                    url: basePath+'/_teacher/_accountant/paymentSchema/updateSchemeTemplate',
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
            }else{
                bootbox.alert(msgError);
            }
        };
    }])

    .controller('paymentsSchemaTemplateApplyCtrl', ['$scope', 'lodash', '$http', '$state','$stateParams','paymentSchemaService', 
        function ($scope, _, $http, $state, $stateParams, paymentSchemaService) {
            $scope.changePageHeader('Застосування шаблону схем');

            $scope.loadTemplates=function(){
                $http({
                    url: basePath+'/_teacher/_accountant/paymentSchema/getSchemesTemplatesList',
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $scope.templates=response.data;
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
            $scope.reloadCourse = function(){
                $scope.paymentSchema['courseId']=null;
            };
            $scope.onSelectModule = function ($item) {
                $scope.paymentSchema['moduleId'] = $item.id;
            };
            $scope.reloadModule = function(){
                $scope.paymentSchema['moduleId']=null;
            };
            $scope.onSelectUser = function ($item) {
                $scope.paymentSchema['userId'] = $item.id;
            };
            $scope.reloadUser = function(){
                $scope.paymentSchema['userId']=null;
            };

            $scope.applyTemplate = function () {
                paymentSchemaService
                    .applyTemplate($scope.paymentSchema)
                    .$promise
                    .then(function (data) {
                        if (data.message === 'OK') {
                            bootbox.alert('Шаблон схем успішно застосовано',function () {
                                $state.reload();
                            });
                        } else {
                            bootbox.alert('Під час застосування шаблону схеми виникла помилка');
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
    .controller('documentsCtrl', ['$scope', '$stateParams','NgTableParams','accountantService','$http', function ($scope, $stateParams,NgTableParams,accountantService, $http) {
        $scope.changePageHeader('Копії документів');

        $scope.docStatus = [{id:0, title:'не перевірені'}, {id:1, title:'перевірені'}];
        $scope.documentsTableParams = new NgTableParams({filter:{'check':0}}, {
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

        $scope.createDocumentsFolder=function () {
            $http({
                method: 'POST',
                url: basePath+'/_teacher/_accountant/accountant/createDocumentsFolder',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function successCallback() {
                bootbox.alert("Папку створено");
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати");
            });
        }

        $scope.changeDocStatus=function (id) {
            $http({
                method: 'POST',
                url: basePath+'/_teacher/_accountant/accountant/changeDocumentStatus',
                data: $jq.param({id: id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function successCallback() {
                $scope.documentsTableParams.reload();
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати");
            });
        }
    }])

function selectFromTypeahead(context, field, modelField, $item, $model, $label, $event) {
    context[field] = $model[modelField];
}

function defineSchemaType(input) {
    return ['module', 'user', 'course'].indexOf(input) >= 0 ? input : 'default'
}

function DateOptions () {
    this.popupOpened = false;
    this.maxDate = new Date(2020, 5, 22);
    this.minDate = new Date();
    this.startingDay = 1;
}

DateOptions.prototype.open = function () {
    this.popupOpened = true;
};

function ExternalPaymentDateOptions () {
    this.popupOpened = false;
    this.startingDay = 1;
}

ExternalPaymentDateOptions.prototype.open = function () {
    this.popupOpened = true;
};