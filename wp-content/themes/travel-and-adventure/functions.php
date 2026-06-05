<?php
/**
 * Theme bootstrap for the Travel and Adventure child theme.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FLK_THEME_VERSION', '0.1.0' );
define( 'FLK_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'FLK_THEME_URI', trailingslashit( get_stylesheet_directory_uri() ) );

require_once FLK_THEME_DIR . 'inc/theme-setup.php';
require_once FLK_THEME_DIR . 'inc/template-tags.php';
require_once FLK_THEME_DIR . 'inc/shortcodes.php';
