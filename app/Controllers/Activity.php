<?php

 namespace App\Controllers;

 use App\Models\ActivityModel;
 use App\Controllers\Url;

class Activity extends BaseController
{

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
        $this->url = new Url();
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

    public function edit($name){
        $id = $this->url->get_id($name, 1);
        if($id==0)
            return redirect()->to("logout");
        $activity =$this->activityModel->getOne($id);
        if(!empty($activity)){
            $data = [
                "title" => "Edit Activity",
                "name" => $activity->name,
                "priority" => $activity->priority,
                "color" => $activity->color,
                "action" => "Activity/update/$id",
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

        if($this->activityModel->update($id, $data)){

            $this->url->generate_url($id, 1);
            return redirect()->to("Activity/show");
        }

    }


    public function insert(){

        $data = [
            "name" => $this->request->getPost("name") ?? "unset",
            "priority" => $this->request->getPost("priority") ?? 0,
            "color" => $this->request->getPost("color") ?? '#' . bin2hex(random_bytes(3)),
            "user_id" => session()->get("id"),
        ];

        if($this->activityModel->insert($data)){
			$newId = isset($data["id"])?$data["id"]:($this->activityModel->insertID());
			$this->url->generate_url($newId, 1);
			
            return redirect()->to("Activity/show");
        }

        
    }

    public function delete($url){
        $id = $this->url->get_id_and_delete($url, 1);
        if(!empty($this->activityModel->getOne($id)))
            $this->activityModel->delete($id);
            

        return redirect()->to("Activity/show");
    }
	//--------------------------------------------------------------------

}
