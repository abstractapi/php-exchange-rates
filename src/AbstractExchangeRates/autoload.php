<?php

namespace Abstractapi\ExchangeRates;

// Define autoloader
spl_autoload_register(function ($class) {

    // Set AbstractPhoneValidation library location path.
    $srcPath = __DIR__ . DIRECTORY_SEPARATOR;

    $srcPath = str_replace("\\", DIRECTORY_SEPARATOR, $srcPath);
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';

    // Will check for Abstractapi namespace
    $starts_with =  __NAMESPACE__ . DIRECTORY_SEPARATOR;
    $starts_with = str_replace("\\", DIRECTORY_SEPARATOR, $starts_with);

    if(substr($class, 0, strlen($starts_with)) !== $starts_with)
    {
        return false;
    }

    // Removes namespace's name from class path.
    $class = str_replace($starts_with, "", $class);

    $file = $srcPath.$class;

    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
});