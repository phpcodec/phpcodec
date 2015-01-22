<?php

//PHP
$test = array(
    'test' => array(
        't1' => array(
            't' => 3
        )
    ),
    'test2' => 'www.baidu.com',
    't' => 1,
);

//Ini
$testIni = '
test.0.c = "a"
test.1.c = "b"
test.2.a = c
dudu = 1
debug = 1
';

//PHP Serialize

//JSON

//msgpack


//include 'PHPCodec/Codec/Ini/Main.php';

$codec = new \PHPCodec\Codec\Ini\Main();

//var_dump( $codec->encode($test) );

var_dump( $codec->decode($testIni) );

//debug
die();

