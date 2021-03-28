<?php

// This will load all PHP files in the `internal` directory, alphabetically.

function recursiveLoad($target) {
    $realTarget = realpath($target);
    $fsObjects = scandir($realTarget);

    $files = [];
    $directories = [];

    foreach ($fsObjects as $fsObject) {
        // Skip current directory and upper directory.
        if ($fsObject == "." || $fsObject == "..")
            continue;

        if (is_dir($realTarget . DIRECTORY_SEPARATOR . $fsObject)) {
            array_push($directories, $fsObject);
        } else {
            array_push($files, $fsObject);
        }
    }

    if (in_array(".no-autoload", $files))
        // Prevent auto-loading directories marked as "no-autoload".
        return;

    foreach ($files as $file) {
        if (substr($file, -4) != ".php")
            // Not a PHP file.
            continue;
        else if (realpath($realTarget . DIRECTORY_SEPARATOR . $file) == realpath(__FILE__))
            // Not self.
            continue;

        /** @noinspection PhpIncludeInspection */
        require_once $realTarget . DIRECTORY_SEPARATOR . $file;
    }

    foreach ($directories as $directory) {
        recursiveLoad($realTarget . DIRECTORY_SEPARATOR . $directory);
    }
}

recursiveLoad(__DIR__);