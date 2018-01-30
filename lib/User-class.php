<?php

class User extends Database
{
    public static function Login(string $username, string $pwd)
    {
        $userQuery = (new self)->query("SELECT `userId`, `username`, `password`, `fullname`, `userEmail` from `users` WHERE `username` = LOWER(:UNAME)", [':UNAME' => $username]);
        if($userQuery->rowCount() === 1){
            $userInfo = $userQuery->fetch();
            var_dump($userInfo);
            if($username === $userInfo->username && password_verify($pwd, $userInfo->password)){
                $userData = new stdClass();
                $userData->uid = $userInfo->userId;
                $userData->fullname = $userInfo->fullname;
                $userData->username = $userInfo->username;
                $userData->email = $userInfo->userEmail;
                (new Guard())->Authenticate($userData);
                return true;
            }
        }
        return false;
    }

    public static function GetInfo()
    {
        return isset($_SESSION['global']) ? (new Guard())->decoding($_SESSION['global'])->data : NULL;
    }
}
