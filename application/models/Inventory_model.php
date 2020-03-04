<?php
class Inventory_model extends CI_Model
{
	public function get_inventory_by_id($inventory_id)
	{
		return $this->db->get_where("inventory",array("id"=>$inventory_id))->row_array();
	}
	private function make_inventory_query($client_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		if($client_id)
			$this->db->where("client_id",$client_id);

		if($from_date)
			$this->db->where("DATE(`date_time`) >=",date("Y-m-d",strtotime($from_date)));
		if($to_date)
			$this->db->where("DATE(`date_time`) <=",date("Y-m-d",strtotime($to_date)));
	}
	public function list_inventory($limit = 0,$start = 0,$client_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		$this->make_inventory_query($client_id,$from_date,$to_date);
		$this->db->order_by("DATE(`date_time`)","DESC");

		if($limit!=-1 AND $limit!=-1)
			$this->db->limit($limit,$start);
		
		return $this->db->get("inventory")->result_array();
	}
	public function count_inventory($client_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		$this->make_inventory_query($client_id,$from_date,$to_date);
		$this->db->order_by("date_time","DESC");
		return $this->db->get("inventory")->num_rows();
	}
	public function update_inventory()
	{
		$values = $this->input->post();
		$update_id = $values["update_id"];
		unset($values["update_id"]);

		$values["date_time"] = date("Y-m-d",strtotime($values["date_time"]));

		$this->db->where("id",$update_id);
		$this->db->update("inventory",$values);

		redirect(base_url()."Inventory/list_inventory");
	}
	public function delete_inventory($inventory_id)
	{
		$this->db->where("id",$inventory_id);
		$this->db->delete("inventory");

		redirect(base_url()."Inventory/list_inventory");
	}
	public function get_inventory_details_for_client($client_id = FALSE)
	{
		$this->db->order_by("DATE(`date_time`)","DESC");
		return $this->db->get_where("inventory",array("client_id"=>$client_id,"MONTH(`date_time`)"=>date("m")))->result_array();
	}
	public function get_out_inventory_by_client($client_id = FALSE , $month = FALSE, $year = FALSE)
	{
		$this->db->select("SUM(`out_quantity`) as `tot_out_quantity`,date_time,DAY(`date_time`) as `day_of_month`");
		$this->db->group_by("date_time");
		$this->db->where(array("client_id"=>$client_id,"MONTH(`date_time`)"=>$month,"YEAR(`date_time`)"=>$year));
		return $query = $this->db->get("inventory")->result_array();
	}
}
?>