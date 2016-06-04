/**
 * Created by Wizlight on 31.05.2016.
 */
angular
    .module('revisionSendMessage',[])
    .service('revisionMessage', [
        '$http',
        function($http) {
            var self = this;
            self.sendMessage = function(idRevision) {
                $http({
                    url: basePath+'/revision/getDataForRevisionMail',
                    method: "POST",
                    data: $.param({idRevision: idRevision}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    bootbox.dialog({
                            title: "Надіслати листа автору ревізії: "+response.data.authorName,
                            message:
                            '<div class="panel-body">'+
                            '<div class="row">'+
                            '<form role="form" name="message">'+
                            '<div class="form-group col-md-12">'+
                            '<label>Тема</label>'+
                            '<input value="'+response.data.theme+'" class="form-control" name="subject" id="subject" placeholder="Тема листа">'+
                            '</div>'+
                            '<div class="form-group col-md-12">'+
                            '<label>Лист</label>'+
                            '<textarea class="form-control" style="resize: none" rows="6" id="messageText" required>Посилання на ревізію: '+response.data.link+'</textarea>'+
                            '</div>'+
                            '</form>'+
                            '</div>'+
                            '</div>',
                            buttons: {
                                success: {
                                    label: "Надіслати",
                                    className: "btn btn-primary",
                                    callback: function () {
                                        var subject = $('#subject').val();
                                        var text = $('#messageText').val();
                                        if(text.trim()==''){
                                            bootbox.alert('Тіло листа не може бути пустим');
                                        }else{
                                            var receiverId=response.data.authorId;
                                            self.send(subject,text,receiverId);
                                        }
                                    }
                                },
                                cancel: {
                                    label: "Скасувати",
                                    className: "btn btn-default",
                                    callback: function () {
                                    }
                                }
                            }
                        }
                    );
                }, function errorCallback() {
                    bootbox.alert("Завантажити дані отримувача листа не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
            };

            self.send = function(subject,text,receiverId) {
                $http({
                    url: basePath+'/_teacher/messages/sendUserMessage',
                    method: "POST",
                    data: $.param({subject: subject,text: text,receiver: receiverId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data=="success")
                        bootbox.alert("Лист успішно відправлено");
                }, function errorCallback() {
                    bootbox.alert("Відправити лист не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
            }
        }
    ]);