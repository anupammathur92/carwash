<?php
class Customer extends CI_Controller
{
	public function index()
	{
		$data["main_content"] = "Customer/add_customer";
		$this->load->view("Admin/template",$data);
	}
	public function add_customer()
	{
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
	public function list_customer()
	{
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

        $this->load->library("pagination");
		$this->load->model("Customer_model");
		$customer_name = $this->input->get("customer_name") ? $this->input->get("customer_name") : "";
		$data["list_customers"] = $this->Customer_model->list_customer($limit);

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
	public function unique_mobile_number($customer_mobile_number)
	{
		$this->db->where("mobile_number",$customer_mobile_number);

		if($this->input->post("update_id"))
			$this->db->where("id !=",$this->input->post("update_id"));

		$query = $this->db->get("customer_partner");
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message("unique_mobile_number","The Mobile Number You Entered , Already Exists. Please Enter A Unique Mobile Number");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function edit_customer($customer_id = FALSE)
	{
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
	public function show_bill_details()
	{
		if($this->input->is_ajax_request())
		{
			$bill_id = $this->input->post("bill_id");
			$this->load->model("Billing_model");
			$this->load->model("Client_model");
			$data["bill_data"] = $this->Billing_model->get_bill_by_id($bill_id);
			$data["client_data"] = $this->Client_model->get_client_by_id($data["bill_data"]["client_id"]);

			$this->load->view("Billing/ajax_bill_details",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>