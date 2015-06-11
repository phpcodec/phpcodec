<?php
/**
 * PHP Command line encoding & decoding tool
 *
 * @version 1.0.0
 * @author Zhiqiang Lan
 * @license MIT
 */

use PHPCodec\PHPCodec;
use PHPCodec\Output;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_implicit_flush(true);

set_error_handler(function ($errno , $errstr ,$errfile, $errline){
    throw new  ErrorException ($errstr ,  0 ,  $errno ,  $errfile ,  $errline);
});

spl_autoload_register(function($className) {
    if( strpos($className, '/') === 0 ) {
        return false;
    }
    $classFilename = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    
    if( !file_exists($classFilename) ) {
        return false;
    }
    include $classFilename;
});

//Initialization
include 'init.php';

try {
    $phpCodec = new PHPCodec($argc, $argv);
    $phpCodec->run();
    
} catch (\Exception $e) {
    echo Output::getStyledString($e->getMessage(),
                        Output::COLOR_WHITE,
                        Output::BG_RED)
          . PHP_EOL;
    
    if( !empty($phpCodec) ) {
        $phpCodec->showUsage();
    }
    
}
