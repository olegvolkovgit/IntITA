/**
 * Created by adm on 13.11.2016.
 */
angular
    .module('teacherApp')
    .controller('mailTemplatesCtrl', mailTemplatesCtrl);

function mailTemplatesCtrl($scope, $http, $resource, $state, NgTableParams, $stateParams,$ngBootbox, $httpParamSerializerJQLike) {

    $scope.loadMailTemplate = function (item) {
        $scope.$emit('mailTemplateSelected', item);
        $ngBootbox.hideAll();
    };

    $scope.editorOptions = {
        language: 'uk-ua',
    };

    $scope.mailTemplateModel = null;
    $scope.errors = "";

    if (($state.is('newsletter/template/edit/:id') || $state.is('newsletter/template/view/:id')) && $stateParams.id)
        $http.get(basePath + "/_teacher/mailTemplates/getModel/id/" + $stateParams.id).then(function (response) {
            $scope.mailTemplateModel = response.data;
        });
    var table = $resource(basePath + '/_teacher/mailTemplates/getMailTemplates');
    $scope.mailTemplatesTable = new NgTableParams({
        page: 1,
        count: 10,
    }, {
        getData: function (params) {
            return table.get(params.url()).$promise.then(function (data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.addMailTemplate = function () {
        var url = basePath + "/_teacher/mailTemplates/create"

        if ($scope.mailTemplateModel.id){
            url =  basePath + "/_teacher/mailTemplates/update/id/"+$scope.mailTemplateModel.id
        }

        $http({
            method: 'POST',
            url: url,
            data: $httpParamSerializerJQLike({MailTemplates:$scope.mailTemplateModel}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).success(function (data) {
            if (data === 'success') {
                $state.go('newsletter/templates');
            }
            else {
                $scope.errors = data;
            }
        }).error(function () {
            bootbox.alert('Что-то пошло не так');
        })
    };

    $scope.deleteTemplate = function (id) {
        bootbox.confirm('Ви дійсно бажаєте видалити шаблон?', function (result) {
                if (result){
                    $http({
                        method: 'POST',
                        url: basePath + "/_teacher/mailTemplates/delete",
                        data: $jq.param({id:id}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                    }).success(function (data) {
                        if (data === 'success') {
                            $scope.mailTemplatesTable.reload();
                        }
                        else {
                            $scope.errors = data;
                        }
                    }).error(function () {
                        bootbox.alert('Что-то пошло не так');
                    })
                }
            }
        );
    };

}