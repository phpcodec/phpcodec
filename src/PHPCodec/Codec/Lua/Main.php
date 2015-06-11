<?php
namespace PHPCodec\Codec\Lua;

use PHPCodec\Codec\Codec;
use PHPCodec\PHPCodecException;

class Main extends Codec
{
    
    /**
     * Convert PHP array data to Lua table expression
     * 
     * @param array $arr    PHP array
     * @return string
     */
    public static function array2LuaTable($arr, $indentSize = 1, $indentUnit = 4)
    {
        $indent = str_repeat('    ', $indentSize);
        $luaString = ',{' . PHP_EOL;
        
        $tmpEntry = '';
        foreach($arr as $k => $v) {
            $tmpEntry .= $indent;
            
            if( is_string($k) ) {
                $tmpEntry .= '["' . $k . '"] = ';
                
            } else if( is_numeric($k) ) {
                $tmpEntry .= '[' . $k . '] = ';
            }
            
            if( is_array($v) ) {
                $tmpEntry .= self::array2LuaTable($v, $indentSize + 1, $indentUnit) . ',';
                
            } else if( is_string($v) ) {
                $tmpEntry .= '"' . $v . '",';
                
            } else if( is_numeric($v) ) {
                $tmpEntry .= $v . ',';
            }
            
            $tmpEntry .= PHP_EOL;
        }
        
        $tmpEntry = trim($tmpEntry, PHP_EOL . ',') . PHP_EOL;
        
        $rbIndentSize = $indentSize - 1;
        $rbIndentSize = $rbIndentSize >= 0 ? $rbIndentSize : 0;
        
        $luaString .= $tmpEntry . str_repeat('    ', $rbIndentSize) . '},';
        $luaString = trim($luaString, ',');
        
        return $luaString;
    }
    
    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::encode()
     */
    public function encode(& $input, $paramStr = null)
    {
        if( !is_array($input) ) {
            throw new PHPCodecException('Invalid input');
        }
        
        /*
        $userParams = array();
        $params = explode(',', $paramStr);
        if( !empty($params) ) {
            foreach($params as $paramExp) {
                list($key, $value) = explode('=', $paramExp);
                if( !empty($key) && !empty($value) ) {
                    $userParams[ $key ] = $value;
                }
            }
        }
        */
        
        return trim( self::array2LuaTable($input) );
    }

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::decode()
     */
    public function decode(& $input, $paramStr = null)
    {
        //var_dump($input);
    }
}
