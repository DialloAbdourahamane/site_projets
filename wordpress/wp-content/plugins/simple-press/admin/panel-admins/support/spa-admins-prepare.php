<?php
/*
Simple:Press
Admin Admins Update Global Options Support Functions
$LastChangedDate: 2012-11-18 11:04:10 -0700 (Sun, 18 Nov 2012) $
$Rev: 9312 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function spa_get_admins_your_options_data() {
	global $spThisUser;
	$sfadminoptions = sp_get_member_item($spThisUser->ID, 'admin_options');
	return $sfadminoptions;
}

function spa_get_admins_global_options_data() {
	$sfadminsettings = sp_get_option('sfadminsettings');
	return $sfadminsettings;
}

?>