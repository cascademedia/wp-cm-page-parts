<?php

namespace EstelSmith\WordPress\PageParts\Traits;

trait BindClosure
{
    /**
     * @deprecated Turns out PHP 7.x scopes Closures to the class they were defined in.
     *
     * @param \Closure $closure
     * @return \Closure
     */
    protected function bindThis(\Closure $closure)
    {
        return \Closure::bind($closure, $this, $this);
    }
}
