<?php
class Partner extends CI_Controller
{
	public function index()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		$data["main_content"] = "Partner/add_partner";
		$this->load->view("Admin/template",$data);
	}
	public function add_partner()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($this->input->post())
		{
			$this->load->model("Partner_model");
			$this->Partner_model->add_partner();

			$data["main_content"] = "Partner/add_partner";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function unique_mobile_number($mobile_number)
	{
		$this->db->where("mobile_number",$mobile_number);

		if($this->input->post("update_id"))
			$this->db->where("id !=",$this->input->post("update_id"));

		$customer_partner = $this->db->get("customer_partner");

		$admin_query = $this->db->get_where("admins",array("mobile_number"=>$mobile_number));

		if($customer_partner->num_rows()>0 || $admin_query->num_rows()>0)
		{
			$this->form_validation->set_message("unique_mobile_number","The Mobile Number You Entered , Already Exists. Please Enter A Unique Mobile Number");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function unique_email($email)
	{
		$this->db->where("email",$email);

		if($this->input->post("update_id"))
			$this->db->where("id !=",$this->input->post("update_id"));

		$customer_partner = $this->db->get("customer_partner");


		$admin_query = $this->db->get_where("admins",array("email"=>$email));


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
	public function list_partner()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

        $this->load->library("pagination");
		$this->load->model("Partner_model");
		$partner_name = $this->input->get("partner_name") ? $this->input->get("partner_name") : "";
		$data["list_partners"] = $this->Partner_model->list_partner($limit,$start,$partner_name);

		$config["base_url"] = base_url()."Partner/list_partner";
        $config["total_rows"] = $this->Partner_model->count_partner($partner_name);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Partner/list_partner?partner_name=" . $partner_name;

		$config["suffix"] = "?partner_name=" . $partner_name;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;


		$data["main_content"] = "Partner/list_partner";
		$this->load->view("Admin/template",$data);
	}
	public function edit_partner($partner_id = FALSE)
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($partner_id)
		{
			$this->load->model("Partner_model");
			$data["partner_data"] = $this->Partner_model->get_partner_by_id($partner_id);
			$data["main_content"] = "Partner/edit_partner";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_partner()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($this->input->post())
		{
			$this->load->model("Partner_model");
			$data["partner_data"] = $this->Partner_model->update_partner();

			$data["main_content"] = "Partner/edit_partner";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function delete_partner($partner_id = FALSE)
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($partner_id)
		{
			$this->load->model("Partner_model");
			$this->Partner_model->delete_partner($partner_id);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>