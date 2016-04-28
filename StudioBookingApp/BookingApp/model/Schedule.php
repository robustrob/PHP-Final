<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 8:31 PM
 */

require_once '../BookingApp/core/Model.php';

class Schedule extends Model
{
    private $dayLabels = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

    public function dayIsAvailable($date)
    {
        $st = $this->db->select('SELECT a_startday, a_endday FROM weekly_availabilities ',[]);

        $start = $st[0]['a_startday'];
        $end = $st[0]['a_endday'];

        foreach($this->dayLabels as $key => $value)
        {
            if($start == $value)
                $start = $key;

            if($end == $value)
                $end = $key;
        }

        $day = date('l',strtotime($date));

        foreach($this->dayLabels as $key => $value)
        {
            if($day == $value)
                $day = $key;
        }

        if($day >= $start && $day <= $end)
            return true;
        else
            return false;

    }

    public function sessionIsAvailable($date, $start,$end, $avails)
    {
        $sessions = self::getSessions($date);

        $date = date ("Y-m-d", strtotime($date));
        $startDateTime = date ("Y-m-d H:i:s", strtotime($date . ' ' . $start));
        $endDateTime = date ("Y-m-d H:i:s", strtotime($date . ' ' . $end));

        $startTime = date ("H:i:s", strtotime($start));
        $endTime = date ("H:i:s", strtotime($end));

        $isAvailable = true;

        for($i = 0; $i < count($sessions); $i++)
        {
            if($startDateTime > $sessions[$i]['s_start'] && $startDateTime < $sessions[$i]['s_end'])
                $isAvailable = false;
            else if($endDateTime > $sessions[$i]['s_start'] && $endDateTime < $sessions[$i]['s_end'])
                $isAvailable = false;
            else if( $startTime < $avails['a_starttime'] || $endTime > $avails['a_endtime'])
                $isAvailable = false;

        }

        return $isAvailable;
    }

    private function getSessions($date)
    {
        $start = date ("Y-m-d H:i:s", strtotime($date));
        $end = date ("Y-m-d H:i:s", strtotime($date.' +1 day'));

        $st = $this->db->select("SELECT s_id, s_start, s_end FROM sessions WHERE s_start >= :s_start AND s_start < :s_end",['s_start' => $start, 's_end' => $end] , PDO::FETCH_ASSOC);

        return $st;
    }

    public function BookASession($booking, $billing, $id)
    {
        $error = new Error();

        $date = date ("Y-m-d", strtotime($booking['date']));
        $startDateTime = date ("Y-m-d H:i:s", strtotime($booking['date'] . ' ' . $booking['StartTime']));
        $endDateTime = date ("Y-m-d H:i:s", strtotime($booking['date'] . ' ' . $booking['EndTime']));

        $payment = $billing['PaymentMethod'];
        $card = $billing['CreditCard'];

        $fname = $billing['FirstName'];
        $lname = $billing['LastName'];
        $add = $billing['Address'];
        $city = $billing['City'];
        $province = $billing['Province'];
        $country = $billing['Country'];
        $zip = $billing['Zip'];

        $uid = $id;

        $st = $this->db->insert('billing', ['u_id' => $uid,
            'b_fname' => $fname,
            'b_lname' => $lname,
            'b_address' => $add,
            'b_city' => $city,
            'b_state' => $province,
            'b_country' => $country,
            'b_zip' => $zip,
            'b_cc' => $card]);



        $Billing_Id = $this->db->select('SELECT LAST_INSERT_ID()',[])[0]['LAST_INSERT_ID()'];


        $st = $this->db->insert('payment', ['p_status' => 1, 'p_method' => $payment, 'b_id' => $Billing_Id]);
        $Payment_id = $this->db->select('SELECT LAST_INSERT_ID()',[])[0]['LAST_INSERT_ID()'];

        $this->db->insert('sessions',
            ['s_start' => $startDateTime,
            's_end' => $endDateTime,
            'u_id' => $uid,
            's_type' => 1,
                's_desc' => 'Description',
            'p_id' => $Payment_id]);

        $error->addError('booking','payment-complete');

        Session::set('error', $error);
        header("Location: /home");

    }


}