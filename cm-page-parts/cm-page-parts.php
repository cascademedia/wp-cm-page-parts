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

declare(strict_types=1);

namespace CascadeMedia\WordPress;

class PagePartsPlugin
{
    public function __construct()
    {

    }

    public static function getInstance()
    {
        static $instance = null;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    public function doIt()
    {

    }
}
