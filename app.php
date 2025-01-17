<?php

//require_once 'src/blog.php';
//require_once 'src/helpers.php';
//require_once 'src/main.php';

require __DIR__ . '/vendor/autoload.php';

try {
    $result = main();
    echo $result . PHP_EOL;
} catch (PDOException $pe) {
    echo $pe->getMessage() . PHP_EOL;
} catch (Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
