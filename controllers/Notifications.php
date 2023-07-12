<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends CI_Controller
{
    /**
    *   @Function: newAppointment
    */
    function newAppointment()
    {
        $propertyArr = $this->db->select('id')->get_where(db_prefix().'property', array('agent_id' => get_client_user_id()))->result();
        $res = 0;
        $propertyID = [];
        if($propertyArr)
        {
            foreach($propertyArr as $rrr)
            {
                array_push($propertyID, $rrr->id);
            }
        }
        if($propertyArr)
        {
            $this->db->select('*');
            $this->db->from(db_prefix().'appointment_booking');
            $this->db->where_in('property_id', $propertyID);
            $this->db->where('client_view', 0);
            $query = $this->db->get();
            $res = $query->num_rows();
        }
        else
        {
            $res = 0;
        }
        
        echo $res;
    }
}
