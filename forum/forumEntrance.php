<?php
$host = "localhost";
$db_1 = "forum";
$db_2 = "intita";
$user = "intita";
$password = "1234567";

$dbc = mysql_connect($host,$user,$password);

session_start();

$id = 0;

foreach ($_SESSION as $key => $value){
    if (strpos($key, '__id')) {
        $id = $value;
        break;
    }
}

if ($id) {
    $sql = "SELECT firstName, secondName, email, reg_time FROM $db_2.`user` WHERE id=".$id.";";
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
    $sql1 = "SELECT user_id FROM $db_1.phpbb_users WHERE user_id=".$id.";";
    $result1 = mysql_query($sql1);
    if (mysql_num_rows($result1)==0) {
        $sql2 = "INSERT INTO $db_1.phpbb_users (user_id, username, username_clean, user_timezone, user_dateformat, user_regdate, user_lang)
          VALUES ('".$id."', '".$name."', '".$name."', 'Europe/Kiev', 'd M Y H:i', ".$regTime.", '".$user_lang."');";
        $result2 = mysql_query($sql2);
        $sql3 = "INSERT INTO $db_1.phpbb_user_group (group_id, user_id, group_leader, user_pending) VALUES (2, ".$id.", 0, 0);";
        $result3 = mysql_query ($sql3);
    }else{
        mysql_query("UPDATE $db_1.phpbb_users SET user_lang = '" . $user_lang . "' WHERE user_id =" . $id . ";");
    }
    setcookie("user_id_transition", $id, time() + 3600, "/");
    $sql4 = "DELETE FROM $db_1.phpbb_sessions WHERE session_user_id=1";
    $result4 = mysql_query($sql4);
}
mysql_close();
echo $id;