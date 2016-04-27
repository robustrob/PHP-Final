<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 6:26 PM
 */
class Booking extends Controller
{
    public function index($date = '')
    {
        $this->model('Schedule');
        $this->view('booking/index', ['date' => $date]);
    }
}