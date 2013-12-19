<?php
/*
Simple:Press
Admin Toolbox Uninstall Form
$LastChangedDate: 2012-11-18 11:04:10 -0700 (Sun, 18 Nov 2012) $
$Rev: 9312 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function spa_toolbox_uninstall_form()
{
?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#sfuninstallform').ajaxForm({
		target: '#sfmsgspot',
		success: function() {
			jQuery('#sfmsgspot').fadeIn();
			jQuery('#sfmsgspot').fadeOut(6000);
		}
	});
});
</script>
<?php

	$sfoptions = spa_get_uninstall_data();

    $ahahURL = SFHOMEURL.'index.php?sp_ahah=toolbox-loader&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;saveform=uninstall';
?>
	<form action="<?php echo $ahahURL; ?>" method="post" id="sfuninstallform" name="sfuninstall">
	<?php echo sp_create_nonce('forum-adminform_uninstall'); ?>
<?php

	spa_paint_options_init();

#== UNINSTALL Tab ==========================================================

	spa_paint_open_tab(spa_text('Toolbox').' - '.spa_text('Uninstall'));
		spa_paint_open_panel();
			echo '<br /><div class="sfoptionerror">';
			spa_etext('Should you, at any time, decide to remove Simple:Press, check the option below and then deactivate the plugin in the standard WP fashion');
            echo '.<br />';
            spa_etext('THIS WILL REMOVE ALL DATA FROM YOUR DATABASE');
            echo '!<br />';
            spa_etext('THIS WILL REMOVE ALL STORAGE LOCATIONS AND DATA EXCEPT FOR YOUR SIMPLE:PRESS THEMES AND PLUGINS');
            echo '!<br />';
            spa_etext('THIS CAN NOT BE REVERSED');
            echo '!<br />';
            spa_etext('Please note that you will still manually need to remove the Simple:Press core plugin files as well as any Simple:Press Plugins and Themes you have added');
            echo '.<br />';
			echo '</div>';

			spa_paint_open_fieldset(spa_text('Removing Simple:Press'), true, 'uninstall', true);
				spa_paint_checkbox(spa_text('Completely Remove Simple:Press Database Entries'), 'sfuninstall', $sfoptions['sfuninstall']);
			spa_paint_close_fieldset();
		spa_paint_close_panel();
		do_action('sph_toolbox_uninstall_panel');
	spa_paint_close_tab();

?>
	<div class="sfform-submit-bar">
	<input type="submit" class="button-primary" id="saveit" name="saveit" value="<?php spa_etext('Uninstall'); ?>" />
	</div>
	</form>
<?php
}
?>