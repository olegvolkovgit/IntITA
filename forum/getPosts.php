<?php
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);

$user->setup();

$lecture = request_var('topic', 0);

$sql="SELECT topic_id, forum_id FROM `phpbb_topics` WHERE lecture_id=$lecture";
$result = $db->sql_query($sql);
$information = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

$sql="SELECT p.post_text, p.bbcode_uid, p.bbcode_bitfield, p.post_time, u.username
      FROM `phpbb_posts` p, `phpbb_users` u
      WHERE p.topic_id=".$information['topic_id']." AND u.user_id=p.poster_id";
$result = $db->sql_query($sql);
$posts_array = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);

$information['posts'] = [];

foreach ($posts_array as $post){
    $parse_flags = ($post['bbcode_bitfield'] ? OPTION_FLAG_BBCODE : 0) | OPTION_FLAG_SMILIES;
    array_push($information['posts'], array(
        "text"=>generate_text_for_display($post['post_text'], $post['bbcode_uid'], $post['bbcode_bitfield'],
            $parse_flags, true),
        "author"=>$post['username'],
        "date"=>$user->format_date($post['post_time'])
    ));
}

echo json_encode($information);