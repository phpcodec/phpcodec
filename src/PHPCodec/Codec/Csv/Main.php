<?php
namespace PHPCodec\Codec\Csv;

use PHPCodec\Codec\Codec;
use PHPCodec\PHPCodecException;
use PHPCodec;

class Main extends Codec
{

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::encode()
     */
    public function encode(& $input, $paramStr = null)
    {
        if( !is_array($input) ) {
            throw new PHPCodecException("Invalid input");
        }
        
        $csv = '';
        foreach($input as $idx => $arr) {
            
            if( !is_array($arr) ) {
                throw new PHPCodecException('Invalid input');
            }
            
            foreach($arr as $subItem) {
                
                if( !is_scalar($subItem) ) {
                    throw new PHPCodecException(
                        "Can't convert input data to CSV type. The second level of the input array can only be string type"
                    );
                }
            }
            
            $csv .= implode(',', $arr) . PHP_EOL;
        }
        
        return $csv;
    }

    /* (non-PHPdoc)
     * @see \PHPCodec\Codec\Codec::decode()
     */
    public function decode(& $input, $paramStr = null)
    {
        $headBytes500 = substr($input, 0, 500);
        
        if( empty($headBytes500) ) {
            throw new PHPCodecException("Invalid input");
        }
        
        $test = str_getcsv($headBytes500);
        if( empty($test) ) {
            return;
        }
        
        $data = array();
        $input = trim($input);
        
        $rows = explode("\n", $input);
        foreach($rows as $row) {
            $row = trim($row);
            $data[] = str_getcsv($row);
        }
        
        return $data;
    }
}
