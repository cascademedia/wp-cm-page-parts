<?php

namespace EstelSmith\WordPress\PageParts;

interface Module
{
    public function getParent(): Plugin;
    public function init(): void;
}
