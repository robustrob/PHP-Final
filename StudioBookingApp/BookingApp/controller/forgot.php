<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Forgot extends Controller
{
    public function index()
    {
        $this->view('forgot/index', []);
    }
}