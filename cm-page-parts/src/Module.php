<?php

namespace CascadeMedia\WordPress\PageParts;

interface Module
{
    public function getParent(): PagePartsPlugin;
    public function init(): void;
}
