<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_Country_Controller extends CI_Controller {

	 public function __construct()
	 {
	  parent::__construct();
	  //$this->load->model('csv_import_model');
	  $this->load->library('Csvimport');
	 }

	public function sc_insert()
    {   
    	//$this->load->library('Csvimport');
		$this->load->model('State_Country_Model');
		$for['data']=$this->State_Country_Model->ret_data();
        $this->load->view('state_country_insert',$for);
    }

    public function import_data()
	{ 
        //$this->load->view('state_country_insert');
		if(isset($_POST["submit"]))
			
		print_r($_POST);
		{
			$file = $_FILES['file']['tmp_name'];
			$handle = fopen($file, "r");
			print_r($file);
			$c = 0;//
			while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
			{
				$state_name = $filesop[0];
				//$state_name = $filesop[1];
				if($c<>0){					/* SKIP THE FIRST ROW */
					$this->State_Country_Model->ins_data($state_name);
				}
				$c = $c + 1;
			}
			echo "sucessfully import data !";
				
		}
	}
    	


}