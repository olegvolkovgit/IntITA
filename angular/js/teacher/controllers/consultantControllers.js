/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('consultantModulesCtrl', function ($scope){
        $jq(document).ready(function () {
            $jq('#consultantModulesTable').DataTable({
                    "autoWidth": false,
                    language: {
                        "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                    },
                    "columns": [
                        null,
                        {
                            "type": "de_date", targets: 1,
                        },
                    ]
                }
            );
        });
    })