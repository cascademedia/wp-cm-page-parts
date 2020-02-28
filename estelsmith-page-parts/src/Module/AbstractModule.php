<?php

namespace CascadeMedia\WordPress\PageParts\Module;

use CascadeMedia\WordPress\PageParts\Module;
use CascadeMedia\WordPress\PageParts\Plugin;

abstract class AbstractModule implements Module
{
    /**
     * @var Plugin
     */
    protected $parent;

    public function __construct(Plugin $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): Plugin
    {
        return $this->parent;
    }
}
