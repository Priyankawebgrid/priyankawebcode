<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('users_model');
    }
    
    private function logged_in()
    {
        if( ! $this->session->userdata('authenticated')){
            redirect('users/login');
        }
    }
    
    public function login()
    {
        $data['title'] = "Login";
        
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == false){
            //$this->load->view('header', $data);
            $this->load->view('users/login', $data);
            //$this->load->view('footer', $data);
        } 
        else {
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));
            
            $user = $this->users_model->login($email, $password);
            
            if($user){
                $userdata = array(
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'authenticated' => TRUE
                );
                
                $this->session->set_userdata($userdata);
                
                redirect('dashboard');
            }
            else {
                $this->session->set_flashdata('message', 'Invalid email or password');
                redirect('Users/login');
            }
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy(); 
        echo 1;
        //redirect('Users/login');
    }

    public function signin(){
        
        $data['title'] = "Signin";
        
        $this->form_validation->set_rules('fname', 'fname', 'required');
        $this->form_validation->set_rules('lname', 'lname', 'required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == false){
            //$this->load->view('header', $data);
            $this->load->view('Users/signin', $data);
            //$this->load->view('footer', $data);
        }
        else {
            $fname = $this->security->xss_clean($this->input->post('fname'));
            $lname = $this->security->xss_clean($this->input->post('lname'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));
            
                $userdata = array(
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'password' => $password,
                    'active' => '1',
                    'created_at' => date("Y-m-d h:i:sa")
                );
                $this->load->model('Users_model');
				$this->Users_model->signin($userdata);
                $userdata['authenticated'] = 1;
                $this->session->set_userdata($userdata);
                // exit;
                redirect('Dashboard/index');
           
        }
    }

}
?>