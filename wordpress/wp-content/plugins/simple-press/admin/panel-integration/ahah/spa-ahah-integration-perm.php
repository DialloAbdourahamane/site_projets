<?php
/*
Simple:Press Admin
Ahah call for permalink update/integration
$LastChangedDate: 2012-11-18 11:04:10 -0700 (Sun, 18 Nov 2012) $
$Rev: 9312 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

spa_admin_ahah_support();

# ----------------------------------
# Check Whether User Can Manage Toolbox
if (!sp_current_user_can('SPF Manage Options')) {
	if (!is_user_logged_in()) {
		spa_etext('Access denied - are you logged in?');
	} else {
		spa_etext('Access denied - you do not have permission');
	}
	die();
}

if (isset($_GET['item'])) {
	$item = $_GET['item'];
	if($item == 'upperm') spa_update_permalink_tool();
}

die();

function spa_update_permalink_tool() {
	echo '<strong>&nbsp;'.sp_update_permalink(true).'</strong>';
	?>
	<script type="text/javascript">window.location= "<?php echo SFADMININTEGRATION; ?>";</script>
	<?php
	die();
}

die();
?>