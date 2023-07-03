<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganisationModel extends Model{

    
    protected $table = 'organisation';
    protected $allowedFields = ['id','name','description','timestamp','organisation_id','user_id','status','token','last_change'];

    
    public function getAll(){
        /*
        dodelat url pro odkaz ve view
        */
        $user_id = session()->get("id");
        $db = \Config\Database::connect();

        $sql = "SELECT O.*, UR.url url, USER.ids user_ids
        FROM organisation O 
        LEFT JOIN organisation_user OU ON O.id=OU.organisation_id
        LEFT JOIN users U ON U.id = OU.user_id
        LEFT JOIN url UR ON UR.ident=O.id AND UR.page_type_id=4 AND UR.default=1
        LEFT JOIN (
        	SELECT OU2.organisation_id,group_concat(DISTINCT OU2.user_id) ids 
        	FROM organisation_user OU2) 
        	as USER ON USER.organisation_id=O.id
        WHERE OU.status != 3 AND OU.user_id=?
        ORDER BY O.timestamp DESC";
        $res = $db->query($sql,[$user_id])->getResultArray() ?? [];

        $ret = [];
        foreach($res as $r){
            $ret[] = [
                "name"          => $r["name"],
                "description"   => $r["description"],
                "timestamp"     => $r["timestamp"],
                "url"          => $r["url"],
                "user_ids"      => explode(",",$r["user_ids"])
            ];
        }
        return $ret;
    }

    public function getById($id){
        $user_id = session()->get("id");
        $db = \Config\Database::connect();

        $sql = "SELECT O.*, UR.url url, USER.ids user_ids
        FROM organisation O 
        LEFT JOIN organisation_user OU ON O.id=OU.organisation_id
        LEFT JOIN users U ON U.id = OU.user_id
        LEFT JOIN url UR ON UR.ident=O.id AND UR.page_type_id=4 AND UR.default=1
        LEFT JOIN (
        	SELECT OU2.organisation_id,group_concat(DISTINCT OU2.user_id) ids 
        	FROM organisation_user OU2) 
        	as USER ON USER.organisation_id=O.id
        WHERE OU.status != 3 AND OU.user_id=? AND O.id=?
        ORDER BY O.timestamp DESC";
        return $db->query($sql,[$user_id,$id])->getResultArray()[0] ?? [];
    }

    public function createNew($data){
        $user_id = session()->get("id");
        $db = \Config\Database::connect();

        $sql = "INSERT INTO organisation (name,description,timestamp) VALUES(?,?,?);";
        $db->query($sql,[$data["name"],$data["description"],time()]);
        $organisation_id = $db->insertID();


        $sql = "INSERT INTO organisation_user (organisation_id,user_id,status,token,last_change) VALUES(?,?,?,?,?);";
        $db->query($sql,[$organisation_id,$user_id,6,'',time()]);

        return $organisation_id;
    }

    public function inviteUsers($o_id,$user_ids){
        $user_id = session()->get("id");
        $db = \Config\Database::connect();
        $data = [];
        foreach($user_ids as $id){
            $data[] = [
                "organisation_id"   => $o_id,
                "user_id"           => $id,
                "status"            => 1,
                "token"             => generateRandomString(10),
                "last_change"       => time()
            ];
        }

        $db->table("organisation_user")->insertBatch($data);

        // $sql = "INSERT INTO organisation_user (organisation_id,user_id,status,token,last_change) VALUES(?,?,?,?,?);";
        // $db->query($sql,[$organisation_id,$user_id,6,'',time()]);
    }

}
