<?php
class Servicecategory_model extends CI_Model
{
	public function add_servicecategory()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->form_validation->set_rules("category_name","Category Name","required|trim|callback_unique_category_name");
		$this->form_validation->set_rules("model","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$this->db->insert("category",$values);

			$this->session->set_flashdata("insert_success","Category Successfully Added");

			redirect(base_url()."Servicecategory/list_category");
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
	private function make_category_query($category_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		if($category_id)
			$this->db->where("id",$category_id);

		if($from_date)
			$this->db->where("DATE(`date_time`) >=",date("Y-m-d",strtotime($from_date)));
		if($to_date)
			$this->db->where("DATE(`date_time`) <=",date("Y-m-d",strtotime($to_date)));
	}
	public function list_category($limit = 0,$start = 0,$category_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		$this->make_category_query($category_id,$from_date,$to_date);
		$this->db->order_by("id","DESC");

		if($limit!=-1 AND $limit!=-1)
			$this->db->limit($limit,$start);
		
		return $this->db->get("category")->result_array();
	}
	public function count_category($category_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		$this->make_category_query($category_id,$from_date,$to_date);
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

			redirect(base_url()."Servicecategory/list_category");
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

		redirect(base_url()."Servicecategory/list_category");
	}
}
?>