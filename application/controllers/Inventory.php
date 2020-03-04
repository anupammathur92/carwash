<?php
class Inventory extends CI_Controller
{
	public function index()
	{
		/*$this->load->model("Client_model");
		$data["list_client"] = $this->Client_model->list_model();
		$data["main_content"] = "Inventory/add_inventory";
		$this->load->view("Admin/template",$data);*/
	}
	public function list_inventory()
	{
		$this->load->library("pagination");

        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

		$client_id = $this->input->get("client_name") ? $this->input->get("client_name") : "";
		$from_date = $this->input->get("from_date") ? $this->input->get("from_date") : "";
		$to_date = $this->input->get("to_date") ? $this->input->get("to_date") : "";

		$this->load->model("Inventory_model");
		$this->load->model("Client_model");
		$data["list_inventory"] = $this->Inventory_model->list_inventory($limit,$start,$client_id,$from_date,$to_date);


		$config["base_url"] = base_url()."Inventory/list_inventory";
		$config["total_rows"] = $this->Inventory_model->count_inventory($client_id,$from_date,$to_date);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Inventory/list_inventory?client_name=" . $client_id."&from_date=".$from_date."&to_date=".$to_date;

		$config["suffix"] = "?client_name=" . $client_id."&from_date=".$from_date."&to_date=".$to_date;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;

		$data["main_content"] = "Inventory/list_inventory";
		$this->load->view("Admin/template",$data);
	}
	public function edit_inventory($inventory_id = FALSE)
	{
		if($inventory_id)
		{
			$this->load->model("Inventory_model");
			$this->load->model("Client_model");
			$data["inventory_data"] = $this->Inventory_model->get_inventory_by_id($inventory_id);
			$data["client_data"] = $this->Client_model->get_client_by_id($data["inventory_data"]["client_id"]);
			$data["main_content"] = "Inventory/edit_inventory";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_inventory()
	{
		if($this->input->post())
		{
			$this->load->model("Inventory_model");
			$this->Inventory_model->update_inventory();

		}
		else
		{
			redirect(base_url());
		}
	}
	public function delete_inventory($inventory_id = FALSE)
	{
		if($inventory_id)
		{
			$this->load->model("Inventory_model");
			$this->Inventory_model->delete_inventory($inventory_id);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function get_inventory_details_for_client()
	{
		if($this->input->is_ajax_request())
		{
			$client_id = $this->input->post("client_id");

			$this->load->model("Inventory_model");
			$data["list_inventory"] = $this->Inventory_model->get_inventory_details_for_client($client_id);

			$this->load->view("Inventory/ajax-list_inventory",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>