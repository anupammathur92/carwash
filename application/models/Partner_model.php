<?php
class Partner_model extends CI_Model
{
	public function add_partner()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->form_validation->set_rules("name","Partner Name","required|trim");
		$this->form_validation->set_rules("email","trim");
		$this->form_validation->set_rules("mobile_number","trim|callback_unique_mobile_number");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$values['user_type'] = 'partner';
			$this->db->insert("customer_partner",$values);

			$this->session->set_flashdata("insert_success","Partner Successfully Added");

			redirect(base_url()."Partner/list_partner");
		}
		else
		{
			return validation_errors();
		}
	}
	public function get_partner_by_id($partner_id)
	{
		return $this->db->get_where("customer_partner",array("id"=>$partner_id,'user_type'=>'partner'))->row_array();
	}
	private function make_partner_query($partner_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		if($partner_id)
			$this->db->where("id",$partner_id);

		if($from_date)
			$this->db->where("DATE(`date_time`) >=",date("Y-m-d",strtotime($from_date)));
		if($to_date)
			$this->db->where("DATE(`date_time`) <=",date("Y-m-d",strtotime($to_date)));
	}
	public function list_partner($limit = 0,$start = 0,$partner_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		$this->make_partner_query($partner_id,$from_date,$to_date);
		$this->db->where('user_type','partner');
		$this->db->order_by("id","DESC");

		if($limit!=-1 AND $limit!=-1)
			$this->db->limit($limit,$start);
		
		return $this->db->get("customer_partner")->result_array();
	}
	public function count_partner($partner_id = FALSE,$from_date = FALSE,$to_date = FALSE)
	{
		$this->make_partner_query($partner_id,$from_date,$to_date);
		$this->db->order_by("id","DESC");
		return $this->db->get("customer_partner")->num_rows();
	}
	public function update_partner()
	{
		$this->form_validation->set_rules("name","Partner Name","required|trim");
		$this->form_validation->set_rules("email","trim");
		$this->form_validation->set_rules("mobile_number","trim|callback_unique_mobile_number");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$update_id = $values["update_id"];
			unset($values["update_id"]);

			//values["date_time"] = date("Y-m-d",strtotime($values["date_time"]));
			if(!isset($values["is_active"]))
			{
				$values['is_active'] = 0;
			}

			$this->db->where("id",$update_id);
			$this->db->update("customer_partner",$values);

			redirect(base_url()."Partner/list_partner");
		}
		else
		{
			return $this->get_partner_by_id($this->input->post("update_id"));
		}
	}
	public function delete_partner($partner_id)
	{
		$this->db->where("id",$partner_id);
		$this->db->delete("customer_partner");

		redirect(base_url()."Partner/list_partner");
	}
}
?>