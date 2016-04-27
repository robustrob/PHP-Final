<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Register extends Controller
{
    public function index()
    {
        $error = Session::get('error');

        if($error != false) {
            $error = Error::getAllErrors($error);
        }
        else
            $error = "";

        $this->view('register/index', ['error' => $error]);

        Session::clear('error');
    }

    public function RegisterValidation()
    {
        parent::__construct();

        if(isset($_POST['register']))
        {
            $user = $this->model('User');
            $error = $user->createUser($_POST['reg_username'], $_POST['reg_password'], $_POST['reg_password_confirm'], $_POST['reg_email'], $_POST['reg_firstname'], $_POST['reg_lastname']);

            Session::set('error', $error);
            header("Location: /register/index");
        }
    }
}