<?php

namespace CascadeMedia\WordPress\PageParts\Module;

class Shortcode extends AbstractModule
{
    public function init(): void
    {
        $this->registerShortcodes();
    }

    /**
     * Register shortcodes to render the `cm_page_part` posts.
     *
     * @see https://developer.wordpress.org/reference/functions/add_shortcode/
     */
    protected function registerShortcodes(): void
    {
        add_shortcode('cm_page_part', [$this, 'pagePart']);
    }

    /**
     * Renders a given page part.
     *
     * Available options:
     * `id` - Required. The ID of the cm_page_part post.
     *
     * @param array|null $options
     * @return string
     */
    public function pagePart($options)
    {
        $options = shortcode_atts(
            [
                'id' => null
            ],
            $options
        );

        $id = $options['id'];
        if (!$id) {
            return $this->formatError('ID is required.');
        }

        $post = get_post($id);
        if (!$post) {
            return $this->formatError(sprintf(
                'Post "%d" not found',
                $id
            ));
        }

        if ($post->post_type !== 'cm_page_part') {
            return $this->formatError(sprintf(
                'Post "%d" is not a "cm_page_part"',
                $id
            ));
        }

        return do_shortcode(do_blocks($post->post_content));
    }

    protected function formatError(string $message): string
    {
        return sprintf(
            'CM_PAGE_PART ERROR: %s',
            $message
        );
    }
}
