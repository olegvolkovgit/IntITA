/**
 * Created by Wizlight on 19.05.2016.
 */

function openForgotpass(mode){
    $jq("#forgotpass").dialog("open");
    if(mode=="fromDialog") $jq('#toRegistration').attr('for','signUpModeDialog');
    else if(mode=="fromForm") $jq('#toRegistration').attr('for','signUpMode');
    return false;
}
function closeAndReg(){
    $jq('#forgotpass').dialog('close');
}