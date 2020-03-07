<?php
class Wooapi_model extends CI_Model
{
	public function validate_user_login($username,$password,$deviceId,$deviceType)
	{
		$this->db->select("umid,utid,status,uname");
		$this->db->where("uname",$username);
		$this->db->where("upwd",md5($password));
		$this->db->where("utid","2");
		$this->db->where("status","A");
		$query = $this->db->get("usermaster");
		if($query->num_rows() > 0)
		{
			$userId = $query->row()->umid;
			$this->User_model->addNewDevice($userId,$deviceId,$deviceType);

			$response["user"] = $query->row_array();
			$response["login"] = "success";
			$response["message"] = "Valid Username/Password!";
		}
		else 
		{
			$response["user"] = null;
			$response["login"] = "failed";
			$response["message"] = "Invalid Username/Password!";
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function addCustomer($inputParams)
	{
		$this->db->where("umid",$userId);
		$query = $this->db->get("siteusermaster");

		if($query->num_rows()>0)
		{
			$siteIdArr = array_column($query->result_array(),"smid");

			$this->db->where_in("smid",$siteIdArr);
			$this->db->order_by("sitemaster","ASC");
			$query = $this->db->get("sitemaster");
			if($query->num_rows() > 0)
			{
				$response["sites"] = $query->result_array();
			}
		}
		else
		{
			$response["sites"] = null;
		}
		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getMaterialUnits($materialId)
	{
		$this->db->where("imid",$materialId);
		$query = $this->db->get("itemunitmaster");
		if($query->num_rows()>0)
		{
			$materialUnitIdArr = array_column($query->result_array(),"muid");

			$this->db->where_in("muid",$materialUnitIdArr);
			$query = $this->db->get("metrrialunitmaster");
			if($query->num_rows() > 0)
			{
				$response["materialUnits"] = $query->result_array();
			}
			else 
			{
				$response["materialUnits"] = null;
			}
		}
		else 
		{
			$response["materialUnits"] = null;
		}
		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getMaterials()
	{
		$materials = "";
		//$this->db->order_by("imid","desc");
		$this->db->order_by("itemname","ASC");
		$query = $this->db->get("itemmaster");
		if($query->num_rows() > 0)
		{
			$query = $query->result_array();
			foreach($query as $data)
			{
				if($data["item_image"]=="")
				{
					$image = base_url()."upload/noproduct.png";
				}
				else
				{
					$image = base_url()."upload/materials/thumbs/".$data["item_image"];
				}
				$materials[] = array("imid"=>$data["imid"],
									"itemname"=>$data["itemname"],
									"base_rate"=>$data["base_rate"],
									"gst_rate"=>$data["gst_rate"],
									"item_image"=>$image,
									"descriptions"=>$data["descriptions"]
									);
			}
			$response["materials"] = $materials;
		}
		else
		{
			$response["materials"] = null;
		}
		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getMaterialsWithUnits()
	{
		$materials = "";
		//$this->db->order_by("imid","desc");
		$this->db->order_by("itemname","ASC");
		$query = $this->db->get("itemmaster");
		if($query->num_rows()>0)
		{
			$query = $query->result_array();
			foreach($query as $data)
			{
				$materialUnits = $this->Metrialunit_model->getMaterialUnitByMaterialId($data["imid"]);
				$units = array();
				
				foreach($materialUnits as $materialUnit)
				{
					$units[] = array("materialUnitId"=>$materialUnit["muid"],
									 "materialUnitName"=>$materialUnit["muname"]);
				}
				if($data["item_image"]=="")
				{
					$image = base_url()."upload/noproduct.png";
				}
				else
				{
					$image = base_url()."upload/materials/thumbs/".$data["item_image"];
				}
				$materials[] = array("imid"=>$data["imid"],
									"itemname"=>$data["itemname"],
									"base_rate"=>$data["base_rate"],
									"gst_rate"=>$data["gst_rate"],
									"item_image"=>$image,
									"descriptions"=>$data["descriptions"],
									"materialUnits"=>$units);
			}
			$response["materials"] = $materials;
		}
		else
		{
			$response["materials"] = null;
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getMaterialByCategoryId($categoryId)
	{
		$materialData = array();
		$categoryName = "";

		$this->db->select("a.imid,a.itemname,a.base_rate,a.descriptions,a.item_image,c.cmid,c.categoryname");
		$this->db->from("itemmaster as a");
		$this->db->join("itemcategorymaster as b","a.imid = b.imid","inner");
		$this->db->join("categorymaster as c","c.cmid = b.cmid","inner");
		$this->db->where("c.cmid",$categoryId);
		$this->db->order_by("a.itemname","ASC");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$query = $query->result_array();
			$categoryId = $query[0]["cmid"];
			$categoryName = $query[0]["categoryname"];
			foreach($query as $data)
			{
				if($data["item_image"]=="")
				{
					$materialImage = base_url()."upload/noproduct.png";
				}
				else
				{
					$materialImage = base_url()."upload/materials/thumbs/".$data["item_image"];
				}
				$materialData[] = array("materialId"=>$data["imid"],
										"materialName"=>$data["itemname"],
										"materialBaseRate"=>$data["base_rate"],
										"materialImage"=>$materialImage,
										"materialDescription"=>$data["descriptions"]
										);
			}
			$response["materials"] = array("categoryId"=>$categoryId,
										   "categoryName"=>$categoryName,
										   "materialData"=>$materialData
										   );
		}
		else
		{
			$response["materials"] = null;
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getCategories()
	{
		$categories = array();
		$this->db->order_by("categoryname","ASC");
		$query = $this->db->get("categorymaster");
		if($query->num_rows()>0)
		{
			foreach($query->result_array() as $data)
			{
				if($data["category_image"]=="")
				{
					$category_image = base_url()."upload/noproduct.png";
				}
				else 
				{
					$category_image = base_url()."upload/categories/thumbs/".$data["category_image"];
				}
				$categories[] = array("cmid"=>$data["cmid"],
									 "categoryname"=>$data["categoryname"],
									 "category_image"=>$category_image,
									 "created"=>$data["created"],
									 "modify"=>$data["modify"]);
			}
			$response["categories"] = $categories;
		}
		else
		{
			$response["categories"] = null;
		}
		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getVendors($userId)
	{
		$response["vendors"] = null;

		$siteIds = $this->Site_master->getSiteIdsByUserId($userId);
		if(count($siteIds) > 0)
		{
			$vendorIds = $this->Vendor_model->getVendorIdsBySitesIds($siteIds);
			if(count($vendorIds) > 0)
			{
				$vendors = $this->Vendor_model->getVendorByIds($vendorIds);
				if(count($vendors) > 0)
				{
					$vendorArr = array();
					foreach($vendors as $vendor)
					{
						$vendorArr[] = array("vendorId"=>$vendor["vid"],
											 "vendorName"=>$vendor["vname"]
											);
					}
					$response["vendors"] = $vendorArr;
				}
			}
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function placeMaterialRequest($materialRequestDetails)
	{
		//print_r($materialRequestDetails["products"]);
		$this->db->trans_start();
			$insArr = array("smid"=>$materialRequestDetails["siteId"],
							"umid"=>$materialRequestDetails["userId"],
							"requestdatetime"=>date("Y-m-d H:i:s"),
							"platform"=>"mobile_app",
							"created"=>date("Y-m-d H:i:s")
							);
			//$insArr = array_map("trim",$insArr);
			$this->db->insert("metrialrequestmaster",$insArr);
			$ins_id = $this->db->insert_id();

			$siteData = $this->Site_master->getSiteDetailsBySiteId($materialRequestDetails["siteId"]);

			$uniqueSiteId = $siteData["sitemaster"];

			$uniqueId = "MR/".date("Y")."/".$uniqueSiteId."/".$ins_id;

			$this->db->where("mrmid",$ins_id);
			$this->db->update("metrialrequestmaster",array("uniqueId"=>$uniqueId));

			$insArr = array();
			foreach($materialRequestDetails["products"] as $data)
			{
				$insArr[] = array("mrmid"=>trim($ins_id),
								  "imid"=>trim($data["materialId"]),
								  "qty"=>trim($data["quantity"]),
								  "unit_price"=>trim($data["unitPrice"]),
								  "discount"=>trim($data["discount"]),
								  "muid"=>trim($data["materialUnitId"]),
								  "remarks"=>trim($data["Remark"]),
								  "created"=>trim(date("Y-m-d H:i:s"))
								  );
			}

			//echo "<pre>"; print_r($insArr); echo "</pre>"; exit;
			$this->db->insert_batch("metrialrequestdetail",$insArr);

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"]  = "success";

			//fetch device id's of all the admins
			$adminDevices = $this->User_model->get_admin_device_ids();

			//fetch device id's of all the site managers for this particular site
			$siteUserDevices = $this->User_model->get_siteUser_device_ids($materialRequestDetails["siteId"]);
 
			$devices = array_merge($adminDevices,$siteUserDevices);
			if(count($devices) > 0)
			{
	          $msg = array
	          (
	              "message" => "Material Request has been placed",
	              "text" => "Material Request has Been Placed",
	              "title" => "Material Request",
	              "subtitle" => "Material Request",
	              "tickerText" => "Ticker text here...Ticker text here...Ticker text here",
	              "vibrate" => 1,
	              "sound" => 1,
	              "largeIcon" => "large_icon",
	              "smallIcon" => "small_icon"
	          );

			  $this->Gcm_model->sendPushNotificationToGCM($devices,$msg); // we can fetch response from this function
			}
		}
		else 
		{
			$response["message"]  = "fail";
		}
		$response["status"] = 1;
		$response["more"] = 1;
		
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function editMaterialRequest($materialRequestDetailId,$materialRequestId,$requestedQuantity,$unitPrice,$discount,$remarks)
	{
		$this->db->trans_start();

			$this->db->where("mrdid",$materialRequestDetailId);
			$this->db->update("metrialrequestdetail",array("qty"=>$requestedQuantity,"unit_price"=>$unitPrice,"discount"=>$discount,"remarks"=>$remarks));

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else
		{
			$response["message"] = "fail";
		}

		$response["status"] = 1;
		$response["more"] = 1;
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function addMrMaterial($materialRequestId,$materialId,$materialUnitId,$quantity,$unitPrice,$discount,$remarks)
	{
		$this->db->trans_start();

			$insArr = array("mrmid"=>$materialRequestId,
							"qty"=>$quantity,
							"imid"=>$materialId,
							"muid"=>$materialUnitId,
							"unit_price"=>$unitPrice,
							"discount"=>$discount,
							"remarks"=>$remarks,
							"created"=>date("Y-m-d H:i:s")
							);

			$this->db->insert("metrialrequestdetail",$insArr);

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else 
		{
			$response["message"] = "fail";
		}
		
		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function removeMrMaterial($materialRequestDetailId)
	{
		$this->db->trans_start();

			$this->db->where("mrdid",$materialRequestDetailId);
			$this->db->delete("metrialrequestdetail");

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else
		{
			$response["message"] = "fail";
		}

		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}

	public function deleteMaterialRequest($materialRequestId)
	{
		$this->db->trans_start();

			$this->db->where("mrmid",$materialRequestId);
			$this->db->delete("metrialrequestdetail");
			
			$this->db->where("mrmid",$materialRequestId);
			$this->db->delete("metrialrequestmaster");

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else 
		{
			$response["message"] = "fail";
		}
		
		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getMaterialRequestsWithDetails($userId)
	{
		$siteIds = $this->Site_master->getSiteIdsByUserId($userId);
		//print_r($siteIds);
		if(count($siteIds) > 0)
		{
			$this->db->where_in("smid",$siteIds);
			$this->db->order_by("mrmid","desc");
			$query = $this->db->get("metrialrequestmaster");
			if($query->num_rows() >0)
			{
				$materialRequests = array();
				foreach($query->result_array() as $data)
				{
					$is_editable = "yes";
					$created_date = $data["created"];
					$now_date = date("Y-m-d H:i:s");
					$days_diff = $this->db->query("SELECT DATEDIFF('$now_date','$created_date') as days_diff");
					$days_diff = $days_diff->row()->days_diff;

					if($days_diff > 1)
					{
						$is_editable = "no";
					}

					$siteData = $this->Site_master->getSiteDetailsBySiteId($data["smid"]);
					$requestDateTime = $data["requestdatetime"];
					if($requestDateTime!="")
					{
						$requestDateTime = date("d-m-Y",strtotime($requestDateTime));
					}
					$mrDetails = $this->Metrialrequest_model->get_metrialrequest_data($data["mrmid"]);
					$mrDetails = json_decode(json_encode($mrDetails),TRUE);

					$details = array();
					foreach($mrDetails as $detail)
					{
						$details[] = array("materialRequestDetailId"=>$detail["mrdid"],"materialId"=>$detail["imid"],"materialName"=>$detail["itemname"],"requestedQuantity"=>$detail["qty"],"materialUnitId"=>$detail["muid"],"materialUnitName"=>$detail["muname"],"unitPrice"=>$detail["unit_price"],"discount"=>$detail["discount"],"remarks"=>$detail["remarks"]);
					}
					$materialRequests[] = array("materialRequestId"=>$data["mrmid"],"uniqueId"=>$data["uniqueId"],"siteId"=>$data["smid"],"siteName"=>$siteData["sitemaster"],"requestDateTime"=>$requestDateTime,"is_editable"=>$is_editable,"details"=>$details);
				}
				$response["materialRequests"] = $materialRequests;
			}
			else
			{
				$response["materialRequests"] = null;
			}
		}
		else
		{
			$response["materialRequests"] = null;
		}
		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getPurchaseOrderWithDetails($userId)
	{
		$this->db->where("umid",$userId);
		$query = $this->db->get("siteusermaster");
		if($query->num_rows() > 0)
		{
			$sites = array_unique(array_column($query->result_array(),"smid"));

			$this->db->where_in("smid",$sites);
			$this->db->order_by("pomid","desc");
			$query = $this->db->get("purchaseordermaster");
			$purchaseOrders = $query->result_array();
			$purchaseOrdersArr = null;
			foreach($purchaseOrders as $data)
			{
				$siteName = "";
				$siteId = $data["smid"];
				$vendorId = $data["vid"];
				$purchaseOrderId = $data["pomid"];
				$uniqueId = $data["uniqueId"];
				$materialRequestId = $data["mrmid"];
				$freightAmount = $data["freight_amount"];
				
				$siteDetails = $this->Site_master->getSiteDetailsBySiteId($siteId);
				$vendorDetails = $this->Vendor_model->getVendorById($vendorId);
				if(!empty($siteDetails))
				{
					$siteName = $siteDetails["sitemaster"];
				}
				if(!empty($vendorDetails))
				{
					$vendorName = $vendorDetails["vname"];
				}

				$poDetails = $this->Purchaseorder_model->fetchPoDetailsById($data["pomid"]);
				$details = null;
				foreach($poDetails as $poDetail)
				{
					$materialUnitFullName = "";
					$materialUnitName = "";
					$materialName = "";

					$purchaseorderDetailId = $poDetail["podid"];
					$materialId = $poDetail["imid"];
					$approvedQuantity = $poDetail["qty"];
					$unitPrice = $poDetail["unit_price"];
					$discount = $poDetail["discount"];
					$cgst = $poDetail["cgst"];
					$sgst = $poDetail["sgst"];
					$remarks = $poDetail["remarks"];
					$materialUnitId = $poDetail["muid"];

					$materialUnitData = $this->Metrialunit_model->getMaterialUnitById($materialUnitId);
					$materialData = $this->Itemmaster_model->getMaterialById($materialId);
					$materialUnitFullName = $materialUnitData["mufullname"];
					$materialUnitName = $materialUnitData["muname"];

					$materialName = $materialData["itemname"];

					$details[] = array("purchaseorderDetailId"=>$purchaseorderDetailId,"materialId"=>$materialId,"materialName"=>$materialName,"approvedQuantity"=>$approvedQuantity,"materialUnitId"=>$materialUnitId,"materialUnitFullName"=>$materialUnitFullName,"materialUnitName"=>$materialUnitName,"unitPrice"=>$unitPrice,"discount"=>$discount,"cgst"=>$cgst,"sgst"=>$sgst,"remarks"=>$remarks);
				}

				$purchaseOrdersArr[] = array("purchaseOrderId"=>$purchaseOrderId,"uniqueId"=>$uniqueId,"materialRequestId"=>$materialRequestId,"siteId"=>$siteId,"siteName"=>$siteName,"vendorId"=>$vendorId,"vendorName"=>$vendorName,"freightAmount"=>$freightAmount,"details"=>$details);
			}
			$response["purchaseOrders"] = $purchaseOrdersArr;
		}
		else
		{
			$response["purchaseOrders"] = null;
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function createGoodsReceipt($goodsReceivedDetails)
	{
		//print_r($goodsReceivedDetails); die();
		$this->db->where("pomid",$goodsReceivedDetails["purchaseOrderId"]);
		$query = $this->db->get("purchaseordermaster");
		$smid = $query->row()->smid;
		$mrmid = $query->row()->mrmid;
		$vid = $query->row()->vid;

		$insArr = array("pomid"=>$goodsReceivedDetails["purchaseOrderId"],
						"umid"=>$goodsReceivedDetails["userId"],
						"smid"=>$smid,
						"mrmid"=>$mrmid,
						"vid"=>$vid,
						"company_challan_no"=>$goodsReceivedDetails["companyChallanNo"],
						"receive_date"=>date("Y-m-d",strtotime($goodsReceivedDetails["receive_date"])),
						"platform"=>"mobile_app",
						"created"=>date("Y-m-d H:i:s")
						);
		//$insArr = array_map("trim",$insArr);
		$this->db->trans_start();
			$this->db->insert("goodreceiptmaster",$insArr);
			$insert_id = $this->db->insert_id();

			$grnumber = "GRN".str_pad($insert_id,"3","0",STR_PAD_LEFT);

			$this->db->where("grmid",$insert_id);
			$this->db->update("goodreceiptmaster",array("grnumber"=>trim($grnumber)));

			$count = count($goodsReceivedDetails["Materials"]);
			$insArr = array();

			for($i=0;$i < $count;$i++)
			{
				$insArr[] = array("grmid"=>trim($insert_id),
								"imid"=>trim($goodsReceivedDetails["Materials"][$i]["materialId"]),
								"qty"=>trim($goodsReceivedDetails["Materials"][$i]["receivedQuantity"]),
								"unit_price"=>trim($goodsReceivedDetails["Materials"][$i]["unitPrice"]),
								"muid"=>trim($goodsReceivedDetails["Materials"][$i]["materialUnitId"]),
								"truck_no"=>trim($goodsReceivedDetails["Materials"][$i]["truckNo"]),
								"vendor_challan_no"=>trim($goodsReceivedDetails["Materials"][$i]["vendorChallanNo"]),
								"transporter"=>trim($goodsReceivedDetails["Materials"][$i]["transporter"]),
								"remarks"=>trim($goodsReceivedDetails["Materials"][$i]["remarks"]),
								"created"=>trim(date("Y-m-d H:i:s"))
								  );
			}
			$this->db->insert_batch("goodreceiptsdetails",$insArr);
		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"]  = "success";
		}
		else
		{
			$response["message"]  = "fail";
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getGoodsReceivedWithDetails($userId)
	{
		$this->db->where("umid",$userId);
		$query = $this->db->get("siteusermaster");
		if($query->num_rows() > 0)
		{
			$sites = array_unique(array_column($query->result_array(),"smid"));
			//$sites = array_map("trim",$sites);
			$this->db->where_in("smid",$sites);
			$this->db->order_by("grmid","desc");
			$query = $this->db->get("goodreceiptmaster");
			//echo $this->db->last_query();
			$goodsReceived = $query->result_array();
			$goodsReceivedArr = null;
			foreach($goodsReceived as $data)
			{
				$isGrnBilled = "0";
				$siteName = "";
				$siteId = $data["smid"];
				$goodsReceivedId = $data["grmid"];
				$purchaseOrderId = $data["pomid"];
				$materialRequestId = $data["mrmid"];
				$grnumber = $data["grnumber"];
				$receiveDate = $data["receive_date"];
				$companyChallanNo = $data["company_challan_no"];
				$siteDetails = $this->Site_master->getSiteDetailsBySiteId($siteId);
				$siteName = $siteDetails["sitemaster"];
				if($receiveDate!="")
				{
					$receiveDate = date("d-m-Y",strtotime($receiveDate));
				}
				$grnDetails = $this->Metrialrequest_model->getGoodsReceivedDetailsById($data["grmid"]);

				$tot_materials = count($grnDetails);
				$tot_billed_materials = $this->Metrialrequest_model->get_grn_in_bill_by_grn_id($data["grmid"]);
				if($tot_materials == $tot_billed_materials)
				{
					$isGrnBilled = "1";
				}
				$details = null;
				foreach($grnDetails as $grnDetail)
				{
					$isBilled = "0";
					$bill_rows = $this->Metrialrequest_model->checkGrnDetailIdInBill($grnDetail["grdid"]);
					if($bill_rows > 0)
					{
						$isBilled = "1";
					}
					$details[] = array("goodsReceivedDetailId"=>$grnDetail["grdid"],
										"materialName"=>$grnDetail["itemname"],
										"materialId"=>$grnDetail["imid"],
										"materialUnitId"=>$grnDetail["muid"],
										"materialUnitName"=>$grnDetail["muname"],
										"materialUnitFullName"=>$grnDetail["mufullname"],
										"unitPrice"=>$grnDetail["unit_price"],
										"truckNo"=>$grnDetail["truck_no"],
										"vendorChallanNo"=>$grnDetail["vendor_challan_no"],
										"transporter"=>$grnDetail["transporter"],
										"remarks"=>$grnDetail["remarks"],
										"receivedQuantity"=>$grnDetail["qty"],
										"isBilled"=>$isBilled
										);
				}
				$goodsReceivedArr[] = array("goodsReceivedId"=>$goodsReceivedId,"grnumber"=>$grnumber,"receiveDate"=>$receiveDate,"purchaseOrderId"=>$purchaseOrderId,"materialRequestId"=>$materialRequestId,"siteId"=>$siteId,"siteName"=>$siteName,"companyChallanNo"=>$companyChallanNo,"isGrnBilled"=>$isGrnBilled,"details"=>$details);
			}
			$response["goodsReceived"] = $goodsReceivedArr;
		}
		else 
		{
			$response["goodsReceived"] = null;
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function editGoodsReceived($goodsReceivedDetailId,$goodsReceivedId,$receivedQuantity,$companyChallanNo,$receivedDate,$unitPrice,$truckNo,$vendorChallanNo,$transporter,$remarks)
	{
		$this->db->trans_start();

			$this->db->where("grmid",$goodsReceivedId);
			$this->db->update("goodreceiptmaster",array("company_challan_no"=>$companyChallanNo,"receive_date"=>trim(date("Y-m-d",strtotime($receivedDate)))));

			$this->db->where("grdid",$goodsReceivedDetailId);
			$this->db->update("goodreceiptsdetails",array("qty"=>trim($receivedQuantity),
														  "unit_price"=>trim($unitPrice),
														  "truck_no"=>trim($truckNo),
														  "vendor_challan_no"=>trim($vendorChallanNo),
														  "transporter"=>trim($transporter),
														  "remarks"=>trim($remarks)));

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else
		{
			$response["message"] = "fail";
		}

		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function deleteGoodsReceived($goodsReceivedId)
	{
		$this->db->trans_start();

			$this->db->where("grmid",$goodsReceivedId);
			$this->db->delete("goodreceiptsdetails");
			
			$this->db->where("grmid",$goodsReceivedId);
			$this->db->delete("goodreceiptmaster");

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else 
		{
			$response["message"] = "fail";
		}
		
		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);		
	}
	public function getCashPurchaseWithDetails($userId)
	{
		$siteIds = $this->Site_master->getSiteIdsByUserId($userId);

		if(count($siteIds) > 0)
		{
			$this->db->where_in("smid",$siteIds);
			$this->db->order_by("cpid","desc");
			$query = $this->db->get("cashpurchase");
			if($query->num_rows() > 0)
			{
				foreach($query->result_array() as $data)
				{
					$cashPurchaseDetails = $this->Cashpurchase_model->getCashpurchaseById($data["cpid"]);
					$siteData = $this->Site_master->getSiteDetailsBySiteId($data["smid"]);
					$details = null;
					foreach($cashPurchaseDetails as $cpDetail)
					{
						$details[] = array("cashPurchaseDetailId"=>$cpDetail["detail_id"],
										  "materialName"=>$cpDetail["material_name"],
										  "materialUnit"=>$cpDetail["material_unit"],
										  "quantity"=>$cpDetail["quantity"],
										  "price"=>$cpDetail["price"],
										  "vendorChallanNo"=>$cpDetail["vendor_challan_no"],
										  "remarks"=>$cpDetail["remarks"]
										  );
					}

					$cashPurchaseArr[] = array("cashPurchaseId"=>$data["cpid"],
											   "vendorId"=>$data["vendor_name"],
											   "siteId"=>$data["smid"],
											   "siteName"=>$siteData["sitemaster"],
											   "companyChallanNo"=>$data["company_challan_no"],
											   "purchaseDate"=>date("d-m-Y",strtotime($data["purchasedate"])),"details"=>$details
												);
				}
				$response["cashPurchase"] = $cashPurchaseArr;
			}
			else
			{
				$response["cashPurchase"] = null;
			}
		}
		else
		{
			$response["cashPurchase"] = null;
		}

		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function addCashPurchase($cashPurchaseDetails)
	{
		$insArr = array("umid"=>$cashPurchaseDetails["userId"],
						"smid"=>$cashPurchaseDetails["siteId"],
						"vendor_name"=>$cashPurchaseDetails["vendorId"],
						"company_challan_no"=>$cashPurchaseDetails["companyChallanNo"],
						"purchasedate"=>date("Y-m-d",strtotime($cashPurchaseDetails["purchaseDate"])),
						"platform"=>"mobile_app",
						"created_on"=>date("Y-m-d H:i:s"));

		$this->db->trans_start();

			$this->db->insert("cashpurchase",$insArr);
			$ins_id = $this->db->insert_id();

			$insArr = array();
			for($i=0;$i<count($cashPurchaseDetails["Materials"]);$i++)
			{
				$insArr[] = array("cpid"=>$ins_id,
								  "material_name"=>$cashPurchaseDetails["Materials"][$i]["materialId"],
								  "material_unit"=>$cashPurchaseDetails["Materials"][$i]["materialUnitId"],
								  "quantity"=>$cashPurchaseDetails["Materials"][$i]["quantity"],
								  "vendor_challan_no"=>$cashPurchaseDetails["Materials"][$i]["vendorChallanNo"],
								  "remarks"=>$cashPurchaseDetails["Materials"][$i]["remarks"],
								  "price"=>$cashPurchaseDetails["Materials"][$i]["unitPrice"],
								  "created_on"=>date("Y-m-d"));
			}
			$this->db->insert_batch("cashpurchasedetails",$insArr);
		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else
		{
			$response["message"] = "fail";
		}

		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function editCashPurchase($userId,$cashPurchaseId,$cashPurchaseDetailId,$vendorId,$companyChallanNo,$materialId,$quantity,$siteId,$price,$vendorChallanNo,$remarks)
	{
		$updateArr = array("smid"=>$siteId,
						   "vendor_name"=>$vendorId,
						   "company_challan_no"=>$companyChallanNo
						   );

		$this->db->trans_start();

			$this->db->where("cpid",$cashPurchaseId);
			$this->db->update("cashpurchase",$updateArr);

			$updateArr = array();
			$updateArr = array("material_name"=>$materialId,
							   "quantity"=>$quantity,
							   "price"=>$price,
							   "vendor_challan_no"=>$vendorChallanNo,
							   "remarks"=>$remarks);

			$this->db->where("id",$cashPurchaseDetailId);
			$this->db->update("cashpurchasedetails",$updateArr);

		$this->db->trans_complete();

		if($this->db->trans_status()==TRUE)
		{
			$response["message"] = "success";
		}
		else
		{
			$response["message"] = "fail";
		}

		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function deleteCashPurchase($userId,$cashPurchaseId)
	{
		$this->db->trans_start();

			$this->db->where("cpid",$cashPurchaseId);
			$this->db->delete("cashpurchasedetails");

			$this->db->where("cpid",$cashPurchaseId);
			$this->db->delete("cashpurchase");

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else
		{
			$response["message"] = "fail";
		}

		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function createUOGoodsReceived($goodsReceivedDetails)
	{
		//print_r($goodsReceivedDetails); die();
		$insArr = array("umid"=>$goodsReceivedDetails["userId"],
						"site_id"=>$goodsReceivedDetails["siteId"],
						"vendor_name"=>$goodsReceivedDetails["vendorId"],
						"company_challan_no"=>$goodsReceivedDetails["companyChallanNo"],
						"receive_date"=>date("Y-m-d",strtotime($goodsReceivedDetails["receiveDate"])),
						"platform"=>"mobile_app",
						"created_on"=>date("Y-m-d H:i:s"));
		//$insArr = array_map("trim",$insArr);
		$this->db->trans_start();
			$this->db->insert("goodsreceivedunorder",$insArr);
			$insert_id = $this->db->insert_id();

			$grnumber = "UOGRN".str_pad($insert_id,"3","0",STR_PAD_LEFT);

			$this->db->where("id",$insert_id);
			$this->db->update("goodsreceivedunorder",array("grn"=>trim($grnumber)));

			$count = count($goodsReceivedDetails["Materials"]);
			$insArr = array();

			for($i=0;$i < $count;$i++)
			{
				$insArr[] = array("goods_receive_id"=>trim($insert_id),
								  "material_name"=>trim($goodsReceivedDetails["Materials"][$i]["materialname"]),
								  "material_unit"=>trim($goodsReceivedDetails["Materials"][$i]["materialunit"]),
								  "quantity"=>trim($goodsReceivedDetails["Materials"][$i]["materialquantity"]),
								  "unit_price"=>trim($goodsReceivedDetails["Materials"][$i]["materialprice"]),
								  "truck_no"=>trim($goodsReceivedDetails["Materials"][$i]["materialtrucknumber"]),
								  "vendor_challan_no"=>trim($goodsReceivedDetails["Materials"][$i]["vendorChallanNo"]),
								  "transporter"=>trim($goodsReceivedDetails["Materials"][$i]["transporter"]),
								  "remarks"=>trim($goodsReceivedDetails["Materials"][$i]["remarks"]),
								  "created_on"=>trim(date("Y-m-d H:i:s")));
			}
			$this->db->insert_batch("goodsreceivedunorder_details",$insArr);
		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"]  = "success";
		}
		else 
		{
			$response["message"]  = "fail";
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function getUOGoodsReceivedWithDetails($userId)
	{
		$this->db->where("umid",$userId);
		$query = $this->db->get("siteusermaster");
		if($query->num_rows() > 0)
		{
			$sites = array_unique(array_column($query->result_array(),"smid"));
			//$sites = array_map("trim",$sites);
			$this->db->where_in("site_id",$sites);
			$this->db->order_by("id","desc");
			$query = $this->db->get("goodsreceivedunorder");
			//echo $this->db->last_query();
			$goodsReceived = $query->result_array();
			$goodsReceivedArr = array();
			foreach($goodsReceived as $data)
			{
				$isGrnBilled = "0";
				$siteName = "";
				$siteId = $data["site_id"];
				$vendorId = $data["vendor_name"];
				$goodsReceivedId = $data["id"];
				$grnumber = $data["grn"];
				$companyChallanNo = $data["company_challan_no"];
				$receiveDate = $data["receive_date"];
				$siteDetails = $this->Site_master->getSiteDetailsBySiteId($siteId);
				$vendorDetails = $this->Vendor_model->getVendorById($vendorId);

				if(!empty($siteDetails))
				{
					$siteName = $siteDetails["sitemaster"];
				}
				if($receiveDate!="")
				{
					$receiveDate = date("d-m-Y",strtotime($receiveDate));
				}
				$uoGrnDetails = $this->Goodsreceived_model->getuoGrnDetailsByIds((array)$goodsReceivedId,"");
				$tot_materials = count($uoGrnDetails);
				$billed_materials = $this->Goodsreceived_model->get_uogrn_in_bill_by_grn_id($data["id"]);
				if($billed_materials == $tot_materials)
				{
					$isGrnBilled = "1";
				}
				$details = null;
				if(count($uoGrnDetails)>0)
				{
					foreach($uoGrnDetails as $uoGrnDetail)
					{
						$is_billed = "0";
						// check if this grn material has been billed or not
						$bill_rows = $this->Goodsreceived_model->checkUoGrnDetailIdInBill($uoGrnDetail["id"]);

						if($bill_rows > 0)
						{
							$is_billed = "1";
						}

						$details[] = array("goodsReceivedDetailId"=>$uoGrnDetail["id"],
										   "materialName"=>$uoGrnDetail["itemname"],
										   "materialId"=>$uoGrnDetail["material_name"],
										   "materialUnitName"=>$uoGrnDetail["muname"],
										   "materialUnitId"=>$uoGrnDetail["material_unit"],
										   "receivedQuantity"=>$uoGrnDetail["quantity"],
										   "unitPrice"=>$uoGrnDetail["unit_price"],
										   "truckNo"=>$uoGrnDetail["truck_no"],
										   "vendorChallanNo"=>$uoGrnDetail["vendor_challan_no"],
										   "transporter"=>$uoGrnDetail["transporter"],
										   "remarks"=>$uoGrnDetail["remarks"],
										   "isBilled"=>$is_billed
										   );
					}
				}
				$goodsReceivedArr[] = array("goodsReceivedId"=>$goodsReceivedId,"grnumber"=>$grnumber,"siteId"=>$siteId,"siteName"=>$siteName,"vendorId"=>$vendorDetails["vid"],"vendorName"=>$vendorDetails["vname"],"companyChallanNo"=>$companyChallanNo,"receiveDate"=>$receiveDate,"isGrnBilled"=>$isGrnBilled,"details"=>$details);
			}
			$response["goodsReceived"] = $goodsReceivedArr;
		}
		else
		{
			$response["goodsReceived"] = null;
		}

		$response["status"] = "1";
		$response["more"] = "1";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function editUOGoodsReceived($goodsReceivedId,$goodsReceivedDetailId,$vendorName,$companyChallanNo,$receivedDate,$receivedQuantity,$unitPrice,$truckNo,$vendorChallanNo,$transporter,$remarks)
	{
		$this->db->trans_start();

			$this->db->where("id",$goodsReceivedId);
			$this->db->update("goodsreceivedunorder",array("vendor_name"=>$vendorName,"company_challan_no"=>$companyChallanNo,"receive_date"=>trim(date("Y-m-d",strtotime($receivedDate)))));

			$this->db->where("id",$goodsReceivedDetailId);
			$this->db->update("goodsreceivedunorder_details",array("quantity"=>trim($receivedQuantity),
																   "unit_price"=>trim($unitPrice),
																   "vendor_challan_no"=>trim($vendorChallanNo),
																   "transporter"=>trim($transporter),
																   "truck_no"=>trim($truckNo),
																   "remarks"=>$remarks)
																	);

		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else
		{
			$response["message"] = "fail";
		}

		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
	public function deleteUOGoodsReceived($goodsReceivedId)
	{
		$this->db->trans_start();
			$this->db->where("id",$goodsReceivedId);
			$this->db->delete("goodsreceivedunorder");

			$this->db->where("goods_receive_id",$goodsReceivedId);
			$this->db->delete("goodsreceivedunorder_details");
		$this->db->trans_complete();

		if($this->db->trans_status()===TRUE)
		{
			$response["message"] = "success";
		}
		else
		{
			$response["message"] = "fail";
		}

		$response["status"] = 1;
		$response["more"] = 1;

		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
}
?>