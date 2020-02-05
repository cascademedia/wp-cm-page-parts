<?php

namespace CascadeMedia\WordPress\PageParts\Module;

class GutenbergBlock extends AbstractModule
{
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
                'editor_script' => 'cm_page_parts_gutenberg_block'
            ]
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
