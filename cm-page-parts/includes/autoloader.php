<?php

namespace CascadeMedia\WordPress\PagePartsPlugin;

spl_autoload_register(function (string $className) {
    $classPrefix = 'CascadeMedia\\WordPress\\PagePartsPlugin\\';
    $sourceDirectory = __DIR__ . '/../src';

    if (strpos($className, $classPrefix) !== 0) {
        return;
    }

    $relativeClassName = substr($className, strlen($classPrefix));
    $relativeClassName = str_replace('\\', '/', $relativeClassName);
    $filePath = sprintf(
        '%s/%s.php',
        $sourceDirectory,
        $relativeClassName
    );

    if (file_exists($filePath)) {
        require $filePath;
    }
});
