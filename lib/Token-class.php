<?php

class Token{
    public static $token;
    public static $maxAge = 300;
    /**
     * Generates token in HEX 
     *
     * @return void
     */
    private static function generateToken(string $tokenName = 'default') : void
    {
        //if(empty($_SESSION['token']) && (empty($_SESSION['tokenAge']) || (time() - (int)$_SESSION['tokenAge']) > (int)$this->maxAge)){
            if(function_exists('random_bytes')){
                $_SESSION['token'][$tokenName] = bin2hex(random_bytes(32));
            }elseif(function_exists('mcrypt_create_iv')){
                $_SESSION['token'][$tokenName] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
            }else{
                $_SESSION['token'][$tokenName] = bin2hex(openssl_random_pseudo_bytes(32));
            }
            $_SESSION['tokenAge'][$tokenName] = time();
        //}        
    }
    /**
     * Checks token and the time bewteen token created and token age after POST
     *
     * @param string $token
     * @param int $maxAge (default = 300)
     * @return bool
     */
    public static function validateToken(string $tokenvalue, string $tokenName = 'default', int $maxAge = 300) : bool
    {
        self::$maxAge = $maxAge;
        if($tokenvalue != $_SESSION['token'][$tokenName] || ((time() - (int)$_SESSION['tokenAge'][$tokenName]) > (int)self::$maxAge)){
            return false;
        }else{
            unset($_SESSION['token'][$tokenName], $_SESSION['tokenAge'][$tokenName]);
            return true;
        }
    }
    /**
     * Create hidden input[name=_once | value=token] field with session token
     *
     * @return string html entity
     */
    public static function createTokenInput(string $tokenName = 'default') : string
    {
        self::generateToken($tokenName);
        return '<input type="hidden" name="_once_' . $tokenName . '" value="' . $_SESSION['token'][$tokenName] . '">';
    }
}
