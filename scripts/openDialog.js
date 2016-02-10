/**
 * Created by Wizlight on 25.07.2015.
 */
function openSignIn(){
    $("#authDialog").dialog("open");
    if ($("#hambMenu").is(':visible'))
        $("#hambMenu").css({display: "none"});
    return false;
}
function openForgotpass(mode){
    $("#forgotpass").dialog("open");
    if(mode=="fromDialog") $('#toRegistration').attr('for','signUpModeDialog');
    else if(mode=="fromForm") $('#toRegistration').attr('for','signUpMode');
    return false;
}
function openChangePasswordDialog(){
    $("#changePasswordDialog").dialog("open");
    return false;
}
function openChangeemail(){
    $("#changeemail").dialog("open");
    return false;
}
function closeAndReg(){
    $('#forgotpass').dialog('close');
}