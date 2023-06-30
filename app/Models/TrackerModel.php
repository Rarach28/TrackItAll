<?php

namespace App\Models;

use CodeIgniter\Model;

class TrackerModel extends Model{

    
    protected $table = 'tracker';
    protected $allowedFields = ['id','activity_id','from','to','active'];

    public function trackerModel($data){
        $this->db = \Config\Database::connect();
        return $this->db->table('tracker')->insert($data);

    }
   
    public function getAll(){
        $user_id = session()->get("id");
        $db = \Config\Database::connect();
        $sql = "SELECT T.*, A.name as activity, A.color as activity_color, U.url as url
        FROM tracker T
        LEFT JOIN activity A on T.activity_id = A.id
        LEFT JOIN url U ON U.ident=T.id AND U.page_type_id=3 AND U.default=1
        WHERE A.user_id = ? AND T.active = 0";
        return $db->query($sql, [$user_id])->getResultArray() ?? [];
    }

    public function getActive(){
        $user_id = session()->get("id");
        $db = \Config\Database::connect();
        $sql = "SELECT T.*, A.name as activity, A.color as activity_color
        FROM tracker T
        LEFT JOIN activity A on T.activity_id = A.id
        WHERE A.user_id = ? AND T.active = 1";
        return $db->query($sql, [$user_id])->getResultArray()[0] ?? [];
    }

    public function startTracker($dbData){
        $db = \Config\Database::connect();
        $db->table('tracker')->insert($dbData);
        return $db->insertID();
    }

    public function stopTracker($dbData){
        $db = \Config\Database::connect();
        $builder = $db->table('tracker');
        $builder->set($dbData);
        $builder->where('id', $dbData["id"]);
        $builder->update();

        $user_id = session()->get("id");
        $sql = "SELECT T.*, A.name as activity, A.color as activity_color, U.url as url
        FROM tracker T
        LEFT JOIN activity A on T.activity_id = A.id
        LEFT JOIN url U ON U.ident=T.id AND U.page_type_id=3 AND U.default=1
        WHERE A.user_id = ? AND T.active = 0 AND T.id=?";
        return $db->query($sql, [$user_id,$dbData["id"]])->getResultArray()[0] ?? [];

    }

    public function getTimeModalData($url, $page_type_id){
        $sql = "SELECT T.from, T.to
        FROM URL U
        LEFT JOIN tracker T ON T.id=U.ident
        WHERE U.page_type_id=? AND U.url=?";
        return $this->query($sql,[$page_type_id,$url])->getResultArray()[0] ?? [];
    }

    public function updateTimeTrackData($id,$from,$to){
        $db = \Config\Database::connect();
        $builder = $db->table('tracker');
        $builder->set([
            "from"  =>$from,
            "to"    =>$to
        ]);
        $builder->where('id', $id);
        $builder->update();
    }

    public function deleteRecord($url){
        $db = \Config\Database::connect();
        $sql = "SELECT U.ident FROM url U WHERE U.url=? AND U.page_type_id=3";
        $tmp_ids = $this->query($sql,[$url])->getResultArray();
        $ids = [];
        foreach($tmp_ids as $d){
            $ids[] = $d["ident"];
        }

        $sql = "DELETE U
        FROM url U
        JOIN url U2 ON U.ident = U2.ident
        WHERE U.page_type_id = 3
        AND U2.url = ?
        AND U2.page_type_id = 3";
        $this->query($sql,[$url]);


        $sql = "DELETE T FROM tracker T WHERE T.id IN ?";
        $this->query($sql,[$ids]);

    }

}
