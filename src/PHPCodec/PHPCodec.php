<?php namespace PHPCodec;

use PHPCodec\Codec\Codec;
use PHPCodec\PHPCodecException;
use PHPCodec\Output;

set_error_handler (function ( $errno ,  $errstr ,  $errfile ,  $errline  ) {
    throw new \ErrorException ( $errstr ,  0 ,  $errno ,  $errfile ,  $errline );
});

/**
 * PHP Codec logic class
 * 
 * @author lanzhiqiang@baofeng.com
 *
 */
class PHPCodec
{
    protected static $_codecs = array();
    
    protected $_options;
    
    protected $_argc;
    protected $_argv;
    
    protected $_fromCodec;
    protected $_toCodec;
    
    /**
     * @return string
     */
    protected function _captrueInput()
    {
        $options = $this->_options;
        $input = '';
        
        if( isset($options['f']) ) {
            clearstatcache();
            if( !file_exists($options['f']) ) {
                throw new PHPCodecException("The input file doesn't exists");
            }
            
            $input = file_get_contents( $options['f'] );
        
        } else {
            //sec
            $timeout = 5;
            stream_set_blocking(STDIN, 0);
            
            while( !feof(STDIN) ) {
                $input .= fread(STDIN, 1024);
        
                if( $timeout == 0 ) {
                    throw new PHPCodecException("Timeout while reading input data from STDIN");
                }
        
                if( empty($input) ) {
                    $timeout --;
                    sleep(1);
                }
            }
        }
        
        if( empty($input) ) {
            throw new PHPCodecException("Empty input");
        }
        
        return trim($input);
    }
    
    /**
     * @param array  $argv    CLI argv
     * @param int    $argc    CLI argc
     * @throws PHPCodecException
     */
    public function __construct($argc, $argv)
    {
        if( PHP_SAPI != 'cli' ) {
            throw new PHPCodecException("Please run this program in CLI mode");
        }
        
        $this->_options = getopt('h::l::f:O:t:');
        
        $this->_argc = $argc;
        $this->_argv = $argv;
    }
    
    /**
     * Display help info
     */
    public function showUsage()
    {
        $argv = $this->_argv;
        
        $usageInfo = PHP_EOL . "  PHPCodec" . PHP_EOL
                  . str_repeat('=', 45) . PHP_EOL;
        
        $usageInfo .= PHP_EOL
            . "Usage: " . $argv[0] . " [-t <format>] [-f <filename>] [-O <filename>]" . PHP_EOL
            . "\t" . Output::getStyledString(' -h ', Output::COLOR_BLACK, Output::BG_YELLOW) . "\tThis help." . PHP_EOL
            . "\t" . Output::getStyledString(' -l ', Output::COLOR_BLACK, Output::BG_YELLOW) . "\tList all supported encoding format." . PHP_EOL
            . "\t" . Output::getStyledString(' -f ', Output::COLOR_BLACK, Output::BG_YELLOW) . "\tInput filename. STDIN by default." . PHP_EOL
            . "\t" . Output::getStyledString(' -t ', Output::COLOR_BLACK, Output::BG_YELLOW) . "\tOutput encoding type. php var_export by default." . PHP_EOL
            . "\t" . Output::getStyledString(' -O ', Output::COLOR_BLACK, Output::BG_YELLOW) . "\tOutput filename. STDOUT by default" . PHP_EOL . PHP_EOL;
        
        $usageInfo .= PHP_EOL . "Examples: " . PHP_EOL
            . "\t{$argv[0]} -f data.msgpack.txt -t json > result.json.txt" . PHP_EOL
            . "\tcat result.txt | {$argv[0]} -t msgpack > encoded.txt" . PHP_EOL
            . "\tcat result.txt | {$argv[0]} -O encoded.txt -t json" . PHP_EOL
            . "\tcat data.msgpack.txt | {$argv[0]}" . PHP_EOL . PHP_EOL;
        
        echo $usageInfo;
    }
    
    /**
     * List all codecs
     */
    public function showCodecList()
    {
        $codecNames = array_keys(self::$_codecs);
        $listInfo = '';
        
        foreach($codecNames as $name) {
            $listInfo .= "\t" . Output::getStyledString(" {$name} ", Output::COLOR_BLACK, Output::BG_YELLOW) . PHP_EOL;
        }
        
        echo $listInfo;
    }
    
    /**
     * Register a codec by name
     * 
     * @param string $name Codec name
     * @return null
     */
    public static function registerCodec($name)
    {
        $codec = Codec::load($name);
        
        if($codec instanceof Codec) {
            self::$_codecs[ $name ] = $codec;
            
        } else {
            throw new PHPCodecException("Invalid codec name");
        }
    }
    
    /**
     * Get all registered codecs
     *
     * @return array Codec array
     */
    public static function getRegisteredCodecs()
    {
        return self::$_codecs;
    }
    
    /**
     * Detect input data type and return the proper codec
     * 
     * @return Codec
     */
    public static function detectInputType()
    {
        //todo
    }
    
    /**
     * @param string $input
     * @return array
     */
    public static function decode($input)
    {
        $codecs = self::$_codecs;
        $data = null;
        $fromCodec = null;
        
        foreach($codecs as $codecName => $codec) {
            try {
                $data = $codec->decode($input);
                
            } catch(\Exception $e) {
                $data = null;
            }
            
            if( !empty($data) ) {
                $fromCodec = $codecName;
                break;
            }
        }
        
        return array($fromCodec, $data);
    }
    
    /**
     * Run PHPCodec
     */
    public function run()
    {
        $options = $this->_options;
        
        if( isset($options['h']) ) {
            $this->showUsage();
            return;
        }
        
        if( isset($options['l']) ) {
            $this->showCodecList();
            return;
        }
        
        $input = $this->_captrueInput();
        
        list($fromCodec, $decoded) = self::decode($input);
        
        if( empty($fromCodec) ) {
            throw new PHPCodecException('Invalid input type');
        }
        
        $output = '';
        $codecParamString = null;
        
        if( empty($options['t']) ) {
            $options['t'] = 'php';
            
        } else {
            if( strpos($options['t'], '[') !== false ) {
                if( preg_match('/(\w+)\[([\w,\-=\?]+)\]?/', $options['t'], $matches) ) {
                    $codecParamString = $matches[2];
                }
                
                $options['t'] = $matches[1];
            }
        }
        
        if( $options['t'] == $fromCodec ) {
            $output = $input;
        
        } else {
        
            if( !empty(self::$_codecs[ $options['t'] ]) ) {
                $codec = & self::$_codecs[ $options['t'] ];
                $output = $codec->encode($decoded, $codecParamString);
        
            } else {
                throw new PHPCodecException("Unknown output type");
            }
        }
        
        if( !empty($options['O']) ) {
            file_put_contents($options['O'], $output);
            
        } else {
            echo $output;
        }
    }
}
