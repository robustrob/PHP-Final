<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Admin extends Controller
{
    public function index()
    {
        $this->view('admin/index', []);

        if(isset(Session::get("my_user")['id']))
        {
            $this->view('admin/index', ['first_name' => Session::get("my_user")['first_name'], 'last_name' => Session::get("my_user")['last_name']  ] );
        }
        else
        {
            $this->view('admin/index', []);
        }
    }

    public function adduser()
    {
        if(isset(Session::get("my_user")['id']))
        {
            $this->view('admin/Adduser', ['first_name' => Session::get("my_user")['first_name'], 'last_name' => Session::get("my_user")['last_name']  ] );
        }
        else
        {
            $this->view('admin/Adduser', []);
        }
    }

    public function deleteuser()
    {
        if(isset(Session::get("my_user")['id']))
        {
            $this->view('admin/Deleteuser', ['first_name' => Session::get("my_user")['first_name'], 'last_name' => Session::get("my_user")['last_name']  ] );
        }
        else
        {
            $this->view('admin/Deleteuser', []);
        }
    }
}