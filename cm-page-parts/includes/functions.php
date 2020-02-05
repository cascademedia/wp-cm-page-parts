<?php

namespace CascadeMedia\WordPress\PageParts;

use CascadeMedia\WordPress\PageParts\Module\CustomPostType;

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

/**
 * Returns a list of modules that will be added to the plugin.
 *
 * Provides a `cm_page_parts_plugin_modules` filter allowing the user to modify the modules that will be added to the
 * plugin.
 *
 * @return string[]
 */
function plugin_modules(): array
{
    return apply_filters(
        'cm_page_parts_plugin_modules',
        [
            CustomPostType::class
        ]
    );
}

/**
 * Instantiate modules and add them to the plugin.
 *
 * Provides a `cm_page_parts_module_instance` filter per-plugin that allows the user to modify how the module is
 * constructed before being added to the plugin.
 *
 * @return Module[]
 */
function plugin_modules_instantiate(): array
{
    $plugin = plugin_instance();
    $moduleClasses = plugin_modules();
    $modules = [];

    foreach ($moduleClasses as $className) {
        [$resolvedClass, $arguments] = apply_filters('cm_page_parts_module_instance', [$className, [$plugin]]);
        $modules[] = new $resolvedClass(...$arguments);
    }

    $plugin->addModule(...$modules);

    return $modules;
}
