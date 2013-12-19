<?php
/*
Simple:Press
Quote handing for posts
$LastChangedDate: 2013-02-03 12:54:08 -0700 (Sun, 03 Feb 2013) $
$Rev: 9812 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

sp_forum_api_support();
sp_load_editor(0,1);

$postid = sp_esc_int($_GET['post']);
$forumid = sp_esc_int($_GET['forumid']);
if (empty($forumid) || empty($postid)) die();

if (!sp_get_auth('reply_topics', $forumid)) {
	if (!is_user_logged_in()) {
		sp_etext('Access denied - are you logged in?');
	} else {
		sp_etext('Access denied - you do not have permission');
	}
	die();
}

$content = spdb_table(SFPOSTS, "post_id=$postid", 'post_content');
$content = sp_filter_content_edit($content);
echo $content;

die();
?>