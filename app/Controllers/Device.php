<?php

namespace App\Controllers;

class Device extends BaseController
{
	public function index()
	{
		$data = [];

		 echo view('templates/header', $data);
		echo view('dashboard');
		 echo view('templates/footer');
	}

	//--------------------------------------------------------------------

}