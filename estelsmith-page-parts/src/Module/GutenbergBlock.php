<?php

namespace EstelSmith\WordPress\PageParts\Module;

use EstelSmith\WordPress\PageParts\Traits\BindClosure;

class GutenbergBlock extends AbstractModule
{
    use BindClosure;

    public function init(): void
    {
        if (!$this->shouldContinue()) {
            return;
        }

        $this->registerBlock();
    }

    /**
     * @see https://developer.wordpress.org/reference/functions/wp_register_script/
     * @see https://developer.wordpress.org/reference/functions/register_block_type/
     */
    protected function registerBlock(): void
    {
        wp_register_script(
            'estelsmith_page_parts_gutenberg_block_script',
            ESTELSMITH_PAGE_PARTS_URL . 'assets/js/gutenberg-block.js',
            [
                'wp-blocks',
                'wp-components',
                'wp-element'
            ],
            false,
            true
        );

        wp_register_style(
            'estelsmith_page_parts_gutenberg_block_style',
            ESTELSMITH_PAGE_PARTS_URL . 'assets/css/gutenberg-block.css'
        );

        add_action('enqueue_block_editor_assets', function () {
            $posts = get_posts([
                'numberposts' => -1,
                'post_type' => CustomPostType::POST_TYPE,
                'orderby' => 'title',
                'order' => 'ASC'
            ]);
            $postData = [
                [
                    'label' => '-- Select --',
                    'value' => null
                ]
            ];

            foreach ($posts as $post) {
                $postData[] = [
                    'label' => $post->post_title,
                    'value' => $post->ID
                ];
            }

            wp_add_inline_script(
                'estelsmith_page_parts_gutenberg_block_script',
                sprintf(
                    'window.%1$s = window.%1$s || {}; window.%1$s.options = %2$s;',
                    CustomPostType::POST_TYPE,
                    json_encode($postData)
                ),
                'before'
            );
        });

        register_block_type(
            'estelsmith/page-part',
            [
                'editor_script' => 'estelsmith_page_parts_gutenberg_block_script',
                'editor_style' => 'estelsmith_page_parts_gutenberg_block_style',
                'render_callback' => $this->bindThis(function ($attributes) {
                    return $this->renderBlock($attributes);
                })
            ]
        );
    }

    protected function renderBlock($attributes): string
    {
        //@TODO Make block rendering configurable?
        $id = (int)($attributes['id'] ?? null);
        return sprintf(
            '[estelsmith_page_part id="%d"]',
            $id
        );
    }

    /**
     * Determines whether or not the module should continue loading. If Gutenberg isn't enabled, there's no
     * reason to load this module.
     *
     * @return bool
     */
    protected function shouldContinue(): bool
    {
        return function_exists('register_block_type');
    }
}
