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
$id = (int)$_SESSION['ec984fe5e8234fefa59bbddba1d7e202__id'];
if ($id) {
    $sql = "SELECT firstName, secondName, email FROM `user` WHERE id=".$id.";";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $name = $row['firstName'].' '.$row['secondName'];
    if ($name==" ") $name = $row['email'];
    $sql1 = "SELECT user_id FROM phpbb_users WHERE user_id=".$id.";";
    $result1 = mysql_query($sql1);
    if (mysql_num_rows($result1)==0) {
        $sql2 = "INSERT INTO phpbb_users (user_id, username, username_clean, user_timezone, user_dateformat)
          VALUES ('".$id."', '".$name."', '".$name."', 'Europe/Kiev', 'd M Y H:i');";
        $result2 = mysql_query($sql2);
        $sql3 = "INSERT INTO phpbb_user_group (group_id, user_id, group_leader, user_pending) VALUES (2, ".$id.", 0, 0);";
        $result3 = mysql_query ($sql3);
    }
    setcookie("user_id_transition", $id, time() + 3600, "/");
    $sql4 = "DELETE FROM phpbb_sessions WHERE session_user_id=1";
    $result4 = mysql_query($sql4);
}
mysql_close();
echo $id;