<?php
namespace PHPCodec\Codec;

/**
 * Codec base class
 * 
 * @author lanzhiqiang@baofeng.com
 *
 */
abstract class Codec
{
    /**
     * Load codec by name
     * 
     * @param string $name Codec name
     * @return Codec|null
     */
    public static function load($name)
    {
        $name = ucfirst( strtolower($name) );
        $codecFullClassName = "\\PHPCodec\\Codec\\{$name}\\Main";
        
        if( class_exists($codecFullClassName) ) {
            return new $codecFullClassName();
        }
    }
    
    /**
     * Encode input data
     * 
     * @param mixed  $input     Input data
     * @param string $paramStr  Custom string
     * @return string Encoded string
     */
    abstract public function encode(& $input, $paramStr = null);
    
    /**
     * Decode input data
     * 
     * @param string $input     Input data
     * @param string $paramStr  Custom string
     * @return mixed Decoded variable
     */
    abstract public function decode(& $input, $paramStr = null);
}
