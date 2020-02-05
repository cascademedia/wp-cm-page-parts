<?php

namespace CascadeMedia\WordPress\PagePartsPlugin;

use CascadeMedia\WordPress\PagePartsPlugin\PagePartsPlugin;

interface Module
{
    public function getParent(): PagePartsPlugin;
    public function init(): void;
}
