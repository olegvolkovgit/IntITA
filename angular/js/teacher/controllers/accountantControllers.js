/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('agreementsCtrl', ['$scope', '$location', '$stateParams', 'agreements', 'NgTableParams', function ($scope, $location, $stateParams, agreements, NgTableParams) {

        $scope.tableParams = new NgTableParams({}, {
            getData: function (params) {
                return agreements
                    .list({
                        page: params.page(),
                        pageCount: params.count()
                    })
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });

        $scope.confirm = function (id) {
            return agreements
                .confirm({id: id})
                .$promise
                .then(function (data) {
                    $scope.tableParams.reload();
                    return data;
                });
        };

        $scope.confirm = function (id) {
            return agreements
                .cancel({id: id})
                .$promise
                .then(function (data) {
                    $scope.tableParams.reload();
                    return data;
                });
        };

        $scope.showAgreement = function (id) {
            $location.path('accountant/agreement/' + id);
        }

    }])

    .controller('agreementDetailCtrl', ['$scope', '$location', '$stateParams', 'agreements', 'invoices', 'NgTableParams',
        function ($scope, $location, $stateParams, agreements, invoices, NgTableParams) {
            $scope.agreementId = $stateParams.agreementId;

            agreements
                .getById({id: $scope.agreementId})
                .$promise
                .then(function (data) {
                    $scope.agreementData = data;
                });

            $scope.tableTemplate = '/angular/js/teacher/templates/accountancy/invoicesTable.html';

            $scope.tableParams = new NgTableParams({}, {
                getData: function (params) {
                    return invoices
                        .list({
                            page: params.page(),
                            pageCount: params.count(),
                            agreementId: $scope.agreementId
                        })
                        .$promise
                        .then(function (data) {
                            params.total(data.count);
                            return data.rows;
                        });
                }
            });
        }])

    .controller('invoicesCtrl', ['$scope', 'invoices', 'NgTableParams', function ($scope, invoices, NgTableParams) {

        $scope.tableTemplate = '/angular/js/teacher/templates/accountancy/invoicesTable.html';
        $scope.tableParams = new NgTableParams({}, {
            getData: function (params) {
                return invoices.list({
                    page: params.page(),
                    pageCount: params.count()
                })
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });


        $jq('#invoices').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    }])

    .controller('operationCtrl', function ($scope) {
        $jq('#operationsTable').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );

    })

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
