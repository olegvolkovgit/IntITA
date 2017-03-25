/**
 * Created by adm on 08.08.2016.
 */
angular
  .module('teacherApp')
  .controller('modulesTableCtrl', ['$scope', 'NgTableParams', '$resource', modulesTableCtrl])
  .controller('moduleManageCtrl', ['$scope', '$http', '$stateParams', 'tagsService', 'lodash', moduleManageCtrl])
  .controller('moduleAuthorsTableCtrl', moduleAuthorsTableCtrl)
  .controller('moduleTeachersConsultantTableCtrl', moduleTeachersConsultantTableCtrl);

function modulesTableCtrl($scope, NgTableParams, $resource) {
  $scope.changePageHeader('Модулі');

  var dataFromServer = $resource(basePath + '/_teacher/moduleManage/getModulesList');
  $scope.modulesTable = new NgTableParams({
    sorting: {'module_ID': "asc"}
  }, {
    getData: function (params) {
      return dataFromServer.get(params.url()).$promise.then(function (data) {
        params.total(data.count);
        return data.rows;
      });
    }
  });

  $scope.statuses = [{id: '0', title: 'в розробці'}, {id: '1', title: 'готовий'}];
  $scope.cancelled = [{id: '0', title: 'доступний'}, {id: '1', title: 'видалений'}];
  $scope.lang = [{id: 'ua', title: 'ua'}, {id: 'ru', title: 'ru'}, {id: 'en', title: 'en'}];

  $scope.levels = $resource(basePath + '/_teacher/_super_admin/level/getlevelslist').get()
    .$promise.then(function (data) {
      var levels = [];
      data.rows.forEach(function (element) {
        levels.push({
          'id': element.id,
          'title': element.title_ua
        })
      });
      return levels;
    });
}

function moduleManageCtrl($scope, $http, $stateParams, tagsService, _) {

  $scope.changePageHeader('Модуль');
  $scope.moduleId = $stateParams.moduleId;

  $scope.changeStatus = function (moduleId, status) {
    var url;
    switch (status) {
      case 'delete':
        url = basePath + '/_teacher/_admin/module/delete/id/' + moduleId;
        break;
      case 'restore':
        url = basePath + '/_teacher/_admin/module/restore/id/' + moduleId;
        break;
    }
    bootbox.confirm("Ви впевнені?", function (result) {
      if (result) {
        $http({
          method: "POST",
          url: url,
          headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).success(function (message) {
          bootbox.alert(message);
          location.hash = '/module/view/' + moduleId;
        }).error(function () {
          bootbox.alert("Операцію не вдалося виконати.");
        })
      }
      else {
        bootbox.alert("Операцію відмінено");
      }
    })
  };

  //add module tags
  $scope.checkTags = function () {
    moduleTags = $scope.moduleTags;
  };

  $scope.languages = [
    {name: 'українською', value: 'ua'},
    {name: 'російською', value: 'ru'},
    {name: 'англійською', value: 'en'}
  ];

  // create or update module tags
  $scope.moduleTags = [];
  if ($scope.moduleId) {
    tagsService.moduleTags({idModule: $scope.moduleId}).$promise.then(function (response) {
        $scope.moduleTags = response;
      },
      function errorCallback(error) {
        console.error(error);
        bootbox.alert('Виникла помилка при завантажені хмарини тегів');
        return;
      });
  }

  $scope.removeTag = function (tag, index) {
    tagsService
      .removeTagFromModule({idModule:$scope.moduleId, tagId:tag.id})
      .$promise
      .then(function(data) {
          $scope.moduleTags = $scope.moduleTags.filter(function(item) {
          return item.id != tag.id;
        })
      },
      function (error) {
        console.error(error)
      })
  };

  $scope.newTag = {
    visible: false,
    text: '',
    clearInput: function () {
      $scope.newTag.text = '';
    },
    show: function () {
      $scope.newTag.visible = true;
    },
    hide: function () {
      $scope.newTag.visible = false;
    },
    save: function () {
      tagsService
        .addTagToModule({idModule: $scope.moduleId, tag: [{id: -1, tag: $scope.newTag.text}]})
        .$promise
        .then(function (data) {
            data.forEach(function (item) {
              $scope.moduleTags.push(item);
            });
            $scope.moduleTags = _.uniqBy($scope.moduleTags, 'id');
            $scope.newTag.discard();
          },
          function (error) {
            console.error(error);
          });
    },
    discard: function () {
      $scope.newTag.hide();
      $scope.newTag.clearInput();
    }
  }
}

function moduleAuthorsTableCtrl($scope, NgTableParams, $resource, $stateParams, roleAttributeService) {
  var dataFromServer = $resource(basePath + '/_teacher/moduleManage/getModuleAuthorsList');
  $scope.moduleAuthorsTable = new NgTableParams({'idModule': $stateParams.moduleId}, {
    getData: function (params) {
      return dataFromServer.get(params.url()).$promise.then(function (data) {
        params.total(data.count);
        return data.rows;
      });
    }
  });

  $scope.cancelTeacherRoleAttribute = function (role, attribute, userId, attributeId) {
    roleAttributeService
      .unsetRoleAttribute({
        'attribute': attribute,
        'attributeValue': attributeId,
        'role': role,
        'userId': userId
      })
      .$promise
      .then(function successCallback(response) {
        if (response.data == 'success')
          $scope.moduleAuthorsTable.reload();
        else bootbox.alert("Операцію не вдалося виконати");
      }, function errorCallback(data) {
        console.log(data);
        bootbox.alert("Операцію не вдалося виконати");
      });
  };
}

function moduleTeachersConsultantTableCtrl($scope, NgTableParams, $resource, $stateParams, roleAttributeService) {
  var dataFromServer = $resource(basePath + '/_teacher/moduleManage/getModuleTeachersConsultantList');
  $scope.moduleTeachersConsultantTable = new NgTableParams({'idModule': $stateParams.moduleId}, {
    getData: function (params) {
      return dataFromServer.get(params.url()).$promise.then(function (data) {
        params.total(data.count);
        return data.rows;
      });
    }
  });

  $scope.cancelTeacherRoleAttribute = function (role, attribute, userId, attributeId) {
    roleAttributeService
      .unsetRoleAttribute({
        'attribute': attribute,
        'attributeValue': attributeId,
        'role': role,
        'userId': userId
      })
      .$promise
      .then(function successCallback(response) {
        if (response.data == 'success')
          $scope.moduleTeachersConsultantTable.reload();
        else bootbox.alert("Операцію не вдалося виконати");
      }, function errorCallback(data) {
        console.log(data);
        bootbox.alert("Операцію не вдалося виконати");
      });
  };
}