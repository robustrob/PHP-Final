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
        $this->model('Calendar');
        $this->view('booking/index', ['date' => $date]);
    }

    public function booksession($date = '')
    {
        $error = Error::getAllErrors();


        $p = $this->model('Preferences');
        $minPayment = $p->getMinPayment();

        $this->view('booking/booksession',['error' => $error, 'date' => $date, 'minPayment' => $minPayment]);
        Session::clear('error');
    }

    //CHECKS IF DESIRED SESSION IS AVAILABLE
    public function validateSession()
    {
        $s = $this->model('Schedule');

        if(isset($_POST['checkout']))
        {
            $date =  $_POST['date'];
            $start = $_POST['StartTime'];
            $end = $_POST['EndTime'];

            $p = $this->model('Preferences');
            $avail = $p->getAvailabilities();


            $s->sessionIsAvailable($date,$start,$end,$avail);

            if($s->sessionIsAvailable($date,$start,$end,$avail))
            {
                Session::set('BookingInfo',$_POST);
                header("Location: /booking/checkout");
            }
            else
            {
                $error = new Error();
                $error->addError('booking','invalid-time');

                Session::set('error', $error);

                header("Location: /booking/booksession/".$date);
            }

        }
    }

    public function checkout()
    {
        $error = Error::getAllErrors();

        $p = $this->model('Payment');
        $payment = $p->GetPaymentMethods();

        $this->view('booking/checkout',['error' => $error, 'PaymentMethods' => $payment]);
        Session::clear('error');
    }

    public function confirmSession()
    {
        if(isset($_POST['confirm']))
        {
            $BookingInfo = Session::get('BookingInfo');
            $BillingInfo = $_POST;

            $confirmation = '<table>';
            $confirmation .= '<tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>Date:</td>';
            $confirmation .= '<td>';
            $confirmation .= $BookingInfo['date'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<td>Start Time:</td>';
            $confirmation .= '<td>';
            $confirmation .= $BookingInfo['StartTime'];
            $confirmation .= '</td>';
            $confirmation .= '<td>End Time:</td>';
            $confirmation .= '<td>';
            $confirmation .= $BookingInfo['EndTime'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>Payment Method: </td>';
            $confirmation .= '<td>';

            $p = $this->model('Payment');

            $confirmation .= $p->GetPaymentMethodByID($BillingInfo['PaymentMethod']);
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>Credit Card: </td>';
            $confirmation .= '<td>';
            $confirmation .= $BillingInfo['CreditCard'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>First Name: </td>';
            $confirmation .= '<td>';
            $confirmation .= $BillingInfo['FirstName'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>Last Name: </td>';
            $confirmation .= '<td>';
            $confirmation .= $BillingInfo['LastName'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>Address: </td>';
            $confirmation .= '<td>';
            $confirmation .= $BillingInfo['Address'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>City: </td>';
            $confirmation .= '<td>';
            $confirmation .= $BillingInfo['City'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>Province: </td>';
            $confirmation .= '<td>';
            $confirmation .= $BillingInfo['Province'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>Country: </td>';
            $confirmation .= '<td>';
            $confirmation .= $BillingInfo['Country'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';

            $confirmation .= '<tr>';
            $confirmation .= '<td>Zip</td>';
            $confirmation .= '<td>';
            $confirmation .= $BillingInfo['Zip'];
            $confirmation .= '</td>';
            $confirmation .= '</tr>';
            $confirmation .= '</table>';


            Session::set('confirmation',$confirmation);
            Session::set('BillingInfo',$BillingInfo);
            header("Location: /booking/confirm");

        }
    }


    public function confirm()
    {
        $error = Error::getAllErrors();
        $confirmation = Session::get('confirmation');
        $this->view('booking/confirm',['error' => $error, 'confirmation' => $confirmation]);
        Session::clear('error');
    }

    public function BookASession()
    {
        $BookingInfo = Session::get('BookingInfo');
        $BillingInfo = Session::get('BillingInfo');

        $id = Session::get('my_user')['id'];

        $s = $this->model('Schedule');
        $result = $s->BookASession($BookingInfo,$BillingInfo,$id);



    }
}