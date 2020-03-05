<?php
class Category extends CI_Controller
{
	public function index()
	{
		$this->load->model("Category_model");
		$data["main_content"] = "Category/add_category";
		$this->load->view("Admin/template",$data);
	}
	public function add_category()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();
		$this->load->model("Category_model");
		$this->Category_model->add_category();
		$data["parent_categories"] = $this->Category_model->get_parent_category_list();

		$data["main_content"] = "Category/add_category";
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
		$this->load->model("Category_model");

        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

		$client_name = $this->input->get("client_name") ? $this->input->get("client_name") : "";

		$data["list_category"] = $this->Category_model->list_category($limit,$start,$client_name);

		$config["base_url"] = base_url()."Category/list_category";
        $config["total_rows"] = $this->Category_model->count_category($client_name);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Category/list_category?client_name=" . $client_name;

		$config["suffix"] = "?client_name=" . $client_name;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;

		$data["main_content"] = "Category/list_category";
		$this->load->view("Admin/template",$data);
	}
	public function edit_category($category_id=FALSE)
	{
		if($category_id)
		{
			$this->load->model("Category_model");
			$data["category_data"] = $this->Category_model->get_category_by_id($category_id);
			$data["main_content"] = "Category/edit_category";
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

		$this->load->model("Category_model");
		$data["category_data"] = $this->Category_model->update_category();

		$data["main_content"] = "Category/edit_category";
		$this->load->view("Admin/template",$data);
	}
	public function delete_category($category_id = FALSE)
	{
		if($category_id)
		{
			$this->load->model("Category_model");
			$this->Category_model->delete_category($category_id);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function subcategory($category_id = FALSE)
	{
		if($category_id)
		{
			$this->load->model("Category_model");
			$data["parent_category_data"] = $this->Category_model->get_category_by_id($category_id);
			$data["list_subcategory"] = $this->Category_model->get_subcategory_list($category_id);
			$data["main_content"] = "Category/subcategory";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function add_subcategory()
	{
		$this->load->model("Category_model");
		$this->Category_model->add_subcategory();

		$parent_category_id = $this->input->post("parent_id");
		$data["parent_category_data"] = $this->Category_model->get_category_by_id($parent_category_id);
		$data["list_subcategory"] = $this->Category_model->get_subcategory_list($parent_category_id);
		$data["main_content"] = "Category/subcategory";
		$this->load->view("Admin/template",$data);
	}
	public function delete_subcategory($subcategory_id = FALSE)
	{
		if($subcategory_id)
		{
			$this->load->model("Category_model");
			$this->Category_model->delete_subcategory($subcategory_id);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function edit_subcategory($subcategory_id = FALSE)
	{
		if($subcategory_id)
		{
			$this->load->model("Category_model");
			$data["subcategory_data"] = $this->Category_model->get_category_by_id($subcategory_id);
			$data["main_content"] = "Category/edit_subcategory";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_subcategory()
	{
		$this->load->model("Category_model");
		$data["category_data"] = $this->Category_model->update_subcategory();

		$subcategory_id = $this->input->post("update_id");
		$data["subcategory_data"] = $this->Category_model->get_category_by_id($subcategory_id);
		$data["main_content"] = "Category/edit_subcategory";
		$this->load->view("Admin/template",$data);
	}
}
?>