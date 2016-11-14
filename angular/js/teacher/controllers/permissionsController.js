/**
 * Created by adm on 31.08.2016.
 */

angular.module('teacherApp').controller('permissionsCtrl',permissionsCtrl);

function permissionsCtrl ($scope, typeAhead, $http, $state, $templateCache){

    $scope.teacherModule = null;
    $scope.onSelect = function ($item) {
        $scope.selectedTeacher = $item;
    };

    $scope.selectModule = function ($item) {
        $scope.selectedModule = $item;
    };

    $scope.reload = function(){
        $scope.selectedTeacher=null;
        $scope.selectedModule=null;
    };

    var teachersTypeaheadUrl = basePath+'/_teacher/_admin/module/teachersByQuery';
    var moduleTypeaheadUrl = basePath + '/_teacher/_admin/permissions/modulesByQuery';
    var consultantTypeaheadUrl = basePath + '/_teacher/_admin/permissions/consultantsByQuery';
    var authorsTypeaheadUrl = basePath+'/_teacher/_admin/module/authorsByQuery';

    $scope.getTeachers = function(value){
        return typeAhead.getData(teachersTypeaheadUrl,{query : value})
    };

    $scope.getAuthors = function(value) {
        return typeAhead.getData(authorsTypeaheadUrl,{query : value})
    };

    $scope.getModules = function(value){
            return typeAhead.getData(moduleTypeaheadUrl,{query : value});
    };

    $scope.getConsultants = function(value){
        return typeAhead.getData(consultantTypeaheadUrl,{query : value});
    };

    $scope.addPermission = function(permission){
        var url;
        var attribute;
        var role;
        switch (permission){
            case "moduleAuchtor":
                url = basePath + "/_teacher/_admin/teachers/setTeacherRoleAttribute";
                role = "author";
                attribute = "module";
                break;
            case "consultant":
                url = basePath + "/_teacher/_admin/teachers/setTeacherRoleAttribute";
                role = "consultant";
                attribute = "module";
                break;
            case "teacher_consultant":
                url = basePath + "/_teacher/_admin/teachers/setTeacherRoleAttribute";
                role = "teacher_consultant";
                attribute = "module";
                break;
        }
        if ($scope.selectedModule && $scope.selectedTeacher)
        $http({
            method:'POST',
            url: url,
            data: $jq.param({'attribute': attribute, 'attributeValue':$scope.selectedModule.id, 'role': role, 'user' : $scope.selectedTeacher.id  }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).success(function(data){
            if (data === 'success')
            {
                bootbox.alert("Операцію успішно виконано",function(){
                    $state.reload();
                });
            }
            else {
                switch (permission){
                    case "moduleAuchtor":
                        bootbox.alert("Обраний модуль вже присутній у списку модулів даного викладача");
                        break;
                    case "consultant":
                        bootbox.alert("Консультанту вже призначений даний модуль для консультацій");
                        break;
                    case "teacher_consultant":
                        bootbox.alert("Обраний модуль вже присутній у списку модулів даного викладача");
                        break;
                }
            }
        }).error(function(){
            bootbox.alert("Операцію не вдалося виконати");
        });

    };

    $scope.showModules = function($item, permission){
        var url = null;
        switch (permission){
            case "teacher":
                url = basePath + "/_teacher/_admin/permissions/showTeacherModules";
                break;
            case "consultant":
                url = basePath + "/_teacher/_admin/permissions/showConsultantModules";
                break;
        }
        $scope.selectedTeacher = $item;
        $http({
            method:'POST',
            url: url,
            data: $jq.param({'teacher': $item.id }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).success(function(data){
            switch (permission){
                case "teacher":
                    $scope.teacherModules = data.value;
                    break;
                case "consultant":
                    $scope.consultantModules = data.value;
                    break;
            }

        }).error(function(){
            console.log("error");
        })
    };

    $scope.cancelPermission = function(permission, moduleID){
        var url;
        switch (permission){
            case "moduleAuchtor":
                url = basePath + "/_teacher/_admin/permissions/cancelTeacherPermission";
                break;
            case "consultant":
                url = basePath + "/_teacher/_admin/permissions/cancelConsultantPermission";
                break;
        }
        if (moduleID && $scope.selectedTeacher)
            $http({
                method:'POST',
                url: url,
                data: $jq.param({'module':moduleID, 'user' : $scope.selectedTeacher.id  }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            }).success(function(data){
                if (data === 'success')
                {
                    bootbox.alert("Операцію успішно виконано",function(){
                        $state.reload();
                    });
                }
                else {
                    switch (permission){
                        case "moduleAuchtor":
                            bootbox.alert("Операцію не вдалося виконати.");
                            break;
                        case "consultant":
                            bootbox.alert("Операцію не вдалося виконати.");
                            break;
                    }
                }
            }).error(function(){
                bootbox.alert("Операцію не вдалося виконати");
            });
    }

    $scope.addCMPermission = function(permission,user){
        var url;
        var attribute;
        var role;
        switch (permission){
            case "author":
                url = basePath + "/_teacher/_admin/teachers/setTeacherRoleAttribute";
                role = "author";
                attribute = "module";
                break;
            case "consultant":
                url = basePath + "/_teacher/_admin/teachers/setTeacherRoleAttribute";
                role = "consultant";
                attribute = "module";
                break;
            case "teacher_consultant":
                url = basePath + "/_teacher/_admin/teachers/setTeacherRoleAttribute";
                role = "teacher_consultant";
                attribute = "module";
                break;
        }
        if ($scope.selectedModule && user)
            $http({
                method:'POST',
                url: url,
                data: $jq.param({'attribute': attribute, 'attributeValue':$scope.selectedModule.id, 'role': role, 'user' : user  }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            }).success(function(data){
                if (data === 'success')
                {
                    bootbox.alert("Операцію успішно виконано",function(){
                        $templateCache.remove(basePath+'/_teacher/_content_manager/contentManager/showTeacher/id/'+user);
                        $state.go($state.current, {}, {reload: true});
                    });
                }
                else {
                    switch (permission){
                        case "moduleAuchtor":
                            bootbox.alert("Обраний модуль вже присутній у списку модулів даного викладача");
                            break;
                        case "consultant":
                            bootbox.alert("Консультанту вже призначений даний модуль для консультацій");
                            break;
                        case "teacher_consultant":
                            bootbox.alert("Обраний модуль вже присутній у списку модулів даного викладача");
                            break;
                    }
                }
            }).error(function(){
                bootbox.alert("Операцію не вдалося виконати");
            });

    };
}
