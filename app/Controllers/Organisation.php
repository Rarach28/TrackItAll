<?php

 namespace App\Controllers;

 use App\Models\OrganisationModel;
 use App\Models\AuthModel;
 use App\Models\TrackerModel;

 use App\Controllers\Url;
 

class Organisation extends BaseController
{
	public function __construct()
    {

		$this->organisationModel = new OrganisationModel();
		$this->authModel = new AuthModel();
		$this->trackerModel = new TrackerModel();
		$this->url = new Url();
    }

	public function index(){

		$data = [
			"title" => "My Organisations",
			"organisations" => $this->organisationModel->getAll(),
		];

		echo view('Organisation/allOrganisation', $data);

	}

	public function add(){
		$data = [
			"title" => "Add Organisation",
			"action"	=> "createOrganisation",
			"notifPreview" => toast("Name","Text","success","true")
		];
		echo view('Organisation/editOrganisation', $data);

	}

	public function createNew(){
		$data = [
			"name" => $_POST["name"] ?? "unset",
			"description" => $_POST["description"] ?? "",
		];
		$o_id = $this->organisationModel->createNew($data);
		$this->url->generate_url($o_id, 4);


		//send requests to all valid users
			$emails = $_POST["userMailInput"] ?? [];
			if(count($emails)>0){
				$users = $this->authModel->getByEmails($emails);
				$user_ids = array_column($users,"id");
				if(count($user_ids)>0)
					$this->organisationModel->inviteUsers($o_id,$user_ids);
			}



		$data = [
			"title" => "Organisation",
			"action"	=> "",
		];



		echo view('Organisation/editOrganisation', $data);
	}

	public function detail($url){
		$id = $this->url->get_id($url,4);
		$organisation = $this->organisationModel->getById($id);
		$userTracks = $this->trackerModel->getOrganisationTracks($id,$organisation["user_ids"]);

		$data = [
			"title"		=> $organisation["name"],
		];

		echo view('Organisation/detailOrganisation', $data);

	}

	//--------------------------------------------------------------------

}
