<?php

namespace CascadeMedia\WordPress\PageParts\Module\Exception;

use CascadeMedia\WordPress\PageParts\Exception\RuntimeException;
use CascadeMedia\WordPress\PageParts\Module\Exception;

//@TODO Not needed anymore since parent is not optional.
class ParentNotSetException extends RuntimeException implements Exception
{

}
