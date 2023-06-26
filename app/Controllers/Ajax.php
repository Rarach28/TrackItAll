<?php

namespace App\Controllers;

class Ajax extends BaseController
{
    public function __construct(){
        /* CONTROLLERS */
       
        /* MODELS */
        
    }
	public function index()
	{
        $params = isset($_POST["params"])?$_POST["params"]:null;
        switch($_POST["action"]){
            case "testToast":
                return toast("Test Toasty", "success").
                toast("Primary", "primary").
                toast("Secondary", "secondary").
                toast("Info", "info").
                toast("Warning Toasty", "warning").
                toast("Danger Toasty", "danger");
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