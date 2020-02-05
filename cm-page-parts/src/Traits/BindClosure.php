<?php

namespace CascadeMedia\WordPress\PagePartsPlugin\Traits;

trait BindClosure
{
    //@TODO rename to `bindThis` to make usage more clear.
    protected function bindClosure(\Closure $closure)
    {
        return \Closure::bind($closure, $this, $this);
    }
}
