<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$data["main_content"] = "Admin/home";
		$this->load->view("Admin/template",$data);
	}
	public function login()
	{
        if($this->session->userdata("logged_in"))
        {
            redirect(base_url()."Admin/index");
        }
        else
        {
            if($this->input->post())
            {
            	$this->load->model("Admin_model");
                $this->form_validation->set_rules('loginusername','User Name','required|trim');
                $this->form_validation->set_rules('loginpassword','Password','required|trim'); 
                if($this->form_validation->run())
            	{
                    $result = $this->Admin_model->check_login();

                    if ($result) {
                        $sess_array = array();
                            $sess_array = array(
                                'userid' => $result["mobile_number"],
                                'username' => $result["name"],
                                'user_type' => $result["user_type"]
                            );
                            $this->session->set_userdata('logged_in', $sess_array);
                            $values = array(
                                'umid' => $this->session->userdata['logged_in']['umid'],
                                'loginname' => $this->session->userdata['logged_in']['uname'],
                                'logintime' => date('Y-m-d H:i:s'));
                            redirect(base_url()."Admin/index");
                    }
                    else
                    {
                        $this->session->set_flashdata("invalid_credential","Please Enter Valid Credentials");
                        redirect(base_url()."Admin/login");
                    }
                }
                else
                {
                        $this->load->view('Admin/login');
                }
            }
            else
            {
                $this->load->view('Admin/login');
            }            
        }
	}
    public function Logout() 
    {
        $this->session->sess_destroy();
        redirect(base_url()."Admin/login");
    }
}
?>