/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('teacherConsultantModulesCtrl', function ($scope){
        $jq(document).ready(function () {
            $jq('#teacherModulesTable').DataTable({
                    "autoWidth": false,
                    language: {
                        "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                    }
                }
            );
        });
    })
    .controller('teacherConsultantTasksCtrl',function(){
        $jq(document).ready(function () {
            $jq('#tasksTable').DataTable({
                    "autoWidth": false,
                    language: {
                        "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                    },
                    "columns": [
                        null,
                        null,
                        null,
                        null,
                        {
                            "type": "de_date", targets: 1,
                        },
                        null,
                    ],
                    "order": [[ 5, "asc" ], [ 4, "desc" ]]
                }
            );
        });
    })