<?php

namespace CascadeMedia\WordPress\PageParts\Module;

class CustomPostType extends AbstractModule
{
    public const POST_TYPE = 'cm_page_part';

    public function init(): void
    {
        $this->registerPostType();
        $this->setDefaultSortOrder();
    }

    /**
     * Registers the `cm_page_part` post type.
     *
     * @see https://developer.wordpress.org/reference/functions/register_post_type/
     */
    protected function registerPostType(): void
    {
        register_post_type(
            self::POST_TYPE,
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
                'rest_base' => self::POST_TYPE,
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
                'query_var' => self::POST_TYPE,
                'can_export' => true,
                'delete_with_user' => null
            ]
        );
    }

    /**
     * Sets the default sort order of posts on the list page.
     *
     * @see https://developer.wordpress.org/reference/hooks/pre_get_posts/
     */
    protected function setDefaultSortOrder(): void
    {
        add_action('pre_get_posts', function (\WP_Query $query) {
            if (!is_admin()) {
                return;
            }

            $screen = get_current_screen();

            if ($screen->post_type === self::POST_TYPE && $screen->base === 'edit' && !isset($_GET['orderby'])) {
                $query->set('orderby', 'title');
                $query->set('order', 'ASC');
            }
        });
    }
}
