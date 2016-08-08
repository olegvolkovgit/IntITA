/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('agreementsCtrl', function ($scope, agreementsService) {
        $scope.test ='1234';

        console.log(agreementsService);

        // $http({
        //     method: 'GET',
        //     url: '/_teacher/_accountant/agreements/getAgreementsList',
        //     params: $scope.show
        // })
        //     .then(function (response) {
        //         $scope.data = response.data;
        //     })
        //     .catch(function (err) {
        //         $scope.data = [];
        //         console.log(err);
        //     });


        $jq('#agreements').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                },
                "columns": [
                    null,
                    null,
                    {
                        "type": "de_date", targets: 1,
                    },
                    {
                        "type": "de_date", targets: 1,
                    },
                    null,
                    null,
                    null
                ]
            }
        );
    })

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
