<?php

namespace CascadeMedia\WordPress\PageParts\Module;

class CustomPostType extends AbstractModule
{
    public function init(): void
    {
        $this->registerPostType();
    }

    /**
     * Registers the `cm_page_part` post type.
     *
     * @see https://developer.wordpress.org/reference/functions/register_post_type/
     */
    protected function registerPostType(): void
    {
        $postType = 'cm_page_part';

        register_post_type(
            $postType,
            [
                'label' => 'Page Parts',
                'labels' => [],
                'description' => 'Re-usable pieces of page content.',
                'public' => false,
                'hierarchical' => false,
                'exclude_from_search' => true,
                'publicly_queryable' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_nav_menus' => false,
                'show_in_admin_bar' => false,
                'show_in_rest' => true,
                'rest_base' => $postType,
                // 'rest_controller_class' => '',
                // 'menu_position' => null //@TODO dynamically place after `Pages`,
                'menu_icon' => 'dashicons-layout',
                'capability_type' => 'post',
                // 'capabilities' => [],
                'map_meta_cap', false,
                // 'supports' => [],
                'register_meta_box_cb' => null,
                // 'taxonomies' => [],
                'has_archive' => false,
                'rewrite' => true,
                'query_var' => $postType,
                'can_export' => true,
                'delete_with_user' => null
            ]
        );
    }
}
