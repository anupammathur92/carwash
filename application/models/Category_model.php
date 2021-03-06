<?php
class Category_model extends CI_Model
{
	public function add_category()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->form_validation->set_rules("category_name","Category Name","required|trim|callback_unique_category_name");
		$this->form_validation->set_rules("model","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$this->db->insert("category",$values);

			$this->session->set_flashdata("insert_success","Category Successfully Added");

			redirect(base_url()."Category/list_category");
		}
		else
		{
			return validation_errors();
		}
	}
	public function get_parent_category_list()
	{
		return $this->db->get_where("category",array("parent_id"=>0))->result_array();
	}
	public function get_category_by_id($category_id)
	{
		return $this->db->get_where("category",array("id"=>$category_id))->row_array();
	}
	private function make_category_query($category_name = "")
	{
		if($category_name!="")
			$this->db->like("category_name",$category_name);
	}
	public function list_category($limit = 0,$start = 0,$category_name = "")
	{
		$this->make_category_query($category_name);
		$this->db->where(array("parent_id"=>0));
		$this->db->order_by("id","DESC");

		if($limit!=-1 AND $limit!=-1)
			$this->db->limit($limit,$start);
		
		return $this->db->get("category")->result_array();
	}
	public function count_category($category_name = "")
	{
		$this->make_category_query($category_name);
		$this->db->where(array("parent_id"=>0));
		$this->db->order_by("id","DESC");
		return $this->db->get("category")->num_rows();
	}
	public function update_category()
	{
		$this->form_validation->set_rules("category_name","Category Name","required|trim|callback_unique_category_name");
		$this->form_validation->set_rules("model","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$update_id = $values["update_id"];
			unset($values["update_id"]);

			//values["date_time"] = date("Y-m-d",strtotime($values["date_time"]));

			$this->db->where("id",$update_id);
			$this->db->update("category",$values);

			redirect(base_url()."Category/list_category");
		}
		else
		{
			return $this->get_category_by_id($this->input->post("update_id"));
		}
	}
	public function delete_category($category_id)
	{
		$this->db->where("id",$category_id);
		$this->db->delete("category");

		redirect(base_url()."Category/list_category");
	}
	public function delete_subcategory($subcategory_id)
	{
		$sub_category_data = $this->get_category_by_id($subcategory_id);
		$this->db->where("id",$subcategory_id);
		$this->db->delete("category");

		redirect(base_url()."Category/subcategory/".$sub_category_data["parent_id"]);
	}
	public function add_subcategory()
	{
		$this->form_validation->set_rules("category_name","Sub Category Name","required|trim|callback_unique_category_name");
		$this->form_validation->set_rules("min_price","Min. Price","required|trim");
		$this->form_validation->set_rules("max_price","Max. Price","required|trim");
		$this->form_validation->set_rules("model","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$this->db->insert("category",$values);

			$this->session->set_flashdata("insert_success","Category Successfully Added");

			redirect(base_url()."Category/subcategory/".$values["parent_id"]);
		}
		else
		{
			return validation_errors();
		}
	}
	public function get_subcategory_list($category_id)
	{
		return $this->db->get_where("category",array("parent_id"=>$category_id))->result_array();
	}
	public function update_subcategory()
	{
		$this->form_validation->set_rules("category_name","Sub Category Name","required|trim|callback_unique_category_name");
		$this->form_validation->set_rules("min_price","Min. Price","required|trim");
		$this->form_validation->set_rules("max_price","Max. Price","required|trim");
		$this->form_validation->set_rules("model","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$update_id = $values["update_id"];
			unset($values["update_id"]);

			//values["date_time"] = date("Y-m-d",strtotime($values["date_time"]));

			$this->db->where("id",$update_id);
			$this->db->update("category",$values);

			redirect(base_url()."Category/subcategory/".$values["parent_id"]);
		}
		else
		{
			return $this->get_category_by_id($this->input->post("update_id"));
		}
	}
}
?>