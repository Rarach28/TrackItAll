<?php

namespace App\Controllers;

use App\Models\TrackerModel;

class Tracker extends BaseController
{
    public function __construct()
    {
        $this->trackerModel = new TrackerModel();
    }
	public function index()
	{
		$data = [
			"title" => "Tracker",
			"toast" => toast("v Konzoli zavolej toast()", "success"),
		];

		echo view('tracker', $data);
	}

	//--------------------------------------------------------------------

}