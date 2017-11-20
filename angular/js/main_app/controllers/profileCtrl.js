/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('profileCtrl',profileCtrl);

function profileCtrl($http, $scope, FileUploader) {
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
            // [$scope.profileData.vkontakte, 'Vkontakte'],
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

    $scope.getProgressData=function (userId) {
        var promise = $http({
            url: basePath+'/studentreg/getProgressData',
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
    $scope.getProgressData(userId).then(function (response) {
        $scope.determinColorSheme(response.count_total_cell, response.count_full_cell);
    });
    $scope.determinColorSheme = function(total, full_cell) {
        var counter = $scope.percentDefinition(total, full_cell);
        var lineProgress = document.getElementById('lineProgress');
        var i = 0;
        j = 0;
        var count = 0;

        for(i; i<10; i++)
        {
            var ul = document.createElement('ul');

            for (j; j < 10; j++) {
                count++;
                var li = document.createElement('li');
                li.appendChild(document.createTextNode(' '));
                ul.appendChild(li);
                if(count > counter) {
                    li.style.background = '#d9e4ee';
                }
            }
            j = 0;
            lineProgress.insertBefore(ul, lineProgress.firstChild);
        }

        var corona = document.getElementsByClassName('corona')[0];
        corona.style.backgroundPositionX = -Math.ceil(counter/10)*25 + 'px';
    }

    $scope.percentDefinition = function(total, full_cell) {

        var progressInPercent = Math.round(full_cell/total*100).toFixed(0);
        var percentProgress = document.getElementById('percentProgress');
        percentProgress.innerHTML = progressInPercent;
        return progressInPercent;
    }

    $scope.addReview = function () {
        $http({
            url: basePath+'/studentreg/addReview',
            method: "POST",
            data: $.param({review: $scope.profileData.review}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).success(function (response) {
            if (typeof response === 'object'){
                    $scope.errors = response.errors;
            }
        })
    }

    //portfolio request
    $scope.portfolioRequest = function () {
        $http({
            url: basePath+'/studentreg/addReview',
            method: "POST",
            data: $.param({review: $scope.profileData.review}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).success(function (response) {
            if (typeof response === 'object'){
                $scope.errors = response.errors;
            }
        })
    }


    //documents
    var fileUploader = $scope.fileUploader = new FileUploader({
        url: basePath+'/studentreg/uploadPortfolio',
        removeAfterUpload: true
    });
    fileUploader.onCompleteAll = function() {
        $scope.loadPortfolioFiles();
    };
    fileUploader.onErrorItem = function(item, response, status, headers) {
        if(status==500)
            bootbox.alert("Виникла помилка при завантажені файлів.");
    };

    fileUploader.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|javascript|jpg|png|jpeg|bmp|gif|html|css|'.indexOf(type) !== -1;
        }
    });

    fileUploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };

    $scope.loadPortfolioFiles=function () {
        $http({
            url: basePath + "/studentreg/getAllPortfolioFiles",
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.portfolioFiles = response.data;
        }, function errorCallback() {
            bootbox.alert("Виникла помилка при завантажені файлів");
        });
    };
    $scope.loadPortfolioFiles();

    $scope.removePortfolioFile=function (id) {
        bootbox.confirm('Видалити файл?', function(result) {
            if(result)
                $http({
                    url: basePath + "/studentreg/removePortfolioFile",
                    method: "POST",
                    data: $.param({id: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    $scope.loadPortfolioFiles();
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при видалені документу.");
                });
        });
    }




}