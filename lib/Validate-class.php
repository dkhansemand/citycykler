<?php
/** 
 * Validation class 
 * @version 0.1.0
 * @author Andreas Hansson <3941133@rts-365.dk>
 */

class Validate{
    public static $phoneFormatted;
    /**
     * Validates name and checks that it is characters only
     *
     * @param string $char
     * @param int $min (default = 2) 
     * @param int $max (default = 25)
     * @return bool
     */
    public static function characters(string $char, int $min = 2,int $max = 25) : bool
    {
        return (
            isset($char) && 
            strlen((string)$char) >= (int)$min && 
            strlen((string)$char) <= (int)$max && 
            preg_match("/[a-zæøåäüö]+$/i", $char)
        ) ? true : false;
    }
    /**
     * Birthdate check if the date is valid (Not all datformats supported)
     *
     * @param string $date
     * @return bool
     */
    public static function birthdate(string $date) : bool
    {
        return
        (
            isset($date) &&
            (preg_match("~^\d{2}-\d{2}-\d{4}$~", $date) ||
            preg_match("~^\d{2}/\d{2}/\d{4}$~", $date) ||
            preg_match("~^\d{4}-\d{2}-\d{2}$~", $date) ||
            preg_match("~^\d{4}/\d{2}/\d{2}$~", $date))
        ) ? true : false;
    }
    
    /**
     * stringBetween checks string with both aplhanumeric & charcters on specific length
     *
     * @param string $str
     * @param int $min (default = 2)
     * @param int $max (default = 68)
     * @return bool
     */
    public static function stringBetween(string $str, int $min = 2, int $max = 68) : bool
    {
        return (
            isset($str) &&
            strlen((string)$str) >= (int)$min && 
            strlen((string)$str) <= (int)$max && 
            preg_match("/[A-ZÆØÅÂÔÛa-zæøåäüö\s0-9,.]+$/i", $str)
        ) ? true : false;
    }

    public static function currency(mixed $currency) : bool
    {
        return (
            isset($currency) && !empty($currency) &&
            preg_match("/^[0-9]+(?:\.[,0-9]{1,3})?$/im", $currency)
        ) ? true: false;
    }

    /**
     * intBetween check for int only and the min, max given
     *
     * @param string $int
     * @param int $min (default = 4)
     * @param int $max (default = 5)
     * @return bool
     */
    public static function intBetween(int $int, int $min = 4, int $max = 5) : bool
    {
        return (
            isset($int) &&
            is_numeric($int) &&
            strlen((string)$int) >= (int)$min && 
            strlen((string)$int) <= (int)$max
        ) ? true : false;
    }

    /**
     * Check if phonenumber is valid with country code included
     *
     * @param string $num
     * @return bool
     */
    public static function phone(int $num) : bool
    {
        if(isset($num) && strlen($num) >= 8 ){
            $num = str_replace(' ', '', $num);
            $num = (int)preg_replace("/(^[+]\d{2} | ^00\d{2})/x", "", $num);
            if(is_numeric($num)){
                self::$phoneFormatted = $num;
                return true;
            }
        }
        return false;
    }

    /**
     * E-mail validation with PHP filter_var
     *
     * @param string $email
     * @return bool
     */
    public static function email(string $email) : bool
    {
        return (
            isset($email) &&
            filter_var($email, FILTER_VALIDATE_EMAIL)
        ) ? true : false;
    }

    /**
     * check if the 2 parameters if the same dataypte
     *
     * @param mixed $x
     * @param mixed $y
     * @return bool
     */
    public static function match($x, $y) : bool
    {
        return $x === $y ? true : false;
    }

    /**
     * Checks if $var is set and greater or equals to $min
     *
     * @param mixed $var
     * @param int $min
     * @param int $max
     * @return bool
     */
    public static function mixedBetween(string $var, int $min = 2, int $max = 255) : bool
    {
        return (
            isset($var) &&
            strlen($var) >= $min && 
            strlen($var) <= $max
        ) ? true : false;
    }
}
