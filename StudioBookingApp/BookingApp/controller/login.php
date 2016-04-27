<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Login extends Controller
{
    public function index()
    {
        $this->view('login/index', []);
    }

    public function Authorize()
    {
        if(isset($_POST['login']))
        {
            $user = $this->model('User');

            if($user->authenticate($_POST['username'], $_POST['password']))
            {
                if(strcmp($_POST['username'],"admin") == 0)
                    header("Location: /admin");
                else
                    header("Location: /home");
            }
            else
            {
                header("Location: /login/error");
            }


        }
    }

    public function logout()
    {
        Session::destroy();
        header("Location: /home");
        exit;
    }
}