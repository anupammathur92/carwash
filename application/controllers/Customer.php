<?php
class Customer extends CI_Controller
{
	public function index()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		$data["main_content"] = "Customer/add_customer";
		$this->load->view("Admin/template",$data);
	}
	public function add_customer()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($this->input->post())
		{
			$this->load->model("Customer_model");
			$this->Customer_model->add_customer();

			$data["main_content"] = "Customer/add_customer";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
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
	public function list_customer()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

        $this->load->library("pagination");
		$this->load->model("Customer_model");
		$customer_name = $this->input->get("customer_name") ? $this->input->get("customer_name") : "";
		$data["list_customers"] = $this->Customer_model->list_customer($limit,$start,$customer_name);

		$config["base_url"] = base_url()."Customer/list_customer";
        $config["total_rows"] = $this->Customer_model->count_customer($customer_name);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Customer/list_customer?customer_name=" . $customer_name;

		$config["suffix"] = "?customer_name=" . $customer_name;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;

		$data["main_content"] = "Customer/list_customer";
		$this->load->view("Admin/template",$data);
	}
	public function edit_customer($customer_id = FALSE)
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($customer_id)
		{
			$this->load->model("Customer_model");
			$data["customer_data"] = $this->Customer_model->get_customer_by_id($customer_id);
			$data["main_content"] = "Customer/edit_customer";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_customer()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($this->input->post())
		{
			$this->load->model("Customer_model");
			$data["customer_data"] = $this->Customer_model->update_customer();

			$data["main_content"] = "Customer/edit_customer";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function delete_customer($customer_id = FALSE)
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($customer_id)
		{
			$this->load->model("Customer_model");
			$this->Customer_model->delete_customer($customer_id);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>