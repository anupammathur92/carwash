<?php
class Billing extends CI_Controller
{
	public function index()
	{
		$data["main_content"] = "Billing/add_bill";
		$this->load->view("Admin/template",$data);
	}
	public function get_bill_details()
	{
		if($this->input->is_ajax_request())
		{
			$values = $this->input->post();
			$this->load->model("Inventory_model");
			$data["bill_details"] = $this->Inventory_model->list_inventory(-1,-1,$values["client_id"],$values["from_date"],$values["to_date"]);
			$this->load->view("Billing/ajax_bill_data",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function add_bill()
	{
		if($this->input->post())
		{
			$this->load->model("Billing_model");
			$this->Billing_model->add_bill();
		}
		else
		{
			redirect(base_url());
		}
	}
	public function list_bill()
	{
		$this->load->model("Billing_model");
		$this->load->model("Client_model");
		$data["list_bills"] = $this->Billing_model->list_bill();
		$data["main_content"] = "Billing/list_bill";
		$this->load->view("Admin/template",$data);
	}
	public function edit_bill($bill_id = FALSE)
	{
		if($bill_id)
		{
			$this->load->model("Billing_model");
			$this->load->model("Client_model");
			$data["bill_data"] = $this->Billing_model->get_bill_by_id($bill_id);
			$data["client_data"] = $this->Client_model->get_client_by_id($data["bill_data"]["client_id"]);
			$data["main_content"] = "Billing/edit_bill";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_bill()
	{
		if($this->input->post())
		{
			$this->load->model("Billing_model");
			$this->Billing_model->update_bill();
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
	public function delete_bill($bill_id = FALSE)
	{
		if($bill_id)
		{
			$this->load->model("Billing_model");
			$this->Billing_model->delete_bill($bill_id);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function get_bill($bill_id = FALSE)
	{
		if($bill_id)
		{
			$this->load->model("Billing_model");
			$this->load->model("Client_model");
			$data["bill_data"] = $this->Billing_model->get_bill_by_id($bill_id);
			$data["client_data"] = $this->Client_model->get_client_by_id($data["bill_data"]["client_id"]);
			$this->load->view("Billing/view_bill",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>