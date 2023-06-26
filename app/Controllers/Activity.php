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
            "title" => "Add Activity",
            "name" => "",
            "priority" => 1,
            "color" => '#' . bin2hex(random_bytes(3)),
            "action" =>"insertActivity"
        ];

        return view("Activity/addActivity", $data);
    }

    public function edit($id){
        $activity =$this->activityModel->getOne($id);
        if(!empty($activity)){
            $data = [
                "title" => "Edit Activity",
                "name" => $activity->name,
                "priority" => $activity->priority,
                "color" => $activity->color,
                "action" => "Activity/update/$id"
            ];
    
            return view("Activity/addActivity", $data);
        }
        else
            return view("Activity/show", $data);
        
    }

    public function update($id){

        $data = [
            "name" => $this->request->getPost("name") ?? "unset",
            "priority" => $this->request->getPost("priority") ?? 0,
            "color" => $this->request->getPost("color") ?? '#' . bin2hex(random_bytes(3))
        ];

        if($this->activityModel->update($id, $data))
            return redirect()->to("Activity/show");

    }


    public function insert(){

        $data = [
            "name" => $this->request->getPost("name") ?? "unset",
            "priority" => $this->request->getPost("priority") ?? 0,
            "color" => $this->request->getPost("color") ?? '#' . bin2hex(random_bytes(3)),
            "user_id" => session()->get("id"),
        ];

        if($this->activityModel->insert($data))
            return redirect()->to("Activity/show");

        
    }

    public function delete($id){
        if(!empty($this->activityModel->getOne($id)))
            $this->activityModel->delete($id);

        return redirect()->to("Activity/show");
    }
	//--------------------------------------------------------------------

}
