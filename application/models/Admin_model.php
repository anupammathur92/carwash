<?php
class Admin_model extends CI_Model
{
	public function check_login()
	{
		$values = $this->input->post();
		$username = trim($values["loginusername"]);
		$password = md5(trim($values["loginpassword"]));
		$query = $this->db->get_where("admins",array("mobile_number"=>$username,"password"=>$password,"is_active"=>"1"));
		if($query->num_rows()==1)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	public function is_logged_in()
	{
		if(!$this->session->userdata("logged_in"))
		{
			redirect(base_url());
		}
	}
}
?>