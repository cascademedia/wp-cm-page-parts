<?php

namespace CascadeMedia\WordPress\PageParts;

interface Module
{
    public function getParent(): Plugin;
    public function init(): void;
}
