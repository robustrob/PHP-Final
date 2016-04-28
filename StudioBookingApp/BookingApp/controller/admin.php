<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Admin extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if(Session::get("my_user")['id'] !== 1 && Session::get("my_user")['u_name'] !== 'admin')
        {
            echo 'unauthorized.';
            exit;
        }
    }

    public function index()
    {
        /*  Get Errors if any  */
        $error = Error::getAllErrors();

        if(isset(Session::get("my_user")['id']))
        {
            $this->view('admin/index', ['error' => $error, 'first_name' => Session::get("my_user")['first_name'], 'last_name' => Session::get("my_user")['last_name']  ] );
        }

        Session::clear('error');
    }
    //Edit Users
    /*****************************************************************************************************************/

    public function editusers()
    {
        $user = $this->model('User');
        $users = $user->getAllUsers();

        $error = Error::getAllErrors();
        $this->view('admin/editusers', ['error' => $error, 'users' => $users, 'first_name' => Session::get("my_user")['first_name'], 'last_name' => Session::get("my_user")['last_name']] );
        Session::clear('error');

    }

    public function AddUser()
    {
        if(isset($_POST['addUser']))
        {
            $user = $this->model('User');
            $error = $user->createUser($_POST['UserName'], $_POST['Password'], $_POST['ConfirmPassword'], $_POST['Email'], $_POST['FirstName'], $_POST['LastName']);
            Session::set('error', $error);
            header("Location: /admin/editusers");
        }
    }

    public function DeleteUser()
    {
        if(isset($_POST['deleteUser']))
        {
            $user = $this->model('User');
            $error = $user->deleteUser($_POST['DeleteUser']);
            Session::set('error', $error);
            header("Location: /admin/editusers");
        }
    }

    //Edit Availabilities
    /*****************************************************************************************************************/
    public function preferences()
    {
        $p = $this->model('Preferences');

        $AvailabilityData = $p->getAvailabilities();
        $rules = $p->getRules();

        $error = Error::getAllErrors();
        $this->view('admin/preferences',['error' => $error, 'availabilities' => $AvailabilityData, 'rules' => $rules ]);
        Session::clear('error');
    }

    public function UpdateAvailabilities()
    {
        if(isset($_POST['SaveAvailabilities']))
        {
            $p = $this->model('Preferences');
            $error = $p->updateAvailabilities($_POST['StartDay'],$_POST['EndDay'],$_POST['StartTime'],$_POST['EndTime']);
            Session::set('error', $error);
            header("Location: /admin/preferences");
        }
    }

    public function UpdateRules()
    {
        if(isset($_POST['save']))
        {
            $p = $this->model('Preferences');
            $error = $p->updateRules($_POST['minPayment'],$_POST['maxSessions']);
            Session::set('error', $error);
            header("Location: /admin/preferences");
        }
    }
}