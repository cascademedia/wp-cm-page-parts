<?php

namespace CascadeMedia\WordPress\PagePartsPlugin\Module\Exception;

use CascadeMedia\WordPress\PagePartsPlugin\Exception\RuntimeException;
use CascadeMedia\WordPress\PagePartsPlugin\Module\Exception;

//@TODO Not needed anymore since parent is not optional.
class ParentNotSetException extends RuntimeException implements Exception
{

}
