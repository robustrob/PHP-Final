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

    private static function getAllErrorsHTML($e)
    {
        $errorHTML = "";

        if (!empty($e->type) && !empty($e->code)) {
            foreach ($e->type as $key => $value) {
                $errorHTML .= self::getErrorMessage($value, $e->code[$key]) . "<br/>";
            }
        }

        return $errorHTML;
    }

    public static function getAllErrors()
    {
        $error = Session::get('error');
        if ($error != false)
            $error = Error::getAllErrorsHTML($error);
        else
            $error = "";

        return $error;
    }

    public static function isNull($e)
    {
        if (empty($e->type) && empty($e->code))
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

    private static function getErrorMessage($method, $error)
    {
        if ($method == 'login') {
            switch ($error) {
                case 'invalid-credentials':
                    $e = self::getBootstrapError('warning', 'Invalid Username or Password');
                    return $e;
                    break;

                default:
                    return "";
                    break;
            }
        } else if ($method == 'register') {
            switch ($error) {
                case 'username-exists':
                    $e = self::getBootstrapError('warning', 'Username already exists');
                    return $e;
                    break;
                case 'email-exists':
                    $e = self::getBootstrapError('warning', 'E-mail already registered. <br/>Forgot your password? Click <a href="/forgot"> here </a> ');
                    return $e;
                    break;
                case 'password-match':
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
        } else if ($method == 'adduser') {
            switch ($error) {
                case 'user-added':
                    $e = self::getBootstrapError('success', 'User has been created.');
                    return $e;
                    break;
            }
        } else if ($method == 'deleteuser') {
            switch ($error) {
                case 'deleted':
                    $e = self::getBootstrapError('success', 'User has been deleted.');
                    return $e;
                    break;
                case 'not-deleted':
                    $e = self::getBootstrapError('danger', 'User has not been deleted. Contact System Administrator');
                    return $e;
                    break;
            }
        } else if ($method == 'update-avail') {
            switch ($error) {
                case 'updated':
                    $e = self::getBootstrapError('success', 'Availabilities have been updated.');
                    return $e;
                    break;
                case 'not-updated':
                    $e = self::getBootstrapError('danger', 'Availabilities have not been updated. Contact System Administrator');
                    return $e;
                    break;
            }
        } else if ($method == 'update-rules') {
            switch ($error) {
                case 'updated':
                    $e = self::getBootstrapError('success', 'Rules have been updated.');
                    return $e;
                    break;
                case 'not-updated':
                    $e = self::getBootstrapError('danger', 'Rules have not been updated. Contact System Administrator');
                    return $e;
                    break;
            }
        } else if ($method == 'booking') {
            switch ($error) {
                case 'invalid-time':
                    $e = self::getBootstrapError('warning', 'Cannot book a session at that time. Please try again.');
                    return $e;
                    break;
                case 'payment-complete':
                    $e = self::getBootstrapError('success', 'Session has been booked. Payment has been complete. Thank you.');
                    return $e;
                    break;
                default:
                    return "";
                    break;
            }
        }else
            return "";

    }

}