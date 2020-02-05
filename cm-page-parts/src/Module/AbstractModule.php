<?php

namespace CascadeMedia\WordPress\PageParts\Module;

use CascadeMedia\WordPress\PageParts\Module;
use CascadeMedia\WordPress\PageParts\PagePartsPlugin;

abstract class AbstractModule implements Module
{
    /**
     * @var PagePartsPlugin
     */
    protected $parent;

    public function __construct(PagePartsPlugin $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): PagePartsPlugin
    {
        return $this->parent;
    }
}
