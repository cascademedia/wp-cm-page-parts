<?php

namespace CascadeMedia\WordPress\PagePartsPlugin;

interface Module
{
    public function getParent(): PagePartsPlugin;
    public function init(): void;
}
