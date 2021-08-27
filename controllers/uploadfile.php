<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UploadFile extends CI_Controller {

	public function fileadd()
    {
      
        $this->load->model('UploadFile_Model');
        $for['data']=$this->UploadFile_Model->ret_data();
        $this->load->view('add_employees', $for);
    }

     public function addfilesubmit()
     {
        if($this->input->post('submit'))
        {
            $n=$this->input->post('name');
            $a=$this->input->post('address');
            $sal=$this->input->post('salary');
            $data = array(
                    
                'name'=>$n,
                'address'=>$a,
                'salary'=>$sal,
            );
        
            $this->load->model('UploadFile_Model');
            $this->UploadFile_Model->ins_data($data);
            redirect('UploadFile/fileadd');
        }else
        $this->load->view('newfileadd');
     }   
         public function updatefiledata()
        {
             $id=$this->input->get('id');
             $this->load->model('UploadFile_Model');
             $res['id'] = $id;
             $res['data']=$this->UploadFile_Model->displayrecordsById($id);
             
             if($this->input->post('update'))
                 {
                     extract($_POST);
                     $data = array(
                         'name'=>$name,
                         'address'=>$address,
                         'salary'=>$salary,
                     );

                 $datas =  $this->UploadFile_Model->update_records($data,$id);

                 redirect('UploadFile/fileadd');
                 }

                 $this->load->view('uploadfile_records',$res);
            
        }

         public function deletefiledata()
         {
             $id=$this->input->get('id');
             $this->load->model('UploadFile_Model');
             $res['id'] = $id;
             $res['data']=$this->UploadFile_Model->displayrecordsById($id);
             $this->UploadFile_Model->delete_records($id);
             redirect('UploadFile/fileadd');
         }


} 
