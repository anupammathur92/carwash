<?php
class Brand_model extends CI_Model
{
	public function add_brand()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->form_validation->set_rules("name","Brand Name","required|trim|callback_unique_brand");
		$this->form_validation->set_rules("model","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$this->db->insert("brand",$values);

			$this->session->set_flashdata("insert_success","Brand Successfully Added");

			redirect(base_url()."Brand/list_brand");
		}
		else
		{
			return validation_errors();
		}
	}
	public function get_brand_by_id($brand_id)
	{
		return $this->db->get_where("brand",array("id"=>$brand_id))->row_array();
	}
	private function make_brand_query($brand_name = "")
	{
		if($brand_name!="")
			$this->db->where("name",$brand_name);
	}
	public function list_brand($limit = 0,$start = 0,$brand_name = "")
	{
		$this->make_brand_query($brand_name);
		$this->db->order_by("id","DESC");

		if($limit!=-1 AND $limit!=-1)
			$this->db->limit($limit,$start);
		
		return $this->db->get("brand")->result_array();
	}
	public function count_brand($brand_name = "")
	{
		$this->make_brand_query($brand_name);
		$this->db->order_by("id","DESC");
		return $this->db->get("brand")->num_rows();
	}
	public function update_brand()
	{
		$this->form_validation->set_rules("name","Brand Name","required|trim|callback_unique_brand");
		$this->form_validation->set_rules("model","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$update_id = $values["update_id"];
			unset($values["update_id"]);

			//values["date_time"] = date("Y-m-d",strtotime($values["date_time"]));

			$this->db->where("id",$update_id);
			$this->db->update("brand",$values);

			redirect(base_url()."Brand/list_brand");
		}
		else
		{
			return $this->get_brand_by_id($this->input->post("update_id"));
		}
	}
	public function delete_brand($brand_id)
	{
		$this->db->where("id",$brand_id);
		$this->db->delete("brand");

		redirect(base_url()."Brand/list_brand");
	}
}
?>