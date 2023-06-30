<?php

namespace App\Controllers;

use App\Controllers\Url;

use App\Models\TrackerModel;
use App\Models\ActivityModel;

class Tracker extends BaseController
{
    public function __construct()
    {
		$this->url = new Url();

        $this->trackerModel = new TrackerModel();
		$this->activityModel = new ActivityModel();
    }

	public function index()
	{
		$data = [
			"title" => "Tracker",
			"toast" => toast("v Konzoli zavolej testToast()", "success"),
			"tracker" => $this->trackerModel->getAll(),
			"active" => $this->trackerModel->getActive(),
			"activities" => $this->activityModel->getAll()
		];

		if(count($data["active"])>0){
			$diffInSeconds = time() - $data["active"]["from"];
			$data["tracked"] = [
				"hour" => sprintf("%02d",floor($diffInSeconds / 3600)),
				"min" => sprintf("%02d",floor(($diffInSeconds % 3600) / 60)),
				"sec" =>sprintf("%02d",$diffInSeconds % 60)
			];
		}
		echo view('tracker', $data);
	}

	public function startTracker($params)
	{
		$dbData = [
			"activity_id" => $params["activity_id"],
			"from" => time(),
			"to" => null,
			"active" => 1,
			"name" => empty($params["name"])?"(Unset)":$params["name"],
		];

		$id = $this->trackerModel->startTracker($dbData);
		$url = $this->url->generate_url($id, 3);
		return $url;

	}

	public function stopTracker($params)
	{
		$id = $this->url->get_id($params["url"],3);
		$dbData = [
			"id" => $id,
			"to" => time(),
			"active" => 0,
			"name"	=> empty($params["name"])?"(Unset)":$params["name"],
		];
		$t = $this->trackerModel->stopTracker($dbData);
		return $this->loadTrackDiv([
			"color" => $t["activity_color"],
			"activity"	=> $t["activity"],
			"name"	=> $t["name"],
			"from"	=> $t["from"],
			"to"	=> $t["to"],
			"url"	=> $t["url"],
		]);
	}

	public function loadHistory(){
		
		$trackers = array_reverse($this->trackerModel->getAll());
		$ret = "";
		if(count($trackers)==0)
			return "<span class='emptyRecords w-100 text-center d-block'>Empty Records</span>";
		foreach($trackers as $t){
			$ret .= $this->loadTrackDiv([
				"color" => $t["activity_color"],
				"activity"	=> $t["activity"],
				"name"	=> $t["name"],
				"from"	=> $t["from"],
				"to"	=> $t["to"],
				"url"	=> $t["url"],
			]);
		}
		return $ret;
	}

	public function loadTrackDiv($data){
		$diffInSeconds = $data["to"] - $data["from"];
		$hour = sprintf("%02d",floor($diffInSeconds / 3600));
		$min = sprintf("%02d",floor(($diffInSeconds % 3600) / 60));
		$sec = sprintf("%02d",$diffInSeconds % 60);

		$ret = "
		<div id='trackHistoryRecord_{$data["url"]}' class='w-100 border-0 border-bottom rounded d-flex justify-content-between px-2 align-items-center mb-3'>
			<span>
				<span style='width:0.9rem;height:0.9rem;background:{$data["color"]}' class='rounded-circle d-inline-block me-2'></span>
				<span>{$data["name"]}</span>
				<span id='trackerStart_{$data["url"]}' class='text-white-50 ms-3' style='font-size: 0.75rem;'> ".date("d.m h:i:s",$data["from"])."</span>
			</span>
			<span> 
			<span id='trackerTime_{$data["url"]}' class='' style='font-size: 1.45rem'>
				<button onclick=tModal('trackerChangeDate',['{$data["url"]}',3]) class='text-white-50 btn btn-sm btn-dark p-0 my-2' data-bs-toggle='modal' data-bs-target='#exampleModal'><span id='hours_{$data["url"]}'>{$hour}</span>:<span id='minutes_{$data["url"]}'>{$min}</span>:<span id='seconds_{$data["url"]}'>{$sec}</button>
			</span>
				<button class='ms-1 pt-1 btn btn-outline-danger' onclick='deleteTrackerRecord(this,".('"'.$data["url"].'"').")'>
					<i class='fa-solid fa-trash'></i>
				</button>
			</span>
		</div>
		";
		return $ret;
	}

	public function getTimeModalData($url,$page_type_id){
		return $this->trackerModel->getTimeModalData($url,$page_type_id);
	}

	public function updateTimeTrackData($url,$from,$to){
		$id = $this->url->get_id($url,3);
		return $this->trackerModel->updateTimeTrackData($id,$from,$to);
	
	}

	public function deleteRecord($url){
		return $this->trackerModel->deleteRecord($url);
	}

	public function updateTrackerName($params){
		$name = $params["name"] ?? "(unset)";
		$id = $this->url->get_id($params["url"],3);
		$this->trackerModel->updateTrackerName($id,$name);
			
	}

	//--------------------------------------------------------------------

}