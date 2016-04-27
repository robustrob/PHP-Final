<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Home extends Controller
{
    public function index($logout = 0)
    {
        $calendar = $this->model('Calendar');

        $logout = Errors::getErrors('logout',$logout);



        if(isset(Session::get("my_user")['id']))
        {
            $this->view('home/index', ['logout' => $logout,'first_name' => Session::get("my_user")['first_name'], 'last_name' => Session::get("my_user")['last_name']  ] );
        }
        else
        {
            $this->view('home/index', ['logout' => $logout]);
        }

    }
}