<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Theme custom function file
#	Theme		:	Default
#	File		:	custom functions
#	Author		:	Simple:Press
#
#	The 'functions' file can be used for custom functions & is loaded with each template
#
# --------------------------------------------------------------------------------------

# ------------------------------------------------------------------------------------------
# A small javascript routine has been used to replace checkboxes and radio buttons with
# more appealing graphics. A small number of users have experienced a conflict with this
# js library. If you have this problem please set SP_USE_PRETTY_CBOX to false.

define('SP_USE_PRETTY_CBOX', true);

# A small javascript routine has been used to replace standard browser tooltips with
# more appealing graphics. You can turn this off by setting SP_TOOLTIPS to false.

define('SP_TOOLTIPS', true);

# ------------------------------------------------------------------------------------------

add_action('init', 'spDefault_textdomain');

# load the theme textdomain for tranlations
function spDefault_textdomain() {
	sp_theme_localisation('spDefault');
}

if (function_exists('sp_FontResizer')) {
	add_action('sph_BeforeDisplayStart', 'spDefault_spShowFontResize');
}

function spDefault_spShowFontResize() {
	$tipMinus = __sp('decrease forum font size');
	$tipReset = __sp('reset forum font size');
	$tipPlus  = __sp('increase font size');
	sp_FontResizer('tagClass=spFontSizeControl spRight', $tipMinus, $tipReset, $tipPlus);
	sp_InsertBreak('direction-right');
}

?>