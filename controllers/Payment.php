<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use app\services\ValidatesContact;
class Payment extends ClientsController {
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library("session");
       $this->load->helper('url');
       
       if(empty(get_client_user_id()))
       {
           redirect(base_url(), 'refresh');
       }
    }
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index()
    {
        $this->load->view('my_stripe');
    }
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
        $data = $this->input->post();
        $plandetails = $this->db->get_where(db_prefix().'subscription', array('id' => $data['planid']))->row();
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
        
        $charge = \Stripe\Charge::create ([
                "amount" => $plandetails->price * 100,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => "Reppointment subscription" 
        ]);
        //echo '<pre>'; print_r($_POST); print_r($charge); die;
        if($charge['status'] == 'succeeded')
        {
            $listingQty = $this->db->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row('property_limit');
            $newlimit = $listingQty + $plandetails->qty;
            $userdata['plan_id'] = $plandetails->id;
            $userdata['property_limit'] = $newlimit;
            $userdata['plan_expired'] = strtotime('+1 months');
            $this->db->where('userid', get_client_user_id());
            $this->db->update(db_prefix().'contacts', $userdata);
            
            $transdata['userid'] = get_client_user_id();
            $transdata['planid'] = $plandetails->id;
            $transdata['transactionid'] = $charge['balance_transaction'];
            $transdata['receipt_url'] = $charge['receipt_url'];
            $transdata['created'] = $charge['created'];
            $transdata['status'] = $charge['status'];
            
            $this->db->insert(db_prefix().'transaction', $transdata);
            
            set_alert('success', _l('Payment made successfully.'));
            //redirect(site_url('clients/addListing'));
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            $this->session->set_flashdata('success', 'Payment is not done, Please try again.');
            redirect('/my-stripe', 'refresh');
        }
    }
}