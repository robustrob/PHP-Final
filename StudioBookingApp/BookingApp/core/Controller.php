<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:22 PM
 */

require_once 'Session.php';
require_once 'Error.php';

class Controller {

    public function __construct()
    {
        Session::init(); //init session for all pages
    }


    public function model($model)
    {
       // if(file_exists('../BookingApp/model/'.$model.'.php')) {
            require_once('../BookingApp/model/'.$model.'.php');
            return new $model();
        /*}
        else{
            echo 'Model does not exist.';
            exit;
        }*/
    }

    public function view($view, $data = [])
    {
        if(file_exists('../BookingApp/view/'. $view . '.php')) {
            require_once '../BookingApp/view/' . $view . '.php';
        }
        else{
            echo 'View does not exist.';
            exit;
        }
    }

}