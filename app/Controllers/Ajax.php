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
                return toast("Test Toasty","Test toast Text", "success").
                toast("Primary","Test toast Text", "primary").
                toast("Secondary","Test toast Text", "secondary").
                toast("Info","Test toast Text", "info").
                toast("Warning Toasty","Test toast Text", "warning").
                toast("Danger Toasty","Test toast Text", "danger");
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