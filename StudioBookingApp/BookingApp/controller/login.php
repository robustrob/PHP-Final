<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Login extends Controller
{
    public function index($error = 0)
    {
        $user = $this->model('User');
        $e = Errors::getErrors('login',$error);
        $this->view('login/index', ['error' => $e ]);
    }

    public function Authorize()
    {
        if(isset($_POST['login']))
        {
            $user = $this->model('User');

            $auth = $user->authenticate($_POST['username'], $_POST['password']);


            if($auth == 0)
            {
                if(strcmp($_POST['username'],"admin") == 0)
                    header("Location: /admin");
                else
                    header("Location: /home");
            }
            else
            {
                header("Location: /login/index/".$auth);
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