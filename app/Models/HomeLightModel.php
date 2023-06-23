<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeLightModel extends Model{

    
    protected $table = 'homeLight';
    protected $allowedFields = ['id','A','LR','LG','LB','RR','RG','RB','timestamp'];
    // protected $beforeInsert = ['beforeInsert'];
    // protected $beforeUpdate = ['beforeUpdate'];  
   


}
