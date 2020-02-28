<?php
/**
 * Plugin Name: Cascade Media Page Parts
 * Plugin URI: https://github.com/cascademedia/wp-cm-page-parts
 * Description: Custom post types and shortcodes to render reusable page components in WordPress.
 * Version: 0.0.1
 * Requires at least: 5.3
 * Requires PHP: 7.2
 * Author: Cascade Media
 * Author URI: http://cascademedia.us/
 */

namespace CascadeMedia\WordPress\PageParts;

require __DIR__ . '/bootstrap.php';

define('CM_PAGE_PARTS_DIR', plugin_dir_path(__FILE__));
define('CM_PAGE_PARTS_URL', plugin_dir_url(__FILE__));

/**
 * Instantiate the plugin!!
 */
plugin_instance();
plugin_modules_instantiate();