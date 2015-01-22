<?php
namespace PHPCodec\Codec\Php;

use PHPCodec\Codec\Codec;

class Main extends Codec
{

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::encode()
     */
    public function encode(& $input, $paramStr = null)
    {
        return var_export($input, true);
    }

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::decode()
     */
    public function decode(& $input, $paramStr = null)
    {
        $input = trim($input);
        eval("\$phpVar = {$input};");
        return $phpVar;
    }
}
