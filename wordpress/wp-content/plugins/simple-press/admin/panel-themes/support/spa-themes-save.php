<?php
/*
Simple:Press
Admin plugins Update Support Functions
$LastChangedDate: 2012-12-20 13:59:13 -0700 (Thu, 20 Dec 2012) $
$Rev: 9559 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

/**
* Saves the selected theme as the current active theme.
*/
function spa_save_theme_data() {
	check_admin_referer('forum-adminform_themes', 'forum-adminform_themes');

    $theme = sp_esc_str($_POST['theme']);
    $style = sp_esc_str($_POST['style']);
    $color = sp_esc_str($_POST['color-'.$theme]);

    if (isset($_POST['activate']) || isset($_POST['update'])) {
        if (empty($theme) || empty($style)) return spa_text('An error occurred activating the Theme!');
    	if (empty($color)) $color = sp_esc_str($_POST['default-color']);

    	# activate the theme
        $current = array();
        $current['theme'] = $theme;
        $current['style'] = $style;
        $current['color'] = $color;
    	sp_update_option('sp_current_theme', $current);

        # load theme functions file in case it wants to hook into activation
        if (file_exists(SPTHEMEBASEDIR.$theme.'/templates/spFunctions.php')) {
        	include_once(SPTHEMEBASEDIR.$theme.'/templates/spFunctions.php');
        }

        # clean out the combined css file
        sp_clear_combined_css('all');

        # theme activation action
        do_action('sph_activate_theme', $current);
        do_action('sph_activate_theme_'.$theme, $current);

        return spa_text('Theme activated/updated');
    } else if (isset($_POST['delete']) == 'delete' && (!is_multisite() || is_super_admin())) {
        $mess = sp_delete_sp_theme($theme);
        return $mess;
    }
}

function spa_save_theme_mobile_data() {
	check_admin_referer('forum-adminform_themes', 'forum-adminform_themes');

    $mobileTheme = sp_get_option('sp_mobile_theme');
    $curTheme = sp_get_option('sp_current_theme');

    $mobile = array();
    $active = isset($_POST['active']);
    if ($active && $mobileTheme['active']) {
        $theme = sp_esc_str($_POST['theme']);
        $style = sp_esc_str($_POST['style']);
        $color = sp_esc_str($_POST['color-'.$theme]);

        if (empty($theme) || empty($style)) return spa_text('No data changed');
    	if (empty($color)) $color = sp_esc_str($_POST['default-color']);

        $mobile['active'] = true;
        $mobile['theme'] = $theme;
        $mobile['style'] = $style;
        $mobile['color'] = $color;
    } else {
        $mobile = array();
        $mobile['active'] = $active;
    	$mobile['theme'] = $curTheme['theme'];
    	$mobile['style'] = $curTheme['style'];
    	$mobile['color'] = $curTheme['color'];
    }
   	sp_update_option('sp_mobile_theme', $mobile);

    # clean out the combined css file
    sp_clear_combined_css('mobile');

    # theme activation action
    do_action('sph_activate_mobile_theme', $mobile);
    do_action('sph_activate_mobile_theme_'.$mobile['theme'], $mobile);

    return spa_text('Mobile theme activated/updated');
}

function spa_save_editor_data() {
	check_admin_referer('forum-adminform_theme-editor', 'forum-adminform_theme-editor');

	$file = stripslashes($_POST['file']);
	$newcontent = stripslashes($_POST['spnewcontent']);
	if (is_writeable($file)) {
		$f = fopen($file, 'w+');
		if ($f !== FALSE) {
			fwrite($f, $newcontent);
			fclose($f);
			$msg = spa_text('Theme file updated!');
		} else {
			$msg = spa_text('Unable to save theme file');
		}
	} else {
		$msg = spa_text('Theme file is not writable!');
	}

	return $msg;
}
?>