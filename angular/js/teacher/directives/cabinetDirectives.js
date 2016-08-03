angular
    .module('teacherApp')
    .directive('cabinetTable', cabinetTable);

function cabinetTable() {
    return function ($scope, element, attrs) {

            element.dataTable({
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                },
                "autoWidth": false,
            });


    }
};

