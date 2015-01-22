<?php namespace PHPCodec;

class PHPCodecException extends \Exception
{
    /**
     * @var \Exception
     */
    protected $_previous;
    
    public function __construct($msg = '', $code = 0, \Exception $previous = null)
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            parent::__construct($msg, (int) $code);
            $this->_previous = $previous;
            
        } else {
            parent::__construct($msg, (int) $code, $previous);
        }
    }
}
