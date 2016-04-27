<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:20 PM
 */

class BookingApp
{
    protected $_controller = 'home'; // default controller
    protected $_method = 'index'; // default loading method

    protected $_params = array(); // empty array

    public function __construct()
    {
        $url = $this->parseURL();

        if(file_exists( '../BookingApp/controller/'. $url[0] . '.php' )  )
        {
            $this->_controller = $url[0];
            unset($url[0]);
        }

        require_once('../BookingApp/controller/'. $this->_controller.'.php');

        $this->_controller = new $this->_controller;

        if(isset($url[1])) //  method
        {
            if(method_exists($this->_controller, $url[1]))
            {
                $this->_method = $url[1];
                unset($url[1]);
            }
        }

        $this->_params = $url ? array_values($url) : [] ;

        call_user_func_array([$this->_controller, $this->_method ], $this->_params);


    }

    public function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $ret = explode('/', $url);
    }

}