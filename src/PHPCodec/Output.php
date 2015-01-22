<?php namespace PHPCodec;

final class Output
{
    const COLOR_BLACK = 30;
    const COLOR_RED = 31;
    const COLOR_GREEN = 32;
    const COLOR_YELLOW = 33;
    const COLOR_BLUE = 34;
    const COLOR_PURPLE = 35;
    const COLOR_CYAN = 36;
    const COLOR_WHITE = 37;
    
    const BG_BLACK = 40;
    const BG_RED = 41;
    const BG_GREEN = 42;
    const BG_YELLOW = 43;
    const BG_BLUE = 44;
    const BG_PURPLE = 45;
    const BG_CYAN = 46;
    const BG_WHITE = 47;
    
    /**
     * Print string with specified style (echo only)
     * 
     * @param string    $string     Original string
     * @param int       $color      Font color
     * @param int       $bgColor    Background color
     * @return string
     */
    public static function getStyledString($string, $color, $bgColor)
    {
        return "\033[{$bgColor};{$color}m{$string}\033[0m";
    }
}
