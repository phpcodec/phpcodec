<?php namespace PHPCodec\Codec\Lua\LuaParser;

class LuaParser
{
    private $_symbols = array(
        0 => '$accept',
        1 => '$end',
        2 => 'error'
        
        
        //[
        //]
        //{
        //}
        //,
        //=
    );
    
    /**
     * @param unknown $input
     * @throws LuaParserException
     */
    private function _failOnBom($input)
    {
        // UTF-8 ByteOrderMark sequence
        $bom = "\xEF\xBB\xBF";
        if (substr($input, 0, 3) === $bom) {
            throw new LuaParserException("BOM detected, make sure your input does not include a Unicode Byte-Order-Mark");
        }
    }
    
    public function parse($input)
    {
        $this->_failOnBom($input);
        
        
    }
}
