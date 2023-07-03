<?php

 namespace App\Controllers;

 use App\Models\NotificationModel;
 

class Notification extends BaseController
{
	public function __construct()
    {

		$this->notificationModel = new NotificationModel();
		
    }

	public function index(){
		// showNotification.php
		$notifs = $this->notificationModel->getAll() ?? [];
		$notifRet = "";
		foreach($notifs as $n){
			$notifRet .= 
			"<div>"//mark as seen button
				.toast($n["name"],$n["text"],$n["theme"],false,"w-100")
			."</div>";
		}

		$data = [
			"title" => "Show missed Notifications",
			"notifications" => $notifRet,
		];

		echo view('Notification/showNotification', $data);

	}

	public function add(){
		$data = [
			"title" => "Add Notification",
			"action"	=> "createNotification",
			"notifPreview" => toast("Name","Text","success","true")
		];
		echo view('Notification/detailNotification', $data);

	}

	public function refresh(){
		$notif = $this->notificationModel->getUnseen();
		$ret = "";
		foreach($notif as $n){
			$ret .= toast($n["title"],$n["text"],$n["theme"]);
		}

		return $ret;
	}

	//--------------------------------------------------------------------

}
