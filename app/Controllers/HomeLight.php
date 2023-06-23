<?php

/**
 * --------------------------------------------------------------------
 * CODEIGNITER 4 - SimpleAuth
 * --------------------------------------------------------------------
 *
 * This content is released under the MIT License (MIT)
 *
 * @package    SimpleAuth
 * @author     GeekLabs - Lee Skelding 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://github.com/GeekLabsUK/SimpleAuth
 * @since      Version 1.0
 * 
 */

 namespace App\Controllers;

 use App\Models\HomeLightModel;

class HomeLight extends BaseController
{
	public function __construct(){
        $this->HomeLightModel = new HomeLightModel();
    } 

	public function index($name = "")
	{
		// $auth_redirect = authenticate([1, 2, 3]);
		// if ($auth_redirect) return redirect()->to("/logout");
		$data = [];

        $data["data"] = $this->HomeLightModel->query("SELECT * FROM homeLight WHERE id=1")->getResultArray()[0];

		 echo view('templates/header',$data);
		echo view('projects/home/homeLight/set');
		 echo view('templates/footer');
		
	}

    public function getJSON(){
        return json_encode([
            "L" => [
                "R" => 255,
                "G" => 255,
                "B" => 255,
            ],
            "R" => [
                "R" => 255,
                "G" => 0,
                "B" => 0,
            ],
            "A" => 40,        
        ]);
    }

	//--------------------------------------------------------------------

}


/* default DATA */
/*
	title = "SMART"
*/