<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model{

    
    protected $table = 'notification';
    protected $allowedFields = ['id','title','text','type','action','timestamp','notification_id','user_id','seen'];

    
    public function getAll(){
        $user_id = session()->get("id");
        $db = \Config\Database::connect();

        $sql = "SELECT N.* 
        FROM notification_queue NQ
        LEFT JOIN notification N ON N.id=NQ.notification_id
        WHERE NQ.user_id=? AND NQ.seen=0
        ORDER BY N.timestamp DESC";
        return $db->query($sql,[$user_id])->getResultArray() ?? [];
    }

}
