<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    private function logged_in() 
    {
        if(! $this->session->userdata('authenticated')) {
            redirect('users/login');
        }
    }
    
    public function index()
    {
        $data['title'] = "Dashboard";
        //$this->load->view('header', $data);
        $this->load->view('dashboard/index', $data);
        //$this->load->view('footer', $data);
    }
}
?>