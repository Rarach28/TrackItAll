<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model{

    
    protected $table = 'activity';

    // protected $beforeInsert = ['beforeInsert'];
    // protected $beforeUpdate = ['beforeUpdate'];  
    protected $allowedFields = ['id', 'name', 'priority', 'color', 'user_id'];



    public function getAll(){
        $db = \Config\Database::connect();
        $user_id = session()->get("id");
        $sql = "SELECT * FROM activity WHERE user_id = ? ORDER BY priority ASC";
        
        return $db->query($sql, [$user_id])->getResultArray();
    }

    public function getOne($id){
        $db = \Config\Database::connect();
        $user_id = session()->get("id");
        $sql = "SELECT * FROM activity WHERE user_id = ? AND id = ?";
        
        return $db->query($sql, [$user_id, $id])->getResult()[0];
    }




}
