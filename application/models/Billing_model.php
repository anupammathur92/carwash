<?php
class Billing_model extends CI_Model
{
	public function add_bill()
	{
		$values = $this->input->post();

		if(!isset($values["extra_details"]))
			$values["extra_details"] = "0";

			//echo "<pre>"; print_r($values); echo "</pre>"; die();
			$values["from_date"] = date("Y-m-d",strtotime($values["from_date"]));
			$values["to_date"] = date("Y-m-d",strtotime($values["to_date"]));
			$values["client_id"] = $values["client_name"];
			unset($values["client_name"]);
		$this->db->trans_start();

			/*----update the flag for is_billed in the inventory table----*/
			/*$this->db->where("DATE(`date_time`)>=",$values["from_date"]);
			$this->db->where("DATE(`date_time`)<=",$values["to_date"]);
			$this->db->where("client_id",$values["client_id"]);
			$this->db->update("inventory",array("is_billed"=>"1"));*/
			/*------------------------------------------------------------*/

			/*-----Insert data into billing table-----*/
			$this->db->insert("bills",$values);
			/*----------------------------------------*/

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
			$this->session->set_flashdata("insert_success","Bill Successfully Created");
		else
			$this->session->set_flashdata("db_error","A Database Error Has Occurred");

		redirect(base_url()."Billing/list_bill");
	}
	private function make_bill_query($client_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		if($client_id)
			$this->db->where("cleint_id",$client_id);

		if($from_date)
			$this->db->where("DATE(`created_on`) >=",date("Y-m-d",strtotime($from_date)));

		if($to_date)
			$this->db->where("DATE(`created_on`) <=",date("Y-m-d",strtotime($to_date)));
	}
	public function list_bill($client_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		//$this->make_bill_query($client_id,$from_date,$to_date);
		$this->db->order_by("DATE(`created_on`)","DESC");
		return $this->db->get("bills")->result_array();
	}
	public function get_bill_by_id($bill_id = FALSE)
	{
		if($bill_id)
		{
			return $this->db->get_where("bills",array("id"=>$bill_id))->row_array();
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_bill()
	{
		$values = $this->input->post();

		if(!isset($values["extra_details"]))
		{
			$values["extra_details"] = "0";
			$values["total_amount_fixed"] = "0";
			$values["price"] = "0";
			$values["extra_campers"] = "0";
			$values["total_amount_extra"] = "0";
		}

		$updateArr = array("price"=>$values["price"],
							"extra_details"=>$values["extra_details"],
							"total_amount_fixed"=>$values["total_amount_fixed"],
							"extra_campers"=>$values["extra_campers"],
							"total_amount_extra"=>$values["total_amount_extra"]
						  );

		$this->db->where("id",$values["update_id"]);
		$this->db->update("bills",$updateArr);

		$this->session->set_flashdata("update_success","Bill Updated");
		redirect(base_url()."Billing/list_bill");
	}
	public function delete_bill($bill_id)
	{
		$this->db->where("id",$bill_id);
		$this->db->delete("bills");

		$this->session->set_flashdata("delete_success","Bill Deleted");
		redirect(base_url()."Billing/list_bill");
	}
}
?>