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
        $user = $this->model('User');
        $error = Error::getAllErrors();
        $this->view('login/index', ['error' => $error ]);
        Session::clear('error');
    }

    public function Authorize()
    {
        if(isset($_POST['login']))
        {
            $user = $this->model('User');

            $auth = $user->authenticate($_POST['username'], $_POST['password']);


            if($auth['login'] == 0)
            {
                if(strcmp($_POST['username'],"admin") == 0)
                    header("Location: /admin");
                else
                    header("Location: /home");
            }
            else
            {
                Session::set('error', $auth['error']);
                header("Location: /login/index");
            }


        }
    }

    public function logout()
    {
        Session::destroy();
        header("Location: /home/index/1");
        exit;
    }
}