<?php namespace PHPCodec\Codec\Json;

use PHPCodec\Codec\Codec;
use PHPCodec\PHPCodecException;

class Main extends Codec
{

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::encode()
     */
    public function encode(& $input, $paramStr = null)
    {
        if(strtolower($paramStr) == 'pretty') {
            if( version_compare(PHP_VERSION, '5.4.0', '<') ) {
                throw new PHPCodecException("PHP version is too old(" . PHP_VERSION . "), expected PHP >= 5.4.0");
            }
            
            return json_encode($input, JSON_PRETTY_PRINT);
        }
        
        return json_encode($input);
    }

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::decode()
     */
    public function decode(& $input, $paramStr = null)
    {
        return json_decode($input, true);
    }
}
