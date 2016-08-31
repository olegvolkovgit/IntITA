/**
 * Created by adm on 28.08.2016.
 */
angular
    .module('teacherApp')
    .controller('freelecturesCtrl',freelecturesCtrl);

function freelecturesCtrl ($scope, $resource, NgTableParams,$state, $http){
    angular.element(document.querySelector("#pageTitle")).text("Безкоштовні заняття");

    $scope.search= null;
    $scope.cols = [
        { title: "module", headerTitle: "Модуль", show: true},
        { title: "order", headerTitle: "Порядок у модулі", show: true },
        { title: "title", headerTitle: "Назва", show: true },
        { title: "type", headerTitle: "Тип заняття", show: true },
        { title: "status", headerTitle: "Статус", show: true },
        { title: "changeStatus", headerTitle: "Змінити статус", show: true }
    ];

    var dataFromServer = $resource(basePath+"/_teacher/_admin/freeLectures/getFreeLecturesList");
    $scope.tableParams = new NgTableParams({
        page: 1,
        count: 10,
        sorting:{'module.title_ua':"asc"}}, {
        getData: function(params) {
            return dataFromServer.get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.searchLectures = function(){
        $scope.tableParams = new NgTableParams({
            page: 1,
            count: 10,
            searchCondition: $scope.search}, {
            getData: function(params) {
                // ajax request to api
                return dataFromServer.get(params.url()).$promise.then(function(data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });
    };

    $scope.changeStatus = function(row){
        var url;
        if(row.isFree==1)
            url=basePath+'/_teacher/_admin/freeLectures/setPaidLessons/id/'+row.id;
        else
            url=basePath+'/_teacher/_admin/freeLectures/setFreeLessons/id/'+row.id;
      bootbox.confirm('Змінити статус лекції,',function(result){
          if(result){
              $http({
                  method:'POST',
                  url:url
              }).success(function(){
                  bootbox.alert('Операцію успішно виконано');
                  $scope.tableParams.reload();
              }).error(function(){
                  bootbox.alert('Операцію не вдалося виконати');
              })

          }
          else
              bootbox.alert('Операцію відмінено');
      })
    };

    //initFreeLectures();
}
