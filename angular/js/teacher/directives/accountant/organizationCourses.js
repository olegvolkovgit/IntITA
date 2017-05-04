"use strict";

angular
  .module('teacherApp')
  .directive('organizationCourses', [
    'ngToast',
    'organizationService',
    'companiesService',
    organizationCourses]);

function organizationCourses(ngToast, organizationService, companiesService) {
  function link($scope, element, attrs) {

    loadData();

    $scope.bindToCompany = function (item, educationForm) {
      var type = item.type,
        id = type === 'course' ? item.course_ID : item.module_ID;
      return companiesService
        .bindService({
          type: type,
          id: id,
          educationForm: educationForm,
          companyId: $scope.companyId
        })
        .$promise
        .then(function () {
          loadData();
        })
        .catch(function (error) {
          console.error(error);
          dangerToast('Виникла помилка');
        })
    };

    function loadData() {
      organizationService
        .coursesAndModules()
        .$promise
        .then(function ($response) {
          $scope.data = $response;
        })
        .catch(function () {
          dangerToast('Помилка завантаження данних')
        });
    }

    function toast(type, message) {
      ngToast.create({
        dismissOnTimeout: true,
        dismissButton: true,
        className: type,
        content: message
      });
    }

    function dangerToast(message) {
      toast('danger', message);
    }

    function successToast(message) {
      toast('success', message);
    }

  }

  return {
    scope: {
      'companyId': '=companyId',
      'organizationId' : '=organizationId'
    },
    link: link,
    templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/organizationCourses.html'
  }
}