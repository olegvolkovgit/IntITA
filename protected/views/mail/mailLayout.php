<?php
/* @var $content
 * @var $userEmail
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/html">
<head>
</head>
<body>
<div class="container" style="width:100%; background-color: #ebebeb">
    <div class="contant"  style="width:600px;margin:0 auto; padding-top:30px;">
        <table border="0" bgcolor="#ffffff" width="100%"">
        <tr>
            <td width="60px;"></td>
            <td ><img id="logo"
                      src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small.png'); ?>"
                      alt="" border="0" width="150" style="display:block;"/></td>
            <td width="60px;"></td>
        </tr>
        </table>
        <table border="0" bgcolor="#4b75a4" width="100%"">
        <tr>
            <td width=" 60px;"></td>
            <td width=" 480px;></td>
                <td width=" 60px;"></td>
        </tr>
        </table>
        <table border="0" bgcolor="#ffffff" width="100%"">
        <tr>
            <td width="60px;"></td>
            <td width="480px; " height="200px;" >
                <br> <?=$content;?></td>
            <td width="60px;"></td>
        </tr>
        <tr>
            <td width="60px;"></td>
            <td style=" border-top:1px solid #7F7F7F;padding-top: 10px;">З повагою,<br>
                <a href="<?=Config::getBaseUrl();?>" style="color: #4b75a4; font: 18px Arial, sans-serif; line-height: 12px; -webkit-text-size-adjust:none; display: block;" target="_blank"><?=Config::getBaseUrl();?></a><br>
                <span style="color: #333333; font: 10px Arial, sans-serif; line-height: 10px; -webkit-text-size-adjust:none; display: block;"> телефон: +38 0432 52 82 67.</span>
                <span style="color: #333333; font: 10px Arial, sans-serif; line-height: 10px; -webkit-text-size-adjust:none; display: block;">тел. моб. +38 067 431 20 10.</span>
                <span style="color: #333333; font: 10px Arial, sans-serif; line-height: 10px; -webkit-text-size-adjust:none; display: block;"> ел. пошта:<a href="mailto:intita.hr@gmail.com." target="_blank" style=""> intita.hr@gmail.com.</a>.</span>
                <span style="color: #333333; font: 10px Arial, sans-serif; line-height: 10px; -webkit-text-size-adjust:none; display: block; padding-bottom:20px;">skype: int.ita</span></td>
            <td width="60px;"></td>
        </tr>
        </table>

        <table border="0" bgcolor="#ebebeb" width="100%"">
        <tr bgcolor="#ebebeb">
            <td width="60px;" style="border-color:#ebebeb"></td>
            <td  style="border-color:#ebebeb">
                <br>
                <span style="color: #7F7F7F; font-family:Arial, sans-serif; font-size: 12px; line-height: 20px; -webkit-text-size-adjust:none; display: block;">Ви отримали це повідомлення, так як адреса <a href="mailto:<?=$userEmail?>" target="_blank" style=""><?=$userEmail?></a> пов'язана з обліковим записом, зареєстрованим на <?=Config::getBaseUrl();?>.</span><br>
                <span style="color: #7F7F7F; font-family:Arial, sans-serif; font-size: 12px; line-height: 10px; -webkit-text-size-adjust:none; display: block;"><i>Copyright © 2016 Intita. Всі права захищені.</i></span>
                <br>
            </td>
            <td width="60px;"style="border-color:#ebebeb"></td>
        </tr>
        <tr bgcolor="#ebebeb">
            <td width="60px;" height="30px;"></td>
            <td></td>
            <td width="60px;"></td>
        </tr>
        </table>
    </div>
</div>
</body>
</html>