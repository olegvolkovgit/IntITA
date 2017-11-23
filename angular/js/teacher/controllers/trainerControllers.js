/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('trainerStudentsCtrl', trainerStudentsCtrl)
    .controller('trainersStudentViewCtrl', trainersStudentViewCtrl)
    .controller('trainerCtrl', trainerCtrl)
    .controller('personalInfoCtrl', personalInfoCtrl)
    .controller('careerStudentsCtrl', careerStudentsCtrl)
    .controller('contractStudentsCtrl', contractStudentsCtrl)
    .controller('studentsProjectsCtrl', studentsProjectsCtrl)
    .controller('visitInfoCtrl', visitInfoCtrl)
    .factory('myFactory', myFactory);

function myFactory() {
    return {
        careerTbl: '',
        visitTbl: ''
    }
}


function trainerStudentsCtrl($scope, trainerService, NgTableParams){
    $scope.changePageHeader('Закріплені студенти');
    $scope.trainersStudentsTableParams = new NgTableParams({
        sorting: {
            "start_time": 'desc'
        },
    }, {
        getData: function (params) {
            return trainerService
                .trainersStudentsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });   
}

function trainersStudentViewCtrl($scope, trainerService, NgTableParams){
    $scope.trainersStudentsTableParams = new NgTableParams({
        sorting: {
            "start_time": 'desc'
        },
    }, {
        getData: function (params) {
            return trainerService
                .trainersStudentsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}


function trainerCtrl($scope, $state, trainerService, usersService, lodash, myFactory) {
    $scope.changePageHeader('Тренер');
    $scope.myFactory = myFactory;

    $scope.tabs = [
        { title: "Закріплені студенти", route: "trainerStudents"},
        { title: "Особиста інформація", route: "personalInfo"},
        { title: "Кар'єра", route: "career"},
        { title: "Договір", route: "contract"},
        { title: "Відвідування", route: "visit"},
        { title: "Проекти", route: "studentsProjects"}
    ];

    $scope.tabs.forEach(function(item, i) {
        if('trainer/students.'+item.route==$state.current.name) {
            $scope.active=i;
        }
    });

    $scope.educationForm = trainerService
        .getEducationForm()
        .$promise
        .then(
            function (data) {
                var result = data;
                $scope.educForm = [];
                $scope.educForm = $scope.educForm.concat(result);
                return $scope.educForm;
            }
        )
        .catch(function() {
            bootbox.alert('Помилка, зверніться до адміністратора');
        });

    $scope.educationTime = trainerService
        .getEducationTime()
        .$promise
        .then(function (data) {
            var result = data;
            $scope.educTime = [];
            $scope.educTime = $scope.educTime.concat(result);
            return $scope.educTime;
        })
        .catch(function () {
            bootbox.alert('Помилка, зверніться до адміністратора');
        });

    $scope.groupsNames = trainerService
        .getGroupNumber()
        .$promise
        .then(function (data) {
                var res = data;
                $scope.temp = [];
                $scope.temp = $scope.temp.concat(res);
                return $scope.temp;
            })
        .catch(function () {
            bootbox.alert('Помилка, зверніться до адміністратора');
        });

    $scope.studyOption = function (id, id_user) {

        var online = 'онлайн',  // id=1
            offline = 'офлайн',  // id=2
            on_off_line = 'онлайн/офлайн';  // id=3

        setTimeout(function () {
            $jq('#formOption :input').filter(function(){return this.value == id}).attr('checked', true);
        }, 50);

        bootbox.dialog({
            title: "Виберіть нове значення.",
            message: '<div class="row">  ' +
            '<div class="col-md-12"> ' +
            '<form id="formOption" class="form-horizontal"> ' +
            '<div class="form-group"> ' +
            '<div class="col-md-offset-4 col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-0" value="1"> '+ online +' </label> ' +
            '</div><div class="radio"> <label for="awesomeness-1"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-1" value="2">'+ offline +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="3">'+ on_off_line +'</label> ' +
            '</div> ' +
            '</div> ' +
            '</div> ' +
            '</form> </div>  </div>',
            buttons: {
                success: {
                    label: "Зберегти",
                    className: "btn-success",
                    callback: function () {
                        // var name = $jq('#name').val();
                        var answer = $jq("input[name='awesomeness']:checked").val();
                        if(answer != undefined){
                            trainerService
                                .changeFormStudy({'id_study_form': answer, 'id_student': id_user})
                                .$promise
                                .then(
                                    function(){

                                        if($scope.myFactory.careerTbl){
                                            $scope.myFactory.careerTbl.reload();
                                        }
                                        if($scope.myFactory.visitTbl){
                                            $scope.myFactory.visitTbl.reload();
                                        }
                                    },
                                    function () {
                                        console.log(error);
                                    }
                                )
                        }
                    }
                }
            }
        });
    };

    $scope.studyTime = function (id_study_time, id_student) {

        var morning = 'ранкова',
            evening = 'вечірня',
            whatever = 'байдуже';

        setTimeout(function(){
            $jq('#timeOption :input').filter(function(){return this.value == id_study_time}).attr('checked', true);
        }, 50);

        bootbox.dialog({
            title: "Виберіть нове значення.",
            message: '<div class="row">  ' +
            '<div class="col-md-12"> ' +
            '<form id="timeOption" class="form-horizontal"> ' +
            '<div class="form-group"> ' +
            '<div class="col-md-offset-4 col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-0" value="1"> '+ morning +' </label> ' +
            '</div><div class="radio"> <label for="awesomeness-1"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-1" value="2">'+ evening +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="3">'+ whatever +'</label> ' +
            '</div> ' +
            '</div> ' +
            '</div> ' +
            '</form> </div>  </div>',
            buttons: {
                success: {
                    label: "Зберегти",
                    className: "btn-success",
                    callback: function () {
                        // var name = $jq('#name').val();
                        var answer = $jq("input[name='awesomeness']:checked").val();
                        if(answer != undefined){
                            trainerService
                                .changeTimeStudy({'id_time_form': answer, 'id_student': id_student})
                                .$promise
                                .then(
                                    function(){
                                        if($scope.myFactory.careerTbl){
                                            $scope.myFactory.careerTbl.reload();
                                        }
                                        if($scope.myFactory.visitTbl){
                                            $scope.myFactory.visitTbl.reload();
                                        }
                                    },
                                    function (error) {
                                        console.log(error);
                                    }
                                )
                        }
                    }
                }
            }
        });
    };
}


function personalInfoCtrl($scope, trainerService, NgTableParams) {
    $scope.changePageHeader('Особиста інформація');

    $scope.studentPersonalInfoTableParams = new NgTableParams({},
        {
            getData: function (params) {
                return trainerService
                    .studentsPersonalInfo(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
    $scope.updateStudentInfo = function (id_student, attr, text) {
        text=text?text:'';
        bootbox.dialog({
                title: "Введіть нову назву:",
                message: '<div class="panel-body"><div class="row"><form role="form" name="commentMessage"><div class="form-group col-md-12">'+
                '<textarea class="form-control" style="resize: none" rows="6" id="commentMessageText" ' +
                'placeholder="тут можна ввести нову назву поля">' +text+ '</textarea>'+'</div></form></div></div>',
                buttons:
                    {success:
                        {label: "Підтвердити", className: "btn btn-primary",
                            callback: function () {
                                var data = $jq('#commentMessageText').val();
                                trainerService.updateStudentData({id_student: id_student, data: data, attr: attr})
                                    .$promise
                                    .then(function(){
                                        $scope.studentPersonalInfoTableParams.reload();
                                });
                            }
                },
                    cancel:
                        {label: "Скасувати", className: "btn btn-default",
                            callback: function () {
                            }
                    }
                }
            }
        );
    }
}


function careerStudentsCtrl($scope, trainerService, NgTableParams, myFactory) {
    $scope.changePageHeader("Кар'єра");
    $scope.myFactory = myFactory;

    $scope.studentsSpecializations = trainerService
        .getSpecializationGroup()
        .$promise
        .then(function (data) {
            var result = data;
            $scope.studentSpec = [{id:'0', title:'Всі студенти'}];
            $scope.studentSpec = $scope.studentSpec.concat(result);
            return $scope.studentSpec;
        })
        .catch(function() {
            bootbox.alert('Помилка, зверніться до адміністратора');
        });

    $scope.payForm = trainerService
        .getPayForm()
        .$promise
        .then(function (data) {
            var result = data;
            $scope.pay_form = [];
            $scope.pay_form = $scope.pay_form.concat(result);
            return $scope.pay_form;
        })
        .catch(function () {
            bootbox.alert('Помилка, зверніться до адміністратора');
        });

    $scope.studentCareerInfoTableParams = new NgTableParams({filter:{'specializations.id':'null'}},
        {
            getData: function (params) {
                return trainerService
                    .studentsCareerInfo(params.url())
                    .$promise
                    .then(function (data) {
                        $scope.specOfStudents = [];

                        for(var item in data.rows){
                            if(!$scope.isEmpty(data.rows[item].specializations)){
                                var specs = data.rows[item].specializations;
                                var temp_arr = [];
                                for(var i in specs){
                                    temp_arr.push(specs[i].id);
                                }
                                var temp_obj = {
                                    id_student: data.rows[item].id_student,
                                    value_spec: temp_arr
                                };
                                $scope.specOfStudents.push(temp_obj);
                            }
                        }
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
    $scope.myFactory.careerTbl = $scope.studentCareerInfoTableParams;

    $scope.updateCareerInfo = function (id_student, attr, text) {
        text=text?text:'';
        bootbox.dialog({
                title: "Введіть нову назву:",
                message: '<div class="panel-body"><div class="row"><form role="form" name="commentMessage"><div class="form-group col-md-12">'+
                '<textarea class="form-control" style="resize: none" rows="6" id="commentMessageText" ' +
                'placeholder="тут можна ввести нову назву поля">' +text+ '</textarea>'+'</div></form></div></div>',
                buttons:
                    {success:
                        {label: "Підтвердити", className: "btn btn-primary",
                            callback: function () {
                                var data = $jq('#commentMessageText').val();
                                trainerService.updateStudentData({id_student: id_student, data: data, attr: attr})
                                    .$promise
                                    .then(function(){
                                        $scope.studentCareerInfoTableParams.reload();
                                    });
                            }
                        },
                        cancel:
                            {label: "Скасувати", className: "btn btn-default",
                                callback: function () {
                                }
                            }
                    }
            }
        );
    };

    $scope.isEmpty = function (obj){
        if (!obj){
            return true;
        }

        if (!(typeof(obj) === 'number') && !Object.keys(obj).length){
            return true;
        }

        return false;
    };

    $scope.checkArrays = function ( arrA, arrB ){

        //check if lengths are different
        if(arrA == null || arrA.length !== arrB.length) return false;

        //slice so we do not effect the original
        //sort makes sure they are in order
        //join makes it a string so we can do a string compare
        var cA = arrA.slice().sort().join(",");
        var cB = arrB.slice().sort().join(",");

        return cA===cB;
    };

    $scope.selectSpecialization = function(id, id_student, hasValue){
        $scope.optionValue = [];

        if(hasValue){
            $scope.checked_value = [];
        }

        for(var i in $scope.specOfStudents){
            if($scope.specOfStudents[i].id_student == id_student){
                $scope.checked_value = $scope.specOfStudents[i].value_spec;

            }
        }
        
        for(var i=2; i<$scope.studentSpec.length; i++){
            var temp = {
                text: $scope.studentSpec[i].title,
                value: $scope.studentSpec[i].id
            };
            $scope.optionValue.push(temp);
        }

        bootbox.prompt({
            title: "Виберіть нові значення:",
            value: $scope.checked_value,
            inputType: 'checkbox',
            inputOptions: $scope.optionValue,
            callback: function (result) {
                if(!$scope.checkArrays(result, $scope.checked_value) && result != null){
                    
                    $scope.checked_value = [];
                    var results = [];
                    result.splice(0, 0, id);
                    results.push(result);

                    trainerService
                        .updateSpecialization({data: results})
                        .$promise
                        .then(
                            function () {
                                $scope.studentCareerInfoTableParams.reload();
                            },
                            function () {
                                console.error(error);
                            }
                        )
                }
            }
        });
    };

    $scope.changePayForm = function(id_student, pay_id){

        setTimeout(function(){
            $jq('#payOption :input').filter(function(){return this.value == pay_id}).attr('checked', true);
        }, 50);

        bootbox.dialog({
            title: "Виберіть нове значення.",
            message: '<div class="row">  ' +
            '<div class="col-md-12"> ' +
            '<form id="payOption" class="form-horizontal"> ' +
            '<div class="form-group"> ' +
            '<div class="col-md-offset-4 col-md-4"> <div class="radio" > <label for="awesomeness-0"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-0" value="1"> '+$scope.pay_form[1].title+' </label> ' +
            '</div><div class="radio"> <label for="awesomeness-1"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-1" value="2">'+ $scope.pay_form[2].title +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="3">'+ $scope.pay_form[3].title +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="4">'+ $scope.pay_form[4].title +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="6">'+ $scope.pay_form[5].title +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="12">'+ $scope.pay_form[6].title +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="24">'+ $scope.pay_form[7].title +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="36">'+ $scope.pay_form[8].title +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="48">'+ $scope.pay_form[9].title +'</label> ' +
            '</div><div class="radio"> <label for="awesomeness-2"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-2" value="60">'+ $scope.pay_form[10].title +'</label> ' +
            '</div> ' +
            '</div> ' +
            '</div> ' +
            '</form> </div>  </div>',
            buttons: {
                success: {
                    label: "Зберегти",
                    className: "btn-success",
                    callback: function () {
                        var answer = $jq("input[name='awesomeness']:checked").val();
                        if(answer != undefined){
                            trainerService
                                .changePayForm({'id_pay': answer, 'id_student': id_student})
                                .$promise
                                .then(
                                    function(){
                                        $scope.studentCareerInfoTableParams.reload();
                                    },
                                    function (error) {
                                        console.log(error);
                                    }
                                )
                        }
                    }
                }
            }
        });
    }
}


function contractStudentsCtrl($scope, trainerService, NgTableParams) {
    $scope.changePageHeader("Договір");

    $scope.studentContractInfoTableParams = new NgTableParams({},
        {
            getData: function (params) {
                return trainerService
                    .studentContractInfo(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    })
            }
        });

    $scope.updateContractInfo = function (id_student, attr, text) {
        text = text?text:'';
        bootbox.dialog({
                title: "Введіть нову назву:",
                message: '<div class="panel-body"><div class="row"><form role="form" name="commentMessage"><div class="form-group col-md-12">'+
                '<textarea class="form-control" style="resize: none" rows="6" id="commentMessageText" ' +
                'placeholder="тут можна ввести нову назву поля">' +text+ '</textarea>'+'</div></form></div></div>',
                buttons:
                    {success:
                        {label: "Підтвердити", className: "btn btn-primary",
                            callback: function () {
                                var data = $jq('#commentMessageText').val();
                                trainerService.updateStudentData({id_student: id_student, data: data, attr: attr})
                                    .$promise
                                    .then(function(){
                                        $scope.studentContractInfoTableParams.reload();
                                    });
                            }
                        },
                        cancel:
                            {label: "Скасувати", className: "btn btn-default",
                                callback: function () {
                                }
                            }
                    }
            }
        );
    }
}


function visitInfoCtrl($scope, trainerService, NgTableParams, myFactory) {
    $scope.changePageHeader("Відвідування");
    $scope.myFactory = myFactory;

    $scope.studentVisitInfoTableParams = new NgTableParams({},
        {
            getData: function (params) {
                return trainerService
                    .studentVisitInfo(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    })
            }
        });
    $scope.myFactory.visitTbl = $scope.studentVisitInfoTableParams;

    $scope.updateVisitInfo = function (id_student, attr, text) {
        text=text?text:'';
        bootbox.dialog({
                title: "Введіть нову назву:",
                message: '<div class="panel-body"><div class="row"><form role="form" name="commentMessage"><div class="form-group col-md-12">'+
                '<textarea class="form-control" style="resize: none" rows="6" id="commentMessageText" ' +
                'placeholder="тут можна ввести нову назву поля">' +text+ '</textarea>'+'</div></form></div></div>',
                buttons:
                    {success:
                        {label: "Підтвердити", className: "btn btn-primary",
                            callback: function () {
                                var data = $jq('#commentMessageText').val();
                                trainerService.updateStudentData({id_student: id_student, data: data, attr: attr})
                                    .$promise
                                    .then(function(){
                                        $scope.studentVisitInfoTableParams.reload();
                                    });
                            }
                        },
                        cancel:
                            {label: "Скасувати", className: "btn btn-default",
                                callback: function () {
                                }
                            }
                    }
            }
        );
    };

    $scope.cancelType = trainerService
        .getCancelType()
        .$promise
        .then(function (data) {
            var temp = data;
            $scope.reason = [];
            $scope.reason = $scope.reason.concat(temp);
            return $scope.reason;
        })
        .catch(function(){
            bootbox.alert('Помилка, зверніться до адміністратора');
        });
}

function studentsProjectsCtrl($scope, NgTableDataService, NgTableParams, $http, $state, $stateParams) {
    NgTableDataService.setUrl(basePath+'/_teacher/_trainer/trainer/getStudentsProjectList');
    $scope.studentProjectTable = new NgTableParams({
        sorting: {
        },
    }, {
        getData: function(params) {
            return NgTableDataService.getData(params.url())
                .then(function (data) {
                    console.log(data);
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.approveProject = function (projectId) {
        bootbox.confirm('Затвердити проект?',function (result) {
            if (result){
                $http({
                    method: 'POST',
                    url: basePath+"/_teacher/_trainer/trainer/approveStudentProject",
                    data: $jq.param({id: projectId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    bootbox.alert(response.message, function () {

                        $scope.studentProjectTable.reload();
                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        })
    }

    $scope.viewProject = function (projectId) {
        bootbox.confirm('Переглянути останню версію проекту?',function (result) {
            if (result){
                $http({
                    method: 'POST',
                    url: basePath+"/_teacher/_trainer/trainer/viewStudentProject",
                    data: $jq.param({id: projectId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    bootbox.alert(response.message, function () {
                            console.log(response);
                        $scope.studentProjectTable.reload();
                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        })
    };

    if ($state.is('studentsProject')){
        $scope.files = $http({
            method:'GET',
            url: basePath+'/_teacher/_trainer/trainer/getProjectFiles/projectId/'+$stateParams.projectId
        }).then(function (response) {
            $scope.files = response.data;
        });

        $scope.getFileContent = function () {
            $http({
                method:'GET',
                url: basePath+'/_teacher/_trainer/trainer/getFileContent'
            }).then(function (response) {
                $scope.file = response.data;
            });
        }

    }

}