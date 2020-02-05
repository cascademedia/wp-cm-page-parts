<?php

namespace CascadeMedia\WordPress\PageParts\Traits;

trait BindClosure
{
    protected function bindThis(\Closure $closure)
    {
        return \Closure::bind($closure, $this, $this);
    }
}
