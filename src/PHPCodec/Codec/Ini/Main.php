<?php namespace PHPCodec\Codec\Ini;

use PHPCodec\Codec\Codec;
use PHPCodec\PHPCodecException;

/**
 * Ini encoding & decoding
 * 
 * @author lanzhiqiang@baofeng.com
 *
 */
class Main extends Codec
{
    /**
     * Convert array data to ini string
     * 
     * @param array $data
     * @return string
     */
    public static function array2Ini(array $data)
    {
        $iniString = '';
        
        foreach($data as $key => $value) {
            
            if( is_array( $value ) ) {
                $iniString .= $key . '.' . self::array2Ini($value);
                
            } else {
                $iniString .= "{$key} = {$value}" . PHP_EOL;
            }
            
        }
        
        return $iniString;
    }
    
    /**
     * Convert ini string to PHP array data
     * 
     * @param string $ini   Ini string
     * @return array
     */
    public static function ini2Array($ini)
    {
        $arr = array();
        $parsed = parse_ini_string($ini, true);
        
        if(!empty($parsed)) foreach($parsed as $key => $value) {
            if(strpos($key, '.') !== false) {
                $key = explode('.', $key);
                
                $tmpArr = & $arr;
                foreach($key as $k) {
                    $tmpArr = & $tmpArr[$k];
                }
                
                $tmpArr = $value;
                
            } else {
                $arr[ $key ] = $value;
            }
        }
        
        return $arr;
    }
    
    /* (non-PHPdoc)
     * @see \PHPcodec\Codec\Codec::encode()
     */
    public function encode(& $input, $paramStr = null)
    {
        if( !is_array($input) ) {
            throw new PHPCodecException("Incorrect input format");
        }
        
        return self::array2Ini($input);
    }

    /* (non-PHPdoc)
     * @see \PHPcodec\Codec\Codec::decode()
     */
    public function decode(& $input, $paramStr = null)
    {
        if( !is_string($input) ) {
            throw new PHPCodecException("Incorrect input format");
        }
        
        return self::ini2Array($input);
    }
}
