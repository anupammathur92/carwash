<?php
class Subadmin_model extends CI_Model
{
	public function add_subadmin()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->form_validation->set_rules("name","Subadmin Name","required|trim");
		$this->form_validation->set_rules("email","Email Address","required|trim|callback_unique_email");
		$this->form_validation->set_rules("mobile_number","Mobile Number","required|trim|callback_unique_mobile_number");
		$this->form_validation->set_rules("password","Password","required|trim");
		$this->form_validation->set_rules("confirm_password","Confirm Password","required|trim|matches[password]");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$values['user_type'] = 'subadmin';

			unset($values["confirm_password"]);

			$this->db->insert("admins",$values);

			$this->session->set_flashdata("insert_success","Subadmin Successfully Added");

			redirect(base_url()."Subadmin/list_subadmin");
		}
		else
		{
			return validation_errors();
		}
	}
	public function get_subadmin_by_id($subadmin_id)
	{
		return $this->db->get_where("admins",array("id"=>$subadmin_id,'user_type'=>'subadmin'))->row_array();
	}
	private function make_subadmin_query($subadmin_name = "")
	{
		if($subadmin_name!="")
			$this->db->like("name",$subadmin_name);
	}
	public function list_subadmin($limit = 0,$start = 0,$subadmin_name = "")
	{
		$this->make_subadmin_query($subadmin_name);
		$this->db->where('user_type','subadmin');
		$this->db->order_by("id","DESC");

		if($limit!=-1 AND $limit!=-1)
			$this->db->limit($limit,$start);
		
		return $this->db->get("admins")->result_array();
	}
	public function count_subadmin($subadmin_name = "")
	{
		$this->make_subadmin_query($subadmin_name);
		$this->db->where('user_type','subadmin');
		$this->db->order_by("id","DESC");
		return $this->db->get("admins")->num_rows();
	}
	public function update_subadmin()
	{
		$this->form_validation->set_rules("name","Subadmin Name","required|trim");
		$this->form_validation->set_rules("email","Email Address","required|trim|callback_unique_email");
		$this->form_validation->set_rules("mobile_number","Mobile Number","required|trim|callback_unique_mobile_number");
		$this->form_validation->set_rules("password","Password","trim");
		$this->form_validation->set_rules("confirm_password","Confirm Password","trim|matches[password]");

		if($this->form_validation->run())
		{
			$values = $this->input->post();
			$update_id = $values["update_id"];
			unset($values["update_id"]);
			unset($values["confirm_password"]);

			//values["date_time"] = date("Y-m-d",strtotime($values["date_time"]));
			if(!isset($values["is_active"]))
			{
				$values['is_active'] = 0;
			}

			if(!isset($values["allow_partner"]))
			{
				$values['allow_partner'] = 0;
			}

			if(!isset($values["allow_customer"]))
			{
				$values['allow_customer'] = 0;
			}

			if(!isset($values["allow_brand"]))
			{
				$values['allow_brand'] = 0;
			}
			if(!isset($values["allow_category"]))
			{
				$values['allow_category'] = 0;
			}
			$this->db->where("id",$update_id);
			$this->db->update("admins",$values);

			redirect(base_url()."Subadmin/list_subadmin");
		}
		else
		{
			return $this->get_subadmin_by_id($this->input->post("update_id"));
		}
	}
	public function delete_subadmin($subadmin_id)
	{
		$this->db->where("id",$subadmin_id);
		$this->db->delete("admins");

		redirect(base_url()."Subadmin/list_subadmin");
	}
}
?>