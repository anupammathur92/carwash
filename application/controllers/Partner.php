<?php
class Partner extends CI_Controller
{
	public function index()
	{
		$data["main_content"] = "Partner/add_partner";
		$this->load->view("Admin/template",$data);
	}
	public function add_partner()
	{
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
	public function list_partner()
	{
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

        $this->load->library("pagination");
		$this->load->model("Partner_model");
		$data["list_partners"] = $this->Partner_model->list_partner($limit);

		$config["base_url"] = base_url()."Partner/list_brand";
        $config["total_rows"] = $this->Partner->count_brand($brand_name);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Brand/list_brand?brand_name=" . $brand_name;

		$config["suffix"] = "?brand_name=" . $brand_name;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;


		$data["main_content"] = "Partner/list_partner";
		$this->load->view("Admin/template",$data);
	}
	public function edit_partner($partner_id = FALSE)
	{
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
	public function delete_partner($partner_id = FALSE)
	{
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