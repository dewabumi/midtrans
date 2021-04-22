<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    	public function index()
	{

	$this->form_validation->set_rules('username', 'username', 'trim|required', array('required' => 'kolom username tidak boleh kosong'));
  $this->form_validation->set_rules('password', 'password', 'trim|required', array('required' => 'kolom password tidak boleh kosong'));

      if($this->form_validation->run() == FALSE){
        if(isset($this->session->userdata['login']))
          {
      		redirect('Admin');        
          }
            else
          {
            $this->load->view('konten/login');
          }
      }
      else
      {
        $data = array(
          'username'  => $this->input->post('username'),
          'password'  => $this->input->post('password'),
        );
        $result = $this->SubmissionModel->getUser($data);
        if($result == TRUE)
        {
          $username = $this->input->post('username');
          $result = $this->SubmissionModel->readUser($username);
          if($result != false)
          {
            $session_data = array(
            	'login'			    => TRUE,
              'username' 	 	  => $result[0]->username,
              'id'	 		      => $result[0]->id
            );
            $this->session->set_userdata($session_data);
            // redirect('Welcome');
            redirect('Admin');
          }
        }
        else
        {
  		        $data = array(
  		          'error_message' => 'Username Tidak terdaftar'
  		        );
  					$this->load->view('konten/login',$data);
  		      }
  		    }		
  		}
		
		public function logout()
	  	{
	    // destroy session
	    $sess_array = array(
	      'username' => ''
	    );
	    $this->session->unset_userdata('login', $sess_array);
	    $data['message_display'] = 'logout';
	    redirect('Auth');
	 	}
}