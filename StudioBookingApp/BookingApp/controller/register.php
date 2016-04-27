<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Register extends Controller
{
    public function index($error = 0)
    {
        $this->view('register/index', ['error' => $error]);
    }

    public function register()
    {
        if(isset($_POST['register']))
        {
            $user = $this->model('User');
            $result = $user->createUser($_POST['reg_username'], $_POST['reg_password'], $_POST['reg_password_confirm'], $_POST['reg_email'], $_POST['reg_firstname'], $_POST['reg_lastname']);

            if($result == 0)
            {
                header("Location: /login");
            }
            else
            {
                header("Location: /register/index/".$result);
            }
        }
    }
}