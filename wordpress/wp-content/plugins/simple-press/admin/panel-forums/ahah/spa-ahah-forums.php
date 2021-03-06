<?php
/*
Simple:Press
Forum Specials
$LastChangedDate: 2012-11-18 11:04:10 -0700 (Sun, 18 Nov 2012) $
$Rev: 9312 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

spa_admin_ahah_support();

include_once(SF_PLUGIN_DIR.'/admin/panel-forums/support/spa-forums-prepare.php');

# Check Whether User Can Manage Components
if (!sp_current_user_can('SPF Manage Forums')) {
	if (!is_user_logged_in()) {
		spa_etext('Access denied - are you logged in?');
	} else {
		spa_etext('Access denied - you do not have permission');
	}
	die();
}

if (isset($_GET['action'])) $action = $_GET['action'];
if (isset($_GET['type'])) $type = sp_esc_str($_GET['type']);
if (isset($_GET['id'])) $id = sp_esc_int($_GET['id']);
if (isset($_GET['title'])) $title = sp_esc_str($_GET['title']);
if (isset($_GET['slugaction'])) $slugaction = sp_esc_str($_GET['slugaction']);


if ($action == 'new') echo spa_new_forum_sequence_options($action, $type, $id, 0);

if ($action == 'edit') echo spa_edit_forum_sequence_options($action, $type, $id, 0);

if ($action == 'slug') {
	$checkdupes = true;
	if ($slugaction == 'edit') $checkdupes=false;
	$newslug = sp_create_slug($title, $checkdupes, SFFORUMS, 'forum_slug');
	$newslug = sp_create_slug($newslug, $checkdupes, SFWPPOSTS, 'post_name'); # must also check WP posts table as WP can mistake forum slug for WP post
	echo $newslug;
}

if ($action == 'delicon') {
	global $SPPATHS;
	$file = sp_esc_str($_GET['file']);
	$path = SF_STORE_DIR.'/'.$SPPATHS['custom-icons'].'/'.$file;
	@unlink($path);
}

die();
?>