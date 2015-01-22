<?php
namespace PHPCodec\Codec\Phpserialize;

use PHPCodec\Codec\Codec;

class Main extends Codec
{

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::encode()
     */
    public function encode(& $input, $paramStr = null)
    {
        return serialize($input);
    }

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::decode()
     */
    public function decode(& $input, $paramStr = null)
    {
        return unserialize($input);
    }
}
