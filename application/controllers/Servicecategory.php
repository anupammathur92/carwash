<?php
class Servicecategory extends CI_Controller
{
	public function index()
	{
		$this->load->model("Servicecategory_model");
		$data["parent_categories"] = $this->Servicecategory_model->get_parent_category_list();
		$data["main_content"] = "Servicecategory/add_servicecategory";
		$this->load->view("Admin/template",$data);
	}
	public function add_servicecategory()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();
		$this->load->model("Servicecategory_model");
		$this->Servicecategory_model->add_servicecategory();
		$data["parent_categories"] = $this->Servicecategory_model->get_parent_category_list();

		$data["main_content"] = "Servicecategory/add_servicecategory";
		$this->load->view("Admin/template",$data);
	}
	public function unique_category_name($category_name)
	{
		$this->db->where("category_name",$category_name);

		if($this->input->post("update_id"))
			$this->db->where("id !=",$this->input->post("update_id"));

		$query = $this->db->get("category");
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message("unique_category_name","The Category Name You Entered , Already Exists. Please Enter A Unique Category Name");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function list_category()
	{
		$this->load->library("pagination");
		$this->load->model("Servicecategory_model");

        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

		$client_name = $this->input->get("client_name") ? $this->input->get("client_name") : "";

		$data["list_category"] = $this->Servicecategory_model->list_category($limit,$start,$client_name);

		$config["base_url"] = base_url()."Servicecategory/list_category";
        $config["total_rows"] = $this->Servicecategory_model->count_category($client_name);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Servicecategory/list_category?client_name=" . $client_name;

		$config["suffix"] = "?client_name=" . $client_name;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;

		$data["main_content"] = "Servicecategory/list_category";
		$this->load->view("Admin/template",$data);
	}
	public function edit_category($category_id=FALSE)
	{
		if($category_id)
		{
			$this->load->model("Servicecategory_model");
			$data["category_data"] = $this->Servicecategory_model->get_category_by_id($category_id);
			$data["parent_categories"] = $this->Servicecategory_model->get_parent_category_list();
			$data["main_content"] = "Servicecategory/edit_category";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_category()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->load->model("Servicecategory_model");
		$data["category_data"] = $this->Servicecategory_model->update_category();
		$data["parent_categories"] = $this->Servicecategory_model->get_parent_category_list();

		$data["main_content"] = "Servicecategory/edit_category";
		$this->load->view("Admin/template",$data);
	}
	public function delete_category($category_id = FALSE)
	{
		if($category_id)
		{
			$this->load->model("Servicecategory_model");
			$this->Servicecategory_model->delete_category($category_id);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>