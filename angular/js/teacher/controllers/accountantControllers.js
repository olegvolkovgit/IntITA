/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('agreementsCtrl', ['$scope', 'agreements', 'NgTableParams', function ($scope, agreements, NgTableParams) {

        $scope.tableParams = new NgTableParams({}, {
            getData: function(params) {
                return agreements.list({
                    page: params.page(),
                    pageCount: params.count()
                })
                    .$promise
                    .then(function (data) {
                        params.total(data.count); // recal. page nav controls
                        return data.rows;
                    });
            }
        });

    }])

    .controller('invoicesCtrl',function($scope){
        $jq('#invoices').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    })

    .controller('operationCtrl',function($scope){
        $jq('#operationsTable').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );

    })

    .controller('companyCtrl',function($scope){
        initCompanies();
    })

    .controller('representativeCtrl',function($scope){
        initCompanyRepresentatives();
        initRepresentatives();
    })

    .controller('operationTypeCtrl',function($scope){
        $jq('#operationTypes').DataTable({
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    })

    .controller('externalSourcesCtrl',function($scope){
        $jq('#externalSources').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    })

    .controller('cancelReasonTypeCtrl',function($scope){
            $jq('#cancelReasonTypes').DataTable({
                    "autoWidth": false,
                    language: {
                        "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                    }
                }
            );
    });
