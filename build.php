<?php
error_reporting(E_ALL);

$stub = <<<EOF
#!/usr/bin/env php
<?php
    Phar::mapPhar('phpcodec.phar');
    require 'phar://phpcodec.phar/main.php';
    __HALT_COMPILER();
?>
EOF;

$phar = new Phar('bin/phpcodec.phar');
//$phar->setAlias('phpcodec');
$phar->setStub($stub);
$phar->buildFromDirectory(dirname(__FILE__) . '/src/');
$phar->compressFiles(Phar::GZ);
$phar->stopBuffering();