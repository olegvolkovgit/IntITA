<?php
$host = "localhost";
$database="int_ita_db";
$user = "intita";
$password = "1234567";
if(!mysql_connect($host,$user,$password))
    die('Не удалось подключиться к серверу MySql!');
elseif(!mysql_select_db($database))
    die('Не удалось выбрать БД!');
session_start();
$id = (int)$_SESSION['8eee65c9aae96d768a096ddf87b0e43c__id'];
if ($id) {
    $sql = "SELECT firstName, secondName, email, reg_time FROM `user` WHERE id=".$id.";";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $name = $row['firstName'].' '.$row['secondName'];
    if ($name==" ") $name = $row['email'];
    $regTime = $row['reg_time'];
    if ($regTime == 0) $regTime = time();
    $user_lang = "uk";
    if($_SESSION['current_language']) {
        $user_lang = $_SESSION['current_language'];
    }
    $sql1 = "SELECT user_id FROM phpbb_users WHERE user_id=".$id.";";
    $result1 = mysql_query($sql1);
    if (mysql_num_rows($result1)==0) {
        $sql2 = "INSERT INTO phpbb_users (user_id, username, username_clean, user_timezone, user_dateformat, user_regdate, user_lang)
          VALUES ('".$id."', '".$name."', '".$name."', 'Europe/Kiev', 'd M Y H:i', ".$regTime.", '".$user_lang."');";
        $result2 = mysql_query($sql2);
        $sql3 = "INSERT INTO phpbb_user_group (group_id, user_id, group_leader, user_pending) VALUES (2, ".$id.", 0, 0);";
        $result3 = mysql_query ($sql3);
    }else{
        mysql_query("UPDATE phpbb_users SET user_lang = '" . $user_lang . "' WHERE user_id =" . $id . ";");
    }
    setcookie("user_id_transition", $id, time() + 3600, "/");
    $sql4 = "DELETE FROM phpbb_sessions WHERE session_user_id=1";
    $result4 = mysql_query($sql4);
}
mysql_close();
echo $id;