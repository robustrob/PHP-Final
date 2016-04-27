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
            $this->view('admin/Adduser', ['first_name' => Session::get("my_user")['first_name'], 'last_name' => Session::get("my_user")['last_name']] );
            
        }
        else
        {
            $this->view('admin/Adduser', []);
        }
        
        if(isset($_POST['adduser']))
        {
            // i guess this is the salt :X
            require_once ('../BookingApp/core/Hash.php');
            $salt = Hash::createSalt();
            $hashedpw = Hash::hashPassword($password,$salt);
            
            $user = $this->model('User');
            $st = $this->db->insert('users',[ 'u_name' => $_POST['uname'] ,
                                                'u_first' => $_POST['fname'],
                                                'u_last' => $_POST['lname'],
                                                'u_pass' => $_POST['password'],
                                                'u_email' => $_POST['email'],
                                                'u_salt' => $salt, // idk where to get the salt from
                                                'login_ip' => $_SERVER['REMOTE_ADDR'] ]);
            
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