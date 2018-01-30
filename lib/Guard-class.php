<?php
require_once _AUTOLOADER_;
use \Firebase\JWT\JWT;
class Guard extends JWT
{
    private $guardName,
            $requiresLvl = 0;

    public function Authenticate(stdClass $userData)
    {
        
        $payload = array(
            "iss" => "Modul test",
            "aud" => $userData->uid,
            "exp" => strtotime("+2 hour"),
            "iat" => time(), // Time stamp
            "nbf" => time(), // Time Stamp          
            "exp" => strtotime("+2 hour"),
            "data" => $userData
        );
        $this->userSession = JWT::encode($payload, _JWTKEY_);
        $_SESSION['global'] = $this->userSession;
        
    }

    public function __construct(string $guardName = '', int $requiredLvl = 0)
    {
        try
        {
            $this->guardName = $guardName;
            $this->requiresLvl = $requiredLvl;
            //$this->JWT_KEY = base64_encode($_SERVER['SERVER_ADDR']);
            if(!array_key_exists('global', $_SESSION))
            {
                $_SESSION['global'] = null;
            }
        }
        catch(Exception $e)
        {
            throw new Exception("ERROR [GUARD]: " . $e->getMessage());
        }
    }

    public function Protect()
    {
        try{
            if(!isset($_SESSION['global']))
            {
                Router::Redirect('/Login');
                return false;
            }
            
        }catch(Exception $err)
        {
            session_destroy();
            Router::Redirect('/Login');
            exit;
        }
    }

    public function decoding($Session)
    {
        return JWT::decode($Session, _JWTKEY_, array('HS256'));
    }

}
