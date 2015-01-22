<?php
namespace PHPCodec\Codec\Msgpack;

use PHPCodec\Codec\Codec;
use PHPCodec\PHPCodecException;

class Main extends Codec
{
    public function __construct()
    {
        if( !function_exists('msgpack_unpack') ) {
            throw new PHPCodecException('MessagePack PHP extension is required');
        }
    }
    

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::encode()
     */
    public function encode(& $input, $paramStr = null)
    {
        return msgpack_pack($input);
    }

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::decode()
     */
    public function decode(& $input, $paramStr = null)
    {
        return msgpack_unpack($input);
    }
}
