/**
 * Created by Wizlight on 19.05.2016.
 */
function openForgotpass(mode){
    $("#forgotpass").dialog("open");
    if(mode=="fromDialog") $('#toRegistration').attr('for','signUpModeDialog');
    else if(mode=="fromForm") $('#toRegistration').attr('for','signUpMode');
    return false;
}
function closeAndReg(){
    $('#forgotpass').dialog('close');
}