<?php
class Customer_model extends CI_Model
{
	public function add_customer()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->form_validation->set_rules("name","Customer Name","required|trim");
		$this->form_validation->set_rules("email","Email Address","required|trim");
		$this->form_validation->set_rules("mobile_number","Mobile Number","required|trim|callback_unique_mobile_number");
		$this->form_validation->set_rules("password","Password","required|trim");
		$this->form_validation->set_rules("confirm_password","Confirm Password","required|trim|matches[password]");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			
			$values['user_type'] = 'customer';
			$this->db->insert("customer_partner",$values);

			$this->session->set_flashdata("insert_success","Customer Successfully Added");

			redirect(base_url()."Customer/list_customer");
		}
		else
		{
			return validation_errors();
		}
	}
	public function get_customer_by_id($customer_id)
	{
		return $this->db->get_where("customer_partner",array("id"=>$customer_id,'user_type'=>'customer'))->row_array();
	}
	private function make_customer_query($customer_name = FALSE)
	{
		if($customer_name)
			$this->db->like("name",$customer_name);
	}
	public function list_customer($limit = 0,$start = 0,$customer_name = FALSE)
	{
		$this->make_customer_query($customer_name);
		$this->db->where('user_type','customer');
		$this->db->order_by("id","DESC");

		if($limit!=-1 AND $limit!=-1)
			$this->db->limit($limit,$start);
		
		return $this->db->get("customer_partner")->result_array();
	}
	public function count_customer($customer_name = FALSE)
	{
		$this->make_customer_query($customer_name);
		$this->db->where('user_type','customer');
		$this->db->order_by("id","DESC");
		return $this->db->get("customer_partner")->num_rows();
	}
	public function update_customer()
	{
		$this->form_validation->set_rules("name","Customer Name","required|trim");
		$this->form_validation->set_rules("email","Email","required|trim");
		$this->form_validation->set_rules("mobile_number","Mobile Number","required|trim|callback_unique_mobile_number");
		$this->form_validation->set_rules("password","Password","trim");
		$this->form_validation->set_rules("confirm_password","Confirm Password","trim|matches[password]");

		if($this->form_validation->run())
		{
			
			$values = $this->input->post();
			$update_id = $values["update_id"];
			unset($values["update_id"]);

			if(!isset($values["is_active"]))
			{
				$values['is_active'] = 0;
			}

			//values["date_time"] = date("Y-m-d",strtotime($values["date_time"]));

			$this->db->where("id",$update_id);
			$this->db->update("customer_partner",$values);

			redirect(base_url()."Customer/list_customer");
		}
		else
		{
			return $this->get_customer_by_id($this->input->post("update_id"));
		}
	}
	public function delete_customer($customer_id)
	{
		$this->db->where("id",$customer_id);
		$this->db->delete("customer_partner");

		redirect(base_url()."Customer/list_customer");
	}
}
?>