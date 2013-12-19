<?php
/*
Simple:Press
Admin Panels - Component Management
$LastChangedDate: 2012-11-18 11:04:10 -0700 (Sun, 18 Nov 2012) $
$Rev: 9312 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# Check Whether User Can Manage Components
if (!sp_current_user_can('SPF Manage Components')) {
	if (!is_user_logged_in()) {
		spa_etext('Access denied - are you logged in?');
	} else {
		spa_etext('Access denied - you do not have permission');
	}
	die();
}

global $SPSTATUS;

include_once(SF_PLUGIN_DIR.'/admin/panel-components/spa-components-display.php');
include_once(SF_PLUGIN_DIR.'/admin/panel-components/support/spa-components-prepare.php');
include_once(SF_PLUGIN_DIR.'/admin/library/spa-tab-support.php');

# Check if plugin update is required
if ($SPSTATUS != 'ok') {
	include_once(SPLOADINSTALL);
	die();
}

global $adminhelpfile;
$adminhelpfile = 'admin-components';
# --------------------------------------------------------------------

$tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'smileys';
spa_panel_header();
spa_render_components_panel($tab);
spa_panel_footer();

?>