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
		$data = [];

		echo view('tracker', $data);
	}

	//--------------------------------------------------------------------

}