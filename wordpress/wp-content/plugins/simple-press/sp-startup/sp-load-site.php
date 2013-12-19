<?php
/*
Simple:Press
Desc:
$LastChangedDate: 2012-11-18 11:04:10 -0700 (Sun, 18 Nov 2012) $
$Rev: 9312 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# ==========================================================================================
#
# 	SITE
#	This file loads the asdditional core SP support needed by the site (front end) for all
#	page loads - not just for the forum. It also exposes base api files that may be needed by
#	plugins, template tags etc., and creates items needed by the header for non forum use.
#
# ==========================================================================================

# ------------------------------------------------------------------------------------------
# Include core api files

# ------------------------------------------------------------------------------------------

# ------------------------------------------------------------------------------------------
# Set up core support WP Hooks

# Rewrite Rules

add_filter('page_rewrite_rules', 'sp_set_rewrite_rules');
# ------------------------------------------------------------------------------------------

# 404

add_action('template_redirect', 'sp_404');
# ------------------------------------------------------------------------------------------

# Load blog script support

add_action('wp_enqueue_scripts', 'sp_load_blog_script');
# ------------------------------------------------------------------------------------------

# Load blog header support

add_action('wp_head','sp_load_blog_support');
# ------------------------------------------------------------------------------------------

do_action('sph_site_startup');

?>