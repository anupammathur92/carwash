<?php
class Partnerapi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Partnerapi_model");
		$this->load->model("Admin_fcm_model");
		$this->load->model("Gcm_model");
	}
	public function index()
	{
		$secureKey = $this->uri->segment("2");
		if($secureKey=="asdfghjkl")
		{
			$serviceCall = $this->uri->segment("3");
			switch($serviceCall)
			{
				case "userLogin":
					$this->userLogin();
					break;
				case "getUserSites":
					$this->getUserSites();
					break;
				case "getMaterialUnits":
					$this->getMaterialUnits();
					break;
				case "getCategories":
					$this->getCategories();
					break;
				case "getMaterials":
					$this->getMaterials();
					break;
				case "getMaterialByCategoryId":
					$this->getMaterialByCategoryId();
					break;
				case "getMaterialsWithUnits":
					$this->getMaterialsWithUnits();
					break;
				case "getVendors":
					$this->getVendors();
					break;
				case "placeMaterialRequest":
					$this->placeMaterialRequest();
					break;
				case "editMaterialRequest":
					$this->editMaterialRequest();
					break;
				case "getMaterialRequestsWithDetails":
					$this->getMaterialRequestsWithDetails();
					break;
				case "deleteMaterialRequest":
					$this->deleteMaterialRequest();
					break;
				case "addMrMaterial":
					$this->addMrMaterial();
					break;
				case "removeMrMaterial":
					$this->removeMrMaterial();
					break;
				case "getPurchaseOrderWithDetails":
					$this->getPurchaseOrderWithDetails();
					break;
				case "createGoodsReceipt":
					$this->createGoodsReceipt();
					break;
				case "getGoodsReceivedWithDetails":
					$this->getGoodsReceivedWithDetails();
					break;
				case "editGoodsReceived":
					$this->editGoodsReceived();
					break;
				case "deleteGoodsReceived":
					$this->deleteGoodsReceived();
					break;
				case "getCashPurchaseWithDetails":
					$this->getCashPurchaseWithDetails();
					break;
				case "addCashPurchase":
					$this->addCashPurchase();
					break;
				case "editCashPurchase":
					$this->editCashPurchase();
					break;
				case "deleteCashPurchase":
					$this->deleteCashPurchase();
					break;
				case "createUOGoodsReceived":
					$this->createUOGoodsReceived();
					break;
				case "getUOGoodsReceivedWithDetails":
					$this->getUOGoodsReceivedWithDetails();
					break;
				case "editUOGoodsReceived":
					$this->editUOGoodsReceived();
					break;
				case "deleteUOGoodsReceived":
					$this->deleteUOGoodsReceived();
					break;
				default:
					echo "Something went wrong!";
			}
		}
		else
		{
			$this->something_went_wrong();
		}
	}
	private function filter($data)
	{
		$data = trim(htmlentities(strip_tags($data)));
		$data = stripslashes($data);
		return $data;
	}
	private function userLogin()
	{
		$username = "";
		$password = "";
		$deviceId = "";
		$deviceType = "";
		
		if($this->input->post("username"))
			$username = $this->filter($this->input->post("username"));
			
		if($this->input->post("password"))
			$password = $this->filter($this->input->post("password"));
			
		if($this->input->post("deviceId"))
			$deviceId = $this->filter($this->input->post("deviceId"));
			
		if($this->input->post("deviceType"))
			$deviceType = $this->filter($this->input->post("deviceType"));
		
		if($username && $password)
			$this->Wooapi_model->validate_user_login($username,$password,$deviceId,$deviceType);
		else
			$this->something_went_wrong();
	}
	private function getUserSites()
	{
		$userId = "";

		if($this->input->post("userId"))
			$userId = $this->filter($this->input->post("userId"));

		if($userId)
			$this->Wooapi_model->getUserSites($userId);
		else
			$this->something_went_wrong();
	}
	private function getMaterialUnits()
	{
		$materialId = "";
		
		if($this->input->post("materialId"))
			$materialId = $this->filter($this->input->post("materialId"));

		if($materialId)
			$this->Wooapi_model->getMaterialUnits($materialId);
		else
			$this->something_went_wrong();
	}
	private function getMaterials()
	{
		$this->Wooapi_model->getMaterials();
	}
	private function getMaterialsWithUnits()
	{
		$this->Wooapi_model->getMaterialsWithUnits();
	}
	private function getMaterialByCategoryId()
	{
		$categoryId = "";

		if($this->input->post("categoryId"))
			$categoryId = $this->filter($this->input->post("categoryId"));

		if($categoryId)
			$this->Wooapi_model->getMaterialByCategoryId($categoryId);
		else
			$this->something_went_wrong();
	}
	private function getCategories()
	{
		$this->Wooapi_model->getCategories();
	}
	private function getVendors()
	{
		$userId = "";
		
		if($this->input->post("userId"))
			$userId = $this->input->post("userId");
		
		if($userId)
			$this->Wooapi_model->getVendors($userId);
		else
			$this->something_went_wrong();
	}
	private function placeMaterialRequest()
	{
		$materialRequestDetails = json_decode(file_get_contents("php://input"),TRUE);
		if(isset($materialRequestDetails["userId"]) && !empty($materialRequestDetails["userId"]))
			$this->Wooapi_model->placeMaterialRequest($materialRequestDetails);
		else 
			$this->something_went_wrong();
	}
	private function editMaterialRequest()
	{
		$materialRequestId = "";
		$materialRequestDetailId = "";
		$requestedQuantity = "";
		$discount = "";
		$unitPrice = "";
		$remarks = "";

		if($this->input->post("materialRequestId"))
			$materialRequestId = $this->filter($this->input->post("materialRequestId"));
			
		if($this->input->post("materialRequestDetailId"))
			$materialRequestDetailId = $this->filter($this->input->post("materialRequestDetailId"));
			
		if($this->input->post("requestedQuantity"))
			$requestedQuantity = $this->filter($this->input->post("requestedQuantity"));

		if($this->input->post("discount"))
			$discount = $this->filter($this->input->post("discount"));

		if($this->input->post("unitPrice"))
			$unitPrice = $this->filter($this->input->post("unitPrice"));

		if($this->input->post("Remark"))
			$remarks = $this->filter($this->input->post("Remark"));

		if($materialRequestDetailId)
			$this->Wooapi_model->editMaterialRequest($materialRequestDetailId,$materialRequestId,$requestedQuantity,$unitPrice,$discount,$remarks);
		else
			$this->something_went_wrong();
	}
	private function addMrMaterial()
	{
		$materialRequestId = "";
		$materialId = "";
		$materialUnitId = "";
		$quantity = "";
		$unitPrice = "";
		$discount = "";
		$remarks = "";

		if($this->input->post("materialRequestId"))
			$materialRequestId = $this->filter($this->input->post("materialRequestId"));

		if($this->input->post("materialId"))
			$materialId = $this->filter($this->input->post("materialId"));

		if($this->input->post("materialUnitId"))
			$materialUnitId = $this->filter($this->input->post("materialUnitId"));

		if($this->input->post("quantity"))
			$quantity = $this->filter($this->input->post("quantity"));

		if($this->input->post("unitPrice"))
			$unitPrice = $this->filter($this->input->post("unitPrice"));

		if($this->input->post("discount"))
			$discount = $this->filter($this->input->post("discount"));

		if($this->input->post("remarks"))
			$remarks = $this->filter($this->input->post("remarks"));

		if($materialRequestId && $materialId && $materialUnitId && $quantity && $unitPrice && $discount && $remarks)
			$this->Wooapi_model->addMrMaterial($materialRequestId,$materialId,$materialUnitId,$quantity,$unitPrice,$discount,$remarks);
		else
			$this->something_went_wrong();
	}
	private function removeMrMaterial()
	{
		$materialRequestDetailId = "";

		if($this->input->post("materialRequestDetailId"))
			$materialRequestDetailId = $this->filter($this->input->post("materialRequestDetailId"));
			
		if($materialRequestDetailId)
			$this->Wooapi_model->removeMrMaterial($materialRequestDetailId);
		else
			$this->something_went_wrong();
	}
	private function deleteMaterialRequest()
	{
		$materialRequestId = "";
		
		if($this->input->post("materialRequestId"))
			$materialRequestId = $this->filter($this->input->post("materialRequestId"));
			
		if($materialRequestId)
			$this->Wooapi_model->deleteMaterialRequest($materialRequestId);
		else
			$this->something_went_wrong();				
	}
	private function getMaterialRequestsWithDetails()
	{
		$userId = "";

		if($this->input->post("userId"))
			$userId = $this->filter($this->input->post("userId"));

		if($userId)
			$this->Wooapi_model->getMaterialRequestsWithDetails($userId);
		else
			$this->something_went_wrong();
	}
	private function getPurchaseOrderWithDetails()
	{
		$userId = "";

		if($this->input->post("userId"))
			$userId = $this->filter($this->input->post("userId"));

		if($userId)
			$this->Wooapi_model->getPurchaseOrderWithDetails($userId);
		else
			$this->something_went_wrong();
	}
	private function createGoodsReceipt()
	{
		$goodsReceivedDetails = json_decode(file_get_contents("php://input"),TRUE);

		if(isset($goodsReceivedDetails["userId"]) && !empty($goodsReceivedDetails["userId"]))
			$this->Wooapi_model->createGoodsReceipt($goodsReceivedDetails);
		else 
			$this->something_went_wrong();
	}
	private function getGoodsReceivedWithDetails()
	{
		$userId = "";

		if($this->input->post("userId"))
			$userId = $this->filter($this->input->post("userId"));

		if($userId)
			$this->Wooapi_model->getGoodsReceivedWithDetails($userId);
		else
			$this->something_went_wrong();
	}
	private function editGoodsReceived()
	{
		$goodsReceivedId = "";
		$goodsReceivedDetailId = "";
		$receivedQuantity = "";
		$companyChallanNo = "";
		$receivedDate = "";
		$unitPrice = "";
		$truckNo = "";
		$vendorChallanNo = "";
		$transporter = "";
		$remarks = "";

		if($this->input->post("goodsReceivedId"))
			$goodsReceivedId = $this->filter($this->input->post("goodsReceivedId"));
			
		if($this->input->post("goodsReceivedDetailId"))
			$goodsReceivedDetailId = $this->filter($this->input->post("goodsReceivedDetailId"));
			
		if($this->input->post("receivedQuantity"))
			$receivedQuantity = $this->filter($this->input->post("receivedQuantity"));

		if($this->input->post("companyChallanNo"))
			$companyChallanNo = $this->filter($this->input->post("companyChallanNo"));

		if($this->input->post("unitPrice"))
			$unitPrice = $this->filter($this->input->post("unitPrice"));

		if($this->input->post("truckNo"))
			$truckNo = $this->filter($this->input->post("truckNo"));

		if($this->input->post("vendorChallanNo"))
			$vendorChallanNo = $this->filter($this->input->post("vendorChallanNo"));

		if($this->input->post("transporter"))
			$transporter = $this->filter($this->input->post("transporter"));

		if($this->input->post("remarks"))
			$remarks = $this->filter($this->input->post("remarks"));		
			
		if($this->input->post("receivedDate"))
			$receivedDate = $this->filter($this->input->post("receivedDate"));

		if($goodsReceivedId && $goodsReceivedDetailId)
			$this->Wooapi_model->editGoodsReceived($goodsReceivedDetailId,$goodsReceivedId,$receivedQuantity,$companyChallanNo,$receivedDate,$unitPrice,$truckNo,$vendorChallanNo,$transporter,$remarks);
		else
			$this->something_went_wrong();
	}
	private function deleteGoodsReceived()
	{
		$goodsReceivedId = "";
		
		if($this->input->post("goodsReceivedId"))
			$goodsReceivedId = $this->filter($this->input->post("goodsReceivedId"));
			
		if($goodsReceivedId)
			$this->Wooapi_model->deleteGoodsReceived($goodsReceivedId);
		else
			$this->something_went_wrong();				
	}
	private function getCashPurchaseWithDetails()
	{
		$userId = "";
		
		if($this->input->post("userId"))
			$userId = $this->filter($this->input->post("userId"));			
			
		if($userId)
			$this->Wooapi_model->getCashPurchaseWithDetails($userId);
		else
			$this->something_went_wrong();
	}
	private function addCashPurchase()
	{
		$cashPurchaseDetails = json_decode(file_get_contents("php://input"),TRUE);
		if(isset($cashPurchaseDetails["userId"]) && !empty($cashPurchaseDetails["userId"]))
			$this->Wooapi_model->addCashPurchase($cashPurchaseDetails);
		else
			$this->something_went_wrong();
	}
	private function editCashPurchase()
	{
		$userId = "";
		$cashPurchaseId = "";
		$cashPurchaseDetailId = "";
		$siteId = "";
		$vendorId = "";
		$companyChallanNo = "";
		$materialId = "";
		//$materialUnitId = "";
		$quantity = "";
		$price = "";
		$vendorChallanNo = "";
		$remarks = "";
		//$purchaseDate = "";

		if($this->input->post("userId"))
			$userId = $this->filter($this->input->post("userId"));

		if($this->input->post("cashPurchaseId"))
			$cashPurchaseId = $this->filter($this->input->post("cashPurchaseId"));

		if($this->input->post("cashPurchaseDetailId"))
			$cashPurchaseDetailId = $this->filter($this->input->post("cashPurchaseDetailId"));

		if($this->input->post("siteId"))
			$siteId = $this->filter($this->input->post("siteId"));

		if($this->input->post("vendorId"))
			$vendorId = $this->filter($this->input->post("vendorId"));

		if($this->input->post("companyChallanNo"))
			$companyChallanNo = $this->filter($this->input->post("companyChallanNo"));

		if($this->input->post("materialId"))
			$materialId = $this->filter($this->input->post("materialId"));

		/*if($this->input->post("materialUnitId"))
			$materialUnitId = $this->filter($this->input->post("materialUnitId"));*/

		if($this->input->post("quantity"))
			$quantity = $this->filter($this->input->post("quantity"));

		if($this->input->post("price"))
			$price = $this->filter($this->input->post("price"));

		if($this->input->post("vendorChallanNo"))
			$vendorChallanNo = $this->filter($this->input->post("vendorChallanNo"));

		if($this->input->post("remarks"))
			$remarks = $this->filter($this->input->post("remarks"));

		/*if($this->input->post("purchaseDate"))
			$purchaseDate = $this->filter($this->input->post("purchaseDate"));*/

		if($cashPurchaseId && $cashPurchaseDetailId)
			$this->Wooapi_model->editCashPurchase($userId,$cashPurchaseId,$cashPurchaseDetailId,$vendorId,$companyChallanNo,$materialId,$quantity,$siteId,$price,$vendorChallanNo,$remarks);
		else
			$this->something_went_wrong();
	}
	private function deleteCashPurchase()
	{
		$userId = "";
		$cashPurchaseId = "";

		if($this->input->post("userId"))
			$userId = $this->filter($this->input->post("userId"));

		if($this->input->post("cashPurchaseId"))
			$cashPurchaseId = $this->filter($this->input->post("cashPurchaseId"));

		if($cashPurchaseId)
			$this->Wooapi_model->deleteCashPurchase($userId,$cashPurchaseId);
		else
			$this->something_went_wrong();
	}
	private function createUOGoodsReceived()
	{
		$goodsReceivedDetails = json_decode(file_get_contents("php://input"),TRUE);
		//print_r($goodsReceivedDetails); die();
		if(isset($goodsReceivedDetails["userId"]) && !empty($goodsReceivedDetails["userId"]))
			$this->Wooapi_model->createUOGoodsReceived($goodsReceivedDetails);
		else 
			$this->something_went_wrong();
	}
	private function getUOGoodsReceivedWithDetails()
	{
		$userId = "";

		if($this->input->post("userId"))
			$userId = $this->filter($this->input->post("userId"));

		if($userId)
			$this->Wooapi_model->getUOGoodsReceivedWithDetails($userId);
		else
			$this->something_went_wrong();
	}
	private function editUOGoodsReceived()
	{
		$goodsReceivedId = "";
		$goodsReceivedDetailId = "";
		//$siteId = "";
		$vendorName = "";
		$companyChallanNo = "";
		$receivedDate = "";
		//$materialName = "";
		//$materialUnit = "";
		$receivedQuantity = "";
		$unitPrice = "";
		$truckNo = "";
		$vendorChallanNo = "";
		$transporter = "";
		$remarks = "";

		if($this->input->post("goodsReceivedId"))
			$goodsReceivedId = $this->filter($this->input->post("goodsReceivedId"));
			
		if($this->input->post("goodsReceivedDetailId"))
			$goodsReceivedDetailId = $this->filter($this->input->post("goodsReceivedDetailId"));

		/*if($this->input->post("siteId"))
			$siteId = $this->filter($this->input->post("siteId"));*/

		if($this->input->post("vendorName"))
			$vendorName = $this->filter($this->input->post("vendorName"));

		if($this->input->post("companyChallanNo"))
			$companyChallanNo = $this->filter($this->input->post("companyChallanNo"));

		if($this->input->post("receivedDate"))
			$receivedDate = $this->filter($this->input->post("receivedDate"));

		/*if($this->input->post("materialName"))
			$materialName = $this->filter($this->input->post("materialName"));*/

		/*if($this->input->post("materialUnit"))
			$materialUnit = $this->filter($this->input->post("materialUnit"));*/

		if($this->input->post("receivedQuantity"))
			$receivedQuantity = $this->filter($this->input->post("receivedQuantity"));

		if($this->input->post("unitPrice"))
			$unitPrice = $this->filter($this->input->post("unitPrice"));

		if($this->input->post("truckNo"))
			$truckNo = $this->filter($this->input->post("truckNo"));

		if($this->input->post("vendorChallanNo"))
			$vendorChallanNo = $this->filter($this->input->post("vendorChallanNo"));

		if($this->input->post("transporter"))
			$transporter = $this->filter($this->input->post("transporter"));

		if($this->input->post("remarks"))
			$remarks = $this->filter($this->input->post("remarks"));

		if($goodsReceivedId && $goodsReceivedDetailId)
			$this->Wooapi_model->editUOGoodsReceived($goodsReceivedId,$goodsReceivedDetailId,$vendorName,$companyChallanNo,$receivedDate,$receivedQuantity,$unitPrice,$truckNo,$vendorChallanNo,$transporter,$remarks);
		else
			$this->something_went_wrong();
	}
	private function deleteUOGoodsReceived()
	{
		$goodsReceivedId = "";

		if($this->input->post("goodsReceivedId"))
			$goodsReceivedId = $this->filter($this->input->post("goodsReceivedId"));

		if($goodsReceivedId)
			$this->Wooapi_model->deleteUOGoodsReceived($goodsReceivedId);
		else
			$this->something_went_wrong();
	}
	private function something_went_wrong()
	{
		$response["status"] = 0;
		$response["error"] = "Oop's something went wrong";
		echo json_encode($response,JSON_UNESCAPED_SLASHES);
	}
}
?>