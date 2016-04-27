<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 26/04/2016
 * Time: 10:18 PM
 */
class Error
{
    private $type;
    private $code;

    public function __construct()
    {
        $this->type = array();
        $this->code = array();
    }

    public function addError($type, $code)
    {
        array_push($this->type, $type);
        array_push($this->code, $code);
    }

    public static function getAllErrors($e)
    {
        $errorHTML = "";

        if(!empty($e->type) && !empty($e->code)) {
            foreach ($e->type as $key => $value) {
                $errorHTML .= self::getErrors($value, $e->code[$key]) . "<br/>";
            }
        }

        return $errorHTML;
    }

    public static function isNull($e)
    {
        if(empty($e->type) && empty($e->code))
            return true;
        else
            return false;
    }


    private function getBootstrapError($type = '', $msg = '')
    {
        $indicator = "";

        switch ($type) {
            case 'success':
                $indicator = 'Success!';
                break;
            case 'danger':
                $indicator = 'Danger!';
                break;
            case 'info':
                $indicator = 'Info!';
                break;
            case 'warning':
                $indicator = 'Warning!';
                break;
        }


        return '<div class="alert alert-' . $type . '"> <strong>' . $indicator . '</strong> ' . $msg . '</div>';
    }

    public static function getErrors($method, $error)
    {
        if ($method == 'login') {
            switch ($error) {
                case 1:
                    $e = self::getBootstrapError('warning', 'Invalid Username or Password');
                    return $e;
                    break;

                default:
                    return "";
                    break;
            }
        } else if ($method == 'register') {
            switch ($error) {
                case 1:
                    $e = self::getBootstrapError('warning', 'Username already exists');
                    return $e;
                    break;
                case 2:
                    $e = self::getBootstrapError('warning', 'E-mail already registered. <br/>Forgot your password? Click <a href="/forgot"> here </a> ');
                    return $e;
                    break;
                case 3:
                    $e = self::getBootstrapError('warning', 'Passwords do not match');
                    return $e;
                    break;
                default:
                    return "";
                    break;
            }


        } else if ($method == 'logout') {
            switch ($error) {
                case 1:
                    $e = self::getBootstrapError('success', 'Logged out successfully');
                    return $e;
                    break;

                default:
                    return "";
                    break;
            }
        }
        else if($method == 'adduser')
        {
            switch($error)
            {
                case 1:
                    $e = self::getBootstrapError('success', 'User has been created. Please log in'); // redirected to login page
                    return $e;
                    break;
            }
        }
    }

}