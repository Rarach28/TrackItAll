<?php

namespace App\Models;

use CodeIgniter\Model;

class TrackerModel extends Model{

    
    protected $table = 'tracker';
    protected $allowedFields = ['id','activity_id','user_id','from','to'];
    // protected $beforeInsert = ['beforeInsert'];
    // protected $beforeUpdate = ['beforeUpdate'];  
   


}
