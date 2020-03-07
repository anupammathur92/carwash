<?php
class Subadmin extends CI_Controller
{
	public function index()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		$data["main_content"] = "Subadmin/add_subadmin";
		$this->load->view("Admin/template",$data);
	}
	public function add_subadmin()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if(!$this->input->post())
		{
			redirect(base_url());
		}
		$this->load->model("Subadmin_model");
		$this->Subadmin_model->add_subadmin();

		$data["main_content"] = "Subadmin/add_subadmin";
		$this->load->view("Admin/template",$data);
	}
	public function unique_email($email)
	{
		$this->db->where("email",$email);

		if($this->input->post("update_id"))
			$this->db->where("id !=",$this->input->post("update_id"));

		$admin_query = $this->db->get("admins");


		$customer_partner = $this->db->get_where("customer_partner",array("email"=>$email));


		if($admin_query->num_rows()>0 || $customer_partner->num_rows()>0)
		{
			$this->form_validation->set_message("unique_email","The Mobile Number You Entered , Already Exists. Please Enter A Unique Email");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function unique_mobile_number($mobile_number)
	{
		$this->db->where("mobile_number",$mobile_number);

		if($this->input->post("update_id"))
			$this->db->where("id !=",$this->input->post("update_id"));

		$admin_query = $this->db->get("admins");

		$customer_partner = $this->db->get_where("customer_partner",array("mobile_number"=>$mobile_number));

		if($admin_query->num_rows()>0 || $customer_partner->num_rows()>0)
		{
			$this->form_validation->set_message("unique_mobile_number","The Mobile Number You Entered , Already Exists. Please Enter A Unique Mobile Number");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function list_subadmin()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

        $this->load->library("pagination");
		$this->load->model("Subadmin_model");
		$subadmin_name = $this->input->get("subadmin_name") ? $this->input->get("subadmin_name") : "";
		$data["list_subadmins"] = $this->Subadmin_model->list_subadmin($limit,$start,$subadmin_name);

		$config["base_url"] = base_url()."Subadmin/list_subadmin";
        $config["total_rows"] = $this->Subadmin_model->count_subadmin($subadmin_name);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Subadmin/list_subadmin?subadmin_name=" . $subadmin_name;

		$config["suffix"] = "?subadmin_name=" . $subadmin_name;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;


		$data["main_content"] = "Subadmin/list_subadmin";
		$this->load->view("Admin/template",$data);
	}
	public function edit_subadmin($subadmin_id = FALSE)
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($subadmin_id)
		{
			$this->load->model("Subadmin_model");
			$data["subadmin_data"] = $this->Subadmin_model->get_subadmin_by_id($subadmin_id);
			$data["main_content"] = "Subadmin/edit_subadmin";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_subadmin()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($this->input->post())
		{
			$this->load->model("Subadmin_model");
			$data["subadmin_data"] = $this->Subadmin_model->update_subadmin();

			$data["main_content"] = "Subadmin/edit_subadmin";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function delete_subadmin($subadmin_id = FALSE)
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($subadmin_id)
		{
			$this->load->model("Subadmin_model");
			$this->Subadmin_model->delete_subadmin($subadmin_id);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>