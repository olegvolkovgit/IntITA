/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('phrasesCtrl', function ($scope){
        initAllPhrasesTable();
    })
    .controller('chatsCtrl', function ($scope, $stateParams){
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

    })
    .controller('searchChatCtrl',function($scope,$state){
        $scope.searchUsers = function(){
            var user_name1 = document.getElementById('chat_user1').value;
            var user_name2 = document.getElementById('chat_user2').value;
            if (user_name1 && user_name2)
                $state.go("tenant/searchchat/:user1/:user2", {user1:user_name1, user2:user_name2}, {inherit:false});
        }

    })
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