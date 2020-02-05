<?php

namespace CascadeMedia\WordPress\PagePartsPlugin\Traits;

trait BindClosure
{
    protected function bindClosure(\Closure $closure)
    {
        return \Closure::bind($closure, $this, $this);
    }
}
