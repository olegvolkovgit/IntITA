/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('phrasesCtrl',phrasesCtrl)
    .controller('tenantCtrl',tenantCtrl)
    .controller('chatsCtrl',chatsCtrl)
    .controller('tenantChatsCtrl',phrasesCtrl)
    .controller('showChatCtrl',function($stateParams){
        $jq('#allChatsTable').DataTable({
            "autoWidth": false,
            "ajax": {
                "url": basePath + "/_teacher/_tenant/tenant/FindChats?user1="+$stateParams.user1+"&user2="+$stateParams.user2,
                "dataSrc": "data"
            },
            "columns": [
                {
                    "data": "name",
                    "render": function (name) {
                        return '<a href="#" onclick="load(\''+basePath+'/_teacher/_tenant/tenant/FindChat?id=' +  name['id'] + '\');">'+name['title']+'</a>';
                    }
                },
                {"data": "button",
                    "render": function () {
                        return '<a href="#" onclick="load();">Відправити на пошту</a>';
                    }
                }
            ],
            "createdRow": function (row, data, index) {
                $jq(row).addClass('gradeX');
            },
            language: {
                "url": basePath+"/scripts/cabinet/Ukranian.json",
            },
            processing : true,
        });
    });

function tenantCtrl($scope, typeAhead, $state){

    var tenantTypeaheadUrl = basePath + '/_teacher/_tenant/tenant/getCharUsersByQuery';

    $scope.getUser = function(value){
        return typeAhead.getData(tenantTypeaheadUrl,{query : value})
    };
    $scope.author = "";
    $scope.user ="";
    $scope.selectAuthor = function($item)
    {
        $scope.author = $item;
        console.log($scope.author);
    };

    $scope.selectUser = function($item)
    {
        $scope.user = $item;
        console.log($scope.author);
    };

    $scope.searchChat = function(){
        $state.go("tenant/searchchat/:user1/:user2", {user1:$scope.author.id, user2:$scope.user.id}, {inherit:false});
    };

    $scope.reset = function(){
        $scope.userSelected = "";
        $scope.authorSelected = "";
        $scope.author = "";
        $scope.user ="";
    };

}

function chatsCtrl ($scope, NgTableParams, $stateParams, $resource){
    $scope.chatsTable = new NgTableParams({
        author:$stateParams.user1,
        user:$stateParams.user2
    }, {
        getData: function(params) {
            return $resource(basePath+"/_teacher/_tenant/tenant/findChats").get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });
}

function phrasesCtrl ($scope, NgTableParams, $resource, $state){
    //initAllPhrasesTable();
    $scope.phrasesTable = new NgTableParams({
    }, {
        getData: function(params) {
            return $resource(basePath+"/_teacher/_tenant/tenant/getAllPhrases").get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.editPhrase = function(phraseId){
        console.log(phraseId)
    };

    $scope.deletePhrase = function(phraseId){

    }

    $scope.addPhrase = function(phraseId){
        $state.go()
    }

}