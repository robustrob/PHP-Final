<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 27/04/2016
 * Time: 10:46 PM
 */
require_once '../BookingApp/core/Model.php';
class Preferences extends Model
{
    //Rules
    /******************************************************************************************************************/

    public function getAvailabilities()
    {
        $st = $this->db->select('SELECT * FROM weekly_availabilities',[]);
        return $st[0];
    }

    public function updateAvailabilities($startday,$endday,$starttime,$endtime)
    {
        $st = $this->db->update('weekly_availabilities',['a_startday' => $startday,'a_endday' => $endday,'a_starttime' => $starttime,'a_endtime' => $endtime, ],'a_id = 1');

        $error = new Error();
        if($st)
        {
            $error->addError('update-avail','updated');
        }
        else
        {
            $error->addError('update-avail','not-updated');
        }

        return $error;
    }





    //Rules
    /******************************************************************************************************************/
    public function getRules()
    {
        $st = $this->db->select('SELECT * FROM rules',[]);
        return $st[0];
    }

    public function getMinPayment()
    {
        $st = $this->db->select('SELECT * FROM rules',[]);
        return $st[0]['r_min_payment'];
    }

    public function getMaxSessions()
    {
        $st = $this->db->select('SELECT * FROM rules',[]);
        return $st[0]['r_max_sessions'];
    }

    public function updateRules($minPay, $maxSession)
    {
        $st = $this->db->update('rules',['r_min_payment' => $minPay, 'r_max_sessions' => $maxSession],'r_id = 1');

        $error = new Error();
        if($st)
        {
            $error->addError('update-rules','updated');
        }
        else
        {
            $error->addError('update-rules','not-updated');
        }

        return $error;

    }
}