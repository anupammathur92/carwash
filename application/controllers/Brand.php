<?php
class Brand extends CI_Controller
{
	public function index()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		$data["main_content"] = "Brand/add_brand";
		$this->load->view("Admin/template",$data);
	}
	public function add_brand()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($this->input->post())
		{
			$this->load->model("Brand_model");
			$this->Brand_model->add_brand();

			$data["main_content"] = "Brand/add_brand";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function unique_brand($brand_name)
	{
		$this->db->where("name",$brand_name);

		if($this->input->post("update_id"))
			$this->db->where("id !=",$this->input->post("update_id"));

		$query = $this->db->get("brand");
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message("unique_brand","The Brand Name You Entered , Already Exists. Please Enter A Unique Brand Name");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function list_brand()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

        $this->load->library("pagination");
		$this->load->model("Brand_model");
		$brand_name = $this->input->get("brand_name") ? $this->input->get("brand_name") : "";

		$data["list_brands"] = $this->Brand_model->list_brand($limit,$start,$brand_name);

		$config["base_url"] = base_url()."Brand/list_brand";
        $config["total_rows"] = $this->Brand_model->count_brand($brand_name);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Brand/list_brand?brand_name=" . $brand_name;

		$config["suffix"] = "?brand_name=" . $brand_name;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;

		$data["main_content"] = "Brand/list_brand";
		$this->load->view("Admin/template",$data);
	}
	public function edit_brand($brand_id = FALSE)
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($brand_id)
		{
			$this->load->model("Brand_model");
			$data["brand_data"] = $this->Brand_model->get_brand_by_id($brand_id);
			$data["main_content"] = "Brand/edit_brand";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_brand()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($this->input->post())
		{
			$this->load->model("Brand_model");
			$data["brand_data"] = $this->Brand_model->update_brand();

			$data["main_content"] = "Brand/edit_brand";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function delete_brand($brand_id = FALSE)
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
		if($brand_id)
		{
			$this->load->model("Brand_model");
			$this->Brand_model->delete_brand($brand_id);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>