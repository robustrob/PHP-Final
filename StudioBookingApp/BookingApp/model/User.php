<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 7:39 PM
 */
include '../BookingApp/core/Model.php';

class User extends Model
{
    private $userID;
    private $fname;
    private $lname;

    /**
     * _User constructor
     * @param int $tempID User_ID
     */
    public function __construct($tempID = -1)
    {
        parent::__construct();


    }

    public function store($st)
    {
        Session::set('my_user', [
            'id' => $st['u_id'],
            'first_name' => $st['u_first'],
            'last_name' => $st['u_last']
        ]);
    }

    /**
     * Verifies user/pass combo for website access
     * @param $username string username to verify
     * @param $password string hashed password to test
     * @return bool    result of the process....
     */
    public function authenticate($username, $password)
    {
        $username = strip_tags($username);
        $password = strip_tags($password);



        //Search db for user/password and get as array
        $st = $this->db->select('SELECT u_pass, u_salt FROM users WHERE u_name = :username', array(
            ':username' => $username
        ))[0];



        if (count($st) > 0)  // if count is not 0, user & password was right
        {
            $hash = hash('sha256', $st['u_salt'] . hash('sha256', $password));

            if (strcmp($hash, $st['u_pass']) !== 0) // Incorrect password. Redirect to login form.
                return 1;
            else // store to session and redirect to home
            {
                $st = $this->db->select('SELECT u_id, u_first, u_last FROM users WHERE u_name = :username', array(
                    ':username' => $username
                ))[0];


                $this->store($st); // store to session
                $this->db->update('users', ['login_ip' => $_SERVER['REMOTE_ADDR']], ' u_id = ' . $st['u_id'] , 'u_id = '.$st['u_id']); // log ip

                return 0;
            }


        }
        return 1;
    }

    public function createUser($username, $password, $confirm_password, $email, $first, $last)
    {
        //STRIP TAGS FOR XSS protection
        $username = strip_tags($username);
        $password = strip_tags($password);
        $confirm_password = strip_tags($confirm_password);
        $email = strip_tags($email);
        $first = strip_tags($first);
        $last = strip_tags($last);

        $errors = new Error();


        $st = $this->db->select('SELECT u_name FROM users WHERE u_name = :username', array(':username' => $username));

        $valid = true;

        if(!empty($st))
        {
            //user already exists
            $valid = false;
            $errors->addError('register',1);
        }

        $st = $this->db->select('SELECT u_email FROM users WHERE u_email = :email', array(':email' => $email));


        if(!empty($st))
        {
            //e-mail already exists
            $valid = false;
            $errors->addError('register',2);
        }

        if(strcmp($password,$confirm_password) != 0)
        {
            // passwords do not match
            $valid = false;
            $errors->addError('register',3);
        }



        if($valid == true) {


            require_once('../BookingApp/core/Hash.php');
            $salt = Hash::createSalt();
            $hashedpw = Hash::hashPassword($password, $salt);


            $st = $this->db->insert('users', ['u_name' => $username,
                'u_first' => $first,
                'u_last' => $last,
                'u_pass' => $hashedpw,
                'u_salt' => $salt,
                'u_email' => $email,
                'login_ip' => $_SERVER['REMOTE_ADDR']]);


            $errors->addError('adduser',1);
        }

        return $errors;

    }


}
