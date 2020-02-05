<?php

namespace CascadeMedia\WordPress\PagePartsPlugin\Module;

use CascadeMedia\WordPress\PagePartsPlugin\Module;
use CascadeMedia\WordPress\PagePartsPlugin\Module\Exception\ParentAlreadySetException;
use CascadeMedia\WordPress\PagePartsPlugin\Module\Exception\ParentNotSetException;
use CascadeMedia\WordPress\PagePartsPlugin\PagePartsPlugin;

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
        $parent = $this->parent;

        if (!$parent) {
            throw new ParentNotSetException();
        }

        return $parent;
    }
}
