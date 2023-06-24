<?php

 namespace App\Controllers;

 use App\Models\ActivityModel;

class Activity extends BaseController
{

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
    }

	public function index()
	{
		// echo view('templates/header');
		echo view('test');
		// echo view('templates/footer');
		
	}

    public function show(){
      
        $activity = $this->activityModel->getAll();

        $data = [
            "title" => "Activity",
            "activity" => $activity
        ];

        return view("Activity/showActivity", $data);
        
    }

    public function add(){
        $data = [
            "title" => "Add Activity"
        ];

        return view("Activity/addActivity", $data);
    }


    public function insert(){

        $data = [
            "name" => $this->request->getPost("name") ?? "unset",
            "priority" => $this->request->getPost("priority") ?? 0,
            "color" => $this->request->getPost("color") ?? "#000000",
            "user_id" => session()->get("id"),
        ];

        if($this->activityModel->insert($data))
            return redirect()->to("show");

        return redirect()->to("logout");
        
    }

    public function delete($id){
        if($this->activityModel->checkOwnership($id))
            $this->activityModel->delete($id);

        return redirect()->to("show");
    }
	//--------------------------------------------------------------------

}
