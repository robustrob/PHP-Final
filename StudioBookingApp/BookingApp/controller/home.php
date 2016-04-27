<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Home extends Controller
{
    public function index()
    {
        $calendar = $this->model('Calendar');


        if(isset(Session::get("my_user")['id']))
        {
            $this->view('home/index', ['first_name' => Session::get("my_user")['first_name'], 'last_name' => Session::get("my_user")['last_name']  ] );
        }
        else
        {
            $this->view('home/index', []);
        }

    }
}