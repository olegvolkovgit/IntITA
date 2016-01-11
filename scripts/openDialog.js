/**
 * Created by Wizlight on 25.07.2015.
 */
function openSignIn(){
    $("#authDialog").dialog("open");
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