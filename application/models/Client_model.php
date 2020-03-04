<?php
class Client_model extends CI_Model
{
	public function add_client()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->form_validation->set_rules("client_name","Client Name","required|trim|callback_unique_client_name");
		$this->form_validation->set_rules("client_address","trim");
		$this->form_validation->set_rules("client_contact_no","trim");
		$this->form_validation->set_rules("client_code","trim");
		$this->form_validation->set_rules("security_amount","trim");
		$this->form_validation->set_rules("start_date","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();

			if(!empty($values["start_date"]))
				$values["start_date"] = date("Y-m-d",strtotime($values["start_date"]));

			$this->db->insert("clients",$values);

			$this->session->set_flashdata("insert_success","Client Successfully Added");

			redirect(base_url()."Client/list_client");
		}
		else
		{
			return validation_errors();
		}
	}
	private function make_client_query($client_name = FALSE)
	{
		if($client_name)
			$this->db->where("id",$client_name);
	}
	public function list_client($limit = 0,$start = 0,$client_name = FALSE)
	{
		$this->make_client_query($client_name);
		$this->db->order_by("id","DESC");
		$this->db->limit($limit,$start);
		return $this->db->get("clients")->result_array();
	}
	public function count_client($client_name = FALSE)
	{
		$this->make_client_query($client_name);
		$this->db->order_by("id","DESC");
		return $this->db->get("clients")->num_rows();
	}
	public function get_client_by_id($id = FALSE)
	{
		if($id)
		{
			return $this->db->get_where("clients",array("id"=>$id))->row_array();
		}
		else
		{
			return array();
		}
	}
	public function update_client()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->form_validation->set_rules("client_name","Client Name","required|trim|callback_unique_client_name");
		$this->form_validation->set_rules("client_address","trim");
		$this->form_validation->set_rules("client_contact_no","trim");
		$this->form_validation->set_rules("security_amount","trim");

		if($this->form_validation->run())
		{
			$values = $this->input->post();

			if(!isset($values["security_returned"]))
				$values["security_returned"] = 0;

			$update_id = $values["update_id"];
			unset($values["update_id"]);

			$this->db->where("id",$update_id);
			$this->db->update("clients",$values);

			$this->session->set_flashdata("update_success","Client Successfully Updated");

			redirect(base_url()."Client/list_client");
		}
		else
		{
			return $this->get_client_by_id($this->input->post("update_id"));
		}
	}
	public function delete_client($id = FALSE)
	{
		if($id)
		{
			$this->db->where("id",$id);
			$this->db->delete("clients");

			$this->session->set_flashdata("delete_success","Client Deleted");

			redirect(base_url()."Client/list_client");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function add_inventory()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>";

		$this->form_validation->set_rules("client_id","Client Name","required|trim");
		$this->form_validation->set_rules("date_time","Date / Time","required|trim");
		$this->form_validation->set_rules("in_quantity","In Quantity","required|trim");
		$this->form_validation->set_rules("out_quantity","Out Quantity","required|trim");
		if($this->form_validation->run())
		{
			$values = $this->input->post();

			$values["date_time"] = date("Y-m-d",strtotime($values["date_time"]));
			//echo "<pre>"; print_r($values); echo "</pre>"; die();

			$this->db->insert("inventory",$values);

			redirect(base_url()."Inventory/list_inventory");
		}
		else
		{
			return validation_errors();
		}
	}
	public function list_inventory($client_id = FALSE)
	{
		return $this->db->get_where("inventory",array("client_id"=>$client_id,"MONTH(`date_time`)"=>date("m")))->result_array();
	}
}
?>