<?php

namespace CascadeMedia\WordPress\PageParts;

/**
 * Returns the FQCN that will be instantiated when the plugin boots.
 *
 * Provides a `cm_page_parts_plugin_class` filter allowing users to point to their
 * own class to be instantiated.
 */
function plugin_class(): string
{
    return apply_filters('cm_page_parts_plugin_class', Plugin::class);
}

/**
 * Returns the arguments that will be passed to the instantiated class constructor.
 *
 * Provides a `cm_page_parts_plugin_instance_arguments` filter allowing user to modify
 * the constructor arguments before the class is instantiated.
 */
function plugin_instance_arguments(): array
{
    return apply_filters('cm_page_parts_plugin_instance_arguments', []);
}

/**
 * Initializes the plugin class.
 */
function plugin_instance(): Plugin
{
    return call_user_func_array([plugin_class(), 'getInstance'], plugin_instance_arguments());
}
