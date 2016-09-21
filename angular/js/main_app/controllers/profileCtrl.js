/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('profileCtrl',profileCtrl);

function profileCtrl($http,$scope) {
    $scope.getProfileData=function (userId) {
        var promise = $http({
            url: basePath+'/studentreg/getProfileData',
            method: "POST",
            data: $.param({id: userId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getProfileData(userId).then(function (response) {
        $scope.profileData=response;
        if(response.interests) $scope.interests=response.interests.split(',');
        var networksArr=[
            [$scope.profileData.facebook, 'Facebook'],
            [$scope.profileData.googleplus, 'Googleplus'],
            [$scope.profileData.linkedin, 'Linkedin'],
            [$scope.profileData.vkontakte, 'Vkontakte'],
            [$scope.profileData.twitter, 'Twitter']
        ];
        $scope.networks=[];
        for (var i = 0; i < networksArr.length; i++) {
            if (networksArr[i][0]) {
                $scope.networks.push(networksArr[i]);
            }
        }
    });

    var msgShow, msgHide;
    switch (lang) {
        case 'ua':
            msgShow='Розгорнути';
            msgHide='Згорнути';
            break;
        case 'ru':
            msgShow='Развернуть';
            msgHide='Свернуть';
            break;
        case 'en':
            msgShow='Show more';
            msgHide='Hide';
            break;
        default:
            msgShow='Розгорнути';
            msgHide='Згорнути';
            break;
    }
    $scope.spoilerTitle=msgShow;
    $scope.spoilerTitleMini=msgShow;
    $scope.spoiler=function (el,spoiler) {
        if ($('#'+el).css('display')=='none') {
            if(spoiler=='mini'){
                $scope.spoilerTitleMini=msgHide;
                $('#trg1').text("\u25B2");
            } else {
                $scope.spoilerTitle=msgHide;
                $('#trg2').text("\u25B2");
            }
        }
        if($('#'+el).css('display')=='block'){
            if(spoiler=='mini'){
                $scope.spoilerTitleMini=msgShow;
                $('#trg1').text("\u25BC");
            } else {
                $scope.spoilerTitle=msgShow;
                $('#trg2').text("\u25BC");
            }
        }
        $('#'+el).toggle('normal');
        return false;
    }
}