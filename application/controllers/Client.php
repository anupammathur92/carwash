<?php
class Client extends CI_Controller
{
	public function index()
	{
		$data["main_content"] = "Client/add_client";
		$this->load->view("Admin/template",$data);
	}
	public function add_client()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();
		$this->load->model("Client_model");
		$this->Client_model->add_client();

		$data["main_content"] = "Client/add_client";
		$this->load->view("Admin/template",$data);
	}
	public function unique_client_name($client_name)
	{
		$this->db->where("client_name",$client_name);

		if($this->input->post("update_id"))
			$this->db->where("id !=",$this->input->post("update_id"));

		$query = $this->db->get("clients");
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message("unique_client_name","The Client Name You Entered , Already Exists. Please Enter A Unique Client Name");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function list_client()
	{
		$this->load->library("pagination");
		$this->load->model("Client_model");

        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;

		$client_name = $this->input->get("client_name") ? $this->input->get("client_name") : "";

		$data["list_client"] = $this->Client_model->list_client($limit,$start,$client_name);

		$config["base_url"] = base_url()."Client/list_client";
        $config["total_rows"] = $this->Client_model->count_client($client_name);
        $config["per_page"] = $limit;
		
		$config["first_url"] = base_url()."Client/list_client?client_name=" . $client_name;

		$config["suffix"] = "?client_name=" . $client_name;

		$data["page_url"] = $start.$config["suffix"];
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data["config"] = $config;

		$data["main_content"] = "Client/list_client";
		$this->load->view("Admin/template",$data);
	}
	public function edit_client($client_id=FALSE)
	{
		if($client_id)
		{
			$this->load->model("Client_model");
			$data["client_data"] = $this->Client_model->get_client_by_id($client_id);
			$data["main_content"] = "Client/edit_client";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function update_client()
	{
		//echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();

		$this->load->model("Client_model");
		$data["client_data"] = $this->Client_model->update_client();

		$data["main_content"] = "Client/edit_client";
		$this->load->view("Admin/template",$data);
	}
	public function delete_client($client_id = FALSE)
	{
		if($client_id)
		{
			$this->load->model("Client_model");
			$this->Client_model->delete_client($client_id);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function inventory($client_id)
	{
		if($client_id)
		{
			$this->load->model("Client_model");
			$data["client_data"] = $this->Client_model->get_client_by_id($client_id);
			$data["main_content"] = "Client/add_inventory";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function add_inventory()
	{
		if($this->input->post())
		{
			//echo "<pre>"; print_r($this->input->post()); echo "</pre>";

			$this->load->model("Client_model");
			$this->Client_model->add_inventory();
			die();
		}
		else
		{
			redirect(base_url());
		}
	}
	public function list_inventory($client_id = FALSE)
	{
		if($client_id)
		{
			$this->load->model("Client_model");
			$data["client_inventory"] = $this->Client_model->list_inventory($client_id);
			$data["main_content"] = "Client/list_inventory";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function get_all_clients()
	{
		if($this->input->is_ajax_request())
		{
			$search_str = trim($this->input->get("q"));

			$arr["results"] = null;

			$this->db->like("client_name",$search_str);
			$query = $this->db->get("clients");
			foreach($query->result_array() as $data)
			{
				$arr["results"][] = array("id"=>$data["id"],
										  "text"=>$data["client_name"]
										  );
			}
			echo json_encode($arr);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function print_monthly_card($client_id = FALSE , $month = FALSE, $year = FALSE)
	{
		if($client_id)
		{
			$this->load->model("Inventory_model");
			$this->load->model("Client_model");
			$data["list_inventory"] = $this->Inventory_model->get_out_inventory_by_client($client_id,$month,$year);
			$data["client_data"] = $this->Client_model->get_client_by_id($client_id);

			$data["main_content"] = "Inventory/monthly_card";
			//$this->load->view("Admin/template",$data);
			$this->load->view("Inventory/monthly_card",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function get_inventory_details()
	{
		if($this->input->get())
		{
			$this->load->model("Client_model");
			$this->load->model("Inventory_model");

			$client_id = $this->input->get("client_id");
			$from_date = $this->input->get("from_date") ? $this->input->get("from_date") : "";
			$to_date = $this->input->get("to_date") ? $this->input->get("to_date") : "";

			$data["list_inventory"] = $this->Inventory_model->list_inventory($client_id,$from_date,$to_date);

			$data["client_data"] = $this->Client_model->get_client_by_id($client_id);
			$data["main_content"] = "Client/client_inventory_details";
			$this->load->view("Admin/template",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function get_client_details()
	{
		if($this->input->is_ajax_request())
		{
			$client_id = $this->input->post("client_id");
			$this->load->model("Client_model");
			$data["client_data"] = $this->Client_model->get_client_by_id($client_id);
			$this->load->view("Client/ajax-client_details",$data);
		}
		else
		{
			redirect(base_url());
		}
	}
}
?>