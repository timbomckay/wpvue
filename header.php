<?php
/**
 * The header for our theme.
 *
 * This template displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Base
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body class="<?php if(is_user_logged_in()){ echo 'logged-in'; if(is_admin_bar_showing()){ echo ' admin-bar'; } } ?>">

	<header class="site-header" role="banner">
		<div class="container">
			<div class="site-branding">
				<p class="site-title"><router-link to="/" rel="home"><?php bloginfo( 'name' ); ?></router-link></p>
				<?php if ( $description = get_bloginfo( 'description', 'display' ) ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
			</div>
			<nav id="site-navigation" class="site-navigation" role="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' => false // removes the div container, keeping nav separate for the 'role' tag
				) ); ?>
			</nav>
		</div>
	</header>
