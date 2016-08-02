/**
 * Created by Quicks on 15.12.2015.
 */
angular
    .module('teacherApp',['ui.bootstrap','ngBootbox','messagesRouter','cabinetRouter', 'adminRouter','authorRouter','consultantRouter','teacherConsultantRouter','trainerRouter','studentRouter','tenantRouter','accountantRouter','contentManagerRouter','directive.loading'])
    .directive('messagedTable', function() {
        return function($scope, element, attrs) {

            $scope.$watch(function(){
                element.dataTable({
                        language: {
                            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                        },
                        "autoWidth": false,
                        "bRetrieve": true
                    } );

            });
        }
    });
