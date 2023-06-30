<?php

namespace App\Controllers;

/* CONTROLLERS */
use App\Controllers\Tracker;
       
/* MODELS */

class Ajax extends BaseController
{
    public function __construct(){
        /* CONTROLLERS */
       $this->tracker = new Tracker();
        /* MODELS */
        
    }
	public function index()
	{
        $params = isset($_POST["params"])?$_POST["params"]:null;
        switch($_POST["action"]){
            case "testToast":
                return toast("Test Toasty","Test toast Text", "success").
                toast("Primary","Test toast Text", "primary").
                toast("Secondary","Test toast Text", "secondary").
                toast("Info","Test toast Text", "info").
                toast("Warning Toasty","Test toast Text", "warning").
                toast("Danger Toasty","Test toast Text", "danger");
                break;
            case "modal":
                $type = $params["type"];
                $data = $params["data"];

                switch($type){
                    case "trackerChangeDate":
                        $url = $data[0];
                        $page_type_id = $data[1];
                        $times = $this->tracker->getTimeModalData($url,$page_type_id);
                        $body = "
                            <span>
                                <input class='form-control dateFrom' type='datetime-local' id='from_".$url."' value='".date("Y-m-d H:i:s",$times["from"])."'>
                                <input class='form-control mt-2 dateTo' type='datetime-local' id='to_".$url."' value='".date("Y-m-d H:i:s",$times["to"])."'>
                                <button data-url='{$url}' class='btn btn-primary mt-2 float-end' onclick='updateTimeTrackData(this)'>Update</button>
                            </span>
                        ";
                        return json_encode(["title"=> "Change Tracker Time Span","body"=>$body]);
                        break;
                    default:
                        return json_encode(["title"=> "Modal Default Title","body"=>""]);
                }

                break;
            case "updateTimeTrackData":
                $url = $params["url"];
                $from = strtotime($params["timeFrom"]);
                $to = strtotime($params["timeTo"]);
                $this->tracker->updateTimeTrackData($url,$from,$to);
                $diffInSeconds = $to - $from;
                return json_encode([
                    "startFormated" => date("d.m H:i:s",$from),
                    "hour"  => sprintf("%02d",floor($diffInSeconds / 3600)),
                    "min"   => sprintf("%02d",floor(($diffInSeconds % 3600) / 60)),
                    "sec"   => sprintf("%02d",$diffInSeconds % 60),
                ]);

                break;
            case "toast":
                $title = $params["title"]       ?? "Toast";
                $message = $params["message"]   ?? "";
                $type = $params["type"]         ?? "info";
                return toast($title,$message,$type);
                break;
            case "startTracker":
                return $this->tracker->startTracker($params);
                break;
            case "stopTracker":
                return $this->tracker->stopTracker($params);
                break;
            case "loadTrackerHistory":
                return $this->tracker->loadHistory();
                break;
            case "deleteTrackerRecord":
                return $this->tracker->deleteRecord($params["url"]);
                break;
            default:
            echo "DEFAULT AJAX CASE";
            break;
        }
        
       
        
	}

    public function ForOuFor(){
        echo "404";
    }

}//FIXME to display settings add buzz limit DISPLAY OFF SEND INTERVAL 