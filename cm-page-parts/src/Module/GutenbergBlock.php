<?php

namespace CascadeMedia\WordPress\PageParts\Module;

use CascadeMedia\WordPress\PageParts\Traits\BindClosure;

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
            'cm_page_parts_gutenberg_block',
            CM_PAGE_PARTS_URL . 'assets/js/gutenberg-block.js',
            [
                'wp-api',
                'wp-block-editor',
                'wp-blocks',
                'wp-components',
                'wp-element'
            ],
            false,
            true
        );

        register_block_type(
            'cm/page-part',
            [
                'editor_script' => 'cm_page_parts_gutenberg_block',
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
            '[cm_page_part id="%d"]',
            $id
        );
    }

    /**
     * Determines whether or not the module should continue loading or not. If Gutenberg isn't enabled, there's no
     * reason to load this module.
     *
     * @return bool
     */
    protected function shouldContinue(): bool
    {
        return function_exists('register_block_type');
    }
}
