<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormData extends CI_Controller {

	public function formadd()
	{
        if($this->input->post('submit'))
		{
			$n=$this->input->post('name');
			$e=$this->input->post('email');
            $m=$this->input->post('mobile');
            $w=$this->input->post('website');
            $c=$this->input->post('comment');
            $data = array(
					
                'name'=>$n,
                'email'=>$e,
                'mobile'=>$m,
                'website'=>$w,
                'comment'=>$c,
            );

           
        
            $this->load->model('FormPage_Model');

            $this->FormPage_Model->ins_data($data);
           
        }else

        $this->load->model('FormPage_Model');

        $this->data['data']=$this->FormPage_Model->ret_data();
        
        $this->data['retcou']=$this->FormPage_Model->ret_count_data();

        $this->load->view('formpage' , $this->data);
    } 


    public function country_idpost()
    {
 
        $id=$this->input->post('id');

        $this->load->model('FormPage_Model');

        $cou['id'] = $id;

        $res=$this->FormPage_Model->ret_state_name($id);

        echo json_encode($res);
    }

     public function state_idpost()
        {
     
            $id=$this->input->post('id');

            $this->load->model('FormPage_Model');

            $cou['id'] = $id;

            $res=$this->FormPage_Model->ret_district_name($id);

            echo json_encode($res);
        }
    public function updatedata()
	{

        $id=$this->input->post('id');

        $this->load->model('FormPage_Model');

        $res['id'] = $id;

        $res=$this->FormPage_Model->displayrecordsById($id);

        echo json_encode($res);

        
        if($this->input->post('update'))
        {
            extract($_POST);

            $data = array(

                'id' => $id,
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'website' => $website,
                'comment' => $comment
            );

            print_r($data);

        $datas =  $this->FormPage_Model->update_records($data,$id);



        redirect('FormData/formadd');
        }

        //redirect('FormData/formadd', $rest);

       

        //$this->load->view('update_records',$res);
       
	}

    public function ret_modal_data()
    {
        $id=$this->input->get('id');

        $this->load->model('FormPage_Model');

        $res['id'] = $id;

        $response['retdataup']=$this->FormPage_Model->ret_modal_data($id);
    }
    public function deletedata()
    {
        $id=$this->input->get('id');
        $this->load->model('FormPage_Model');
        $res['id'] = $id;
        $res['data']=$this->FormPage_Model->displayrecordsById($id);
        $this->FormPage_Model->delete_records($id);
        redirect('FormData/formadd');
    }

} 
