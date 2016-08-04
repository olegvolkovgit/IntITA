/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('trainerStudentsCtrl', function ($scope){
        $jq('#trainerStudentsTable').DataTable( {
            language: {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
            },
            "columns": [
                null,
                {
                    "type": "de_date", targets: 1
                },
                {
                    "width": "15%"
                }
            ]
        } );
    });