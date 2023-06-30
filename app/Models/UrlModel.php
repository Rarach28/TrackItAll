<?php

namespace App\Models;

use CodeIgniter\Model;

class UrlModel extends Model{
    protected $table = 'url';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'page_type_id', 'url', 'default', 'name', 'url_prefix', 'ident'];
    
    
    
    public function get($page_type_id, $ident){
        $db = \Config\Database::connect();
        $sql = "SELECT * 
        FROM url U 
        WHERE page_type_id = ? AND  ident = ? AND default=1";
        
        return $db->query($sql, [$page_type_id,$ident])->getResultArray()[0];
    }

    public function get_id($name, $page_type_id){
        $db = \Config\Database::connect();
        $sql = "SELECT ident 
        FROM url U 
        WHERE page_type_id = ? AND  url = ?";
        
        return $db->query($sql, [$page_type_id,$name])->getResultArray();
    }

    // public function insert($data){
    //     $db = \Config\Database::connect();
    //     $sql = "SELECT * FROM url WHERE page_type_id = ? AND ident = ? AND default = 1";


    //     $sql = "INSERT INTO url (page_type_id, url, default, name, url_prefix, ident) VALUES (?,?,?,?,?,?)";
    //     $db->query($sql, $data);
    // }
    
}