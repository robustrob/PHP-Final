<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 28/04/2016
 * Time: 12:13 AM
 */

require_once '../BookingApp/core/Model.php';

class Payment extends Model
{

    public function GetPaymentMethods()
    {
        $st = $this->db->select('SELECT * FROM payment_method',[]);

        $options = "";

        for($i = 0; $i < count($st); $i++)
        {
            $options .= '<option value="'.$st[$i]['m_id'].'">'.$st[$i]['m_name'].'</option>';

        }

        return $options;
    }

    public function GetPaymentMethodByID($id)
    {
        $st = $this->db->select('SELECT m_name FROM payment_method WHERE m_id = :id',['id' => $id]);

        return $st[0]['m_name'];
    }

}