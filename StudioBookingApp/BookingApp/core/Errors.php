<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 26/04/2016
 * Time: 10:18 PM
 */

class Errors
{

    private function getBootstrapError($type = '', $msg = '')
    {
        $indicator = "";

        switch($type)
        {
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


        return '<div class="alert alert-'.$type.'"> <strong>'.$indicator.'</strong> '.$msg.'</div>';
    }

    public static function getErrors($method, $error)
    {
        if($method == 'login') {
            switch ($error) {
                case 1:
                    $e = self::getBootstrapError('warning','Invalid Username or Password');
                    return $e;
                    break;

                default:
                    return "";
                    break;
            }
        }
        else if($method == 'register')
        {
            /* switch ($error) {
                 case 0:
                     return "";
                     break;

                 case
             }*/
        }
        else if($method == 'logout')
        {
            switch ($error) {
                case 1:
                    $e = self::getBootstrapError('success','Logged out successfully');
                    return $e;
                    break;

                default:
                    return "";
                    break;
            }
        }
    }
}