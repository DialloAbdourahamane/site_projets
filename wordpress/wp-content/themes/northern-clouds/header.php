<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'northern' ), max( $paged, $page ) );

?>
</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>

</head>

<body <?php body_class(); ?>>

<header id="header">
<h1><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
<?php bloginfo('name'); ?></a></h1>
<em><?php bloginfo('description'); ?></em>
</header> 

<section id="wrapper">

<section id="headerpic" style=""></section>

<nav><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '') ); ?></nav>
<section id="content">