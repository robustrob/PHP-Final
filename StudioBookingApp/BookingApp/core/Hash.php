<?php

/**
 * Created by PhpStorm.
 * User: cstuser
 * Date: 4/26/2016
 * Time: 10:39 AM
 */
class Hash
{
    public function createSalt()
    {
        $text = md5(uniqid(rand(), true));
        return substr($text, 0, 3);
    }

    public function hashPassword($password, $salt)
    {
        $hash = hash('sha256', $password);
        $hashedpw = hash('sha256', $salt . $hash);
        return $hashedpw;
    }
}