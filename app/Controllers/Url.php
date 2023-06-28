<?php

namespace App\Controllers;

use App\Models\UrlModel;

class Url extends BaseController
{
	public function __construct()
    {
        $this->urlModel = new UrlModel();
        $this->db = \Config\Database::connect();

    }

    public function get_id($name, $page_type_id){
        $res = $this->urlModel->get_id($name, $page_type_id);

        $id = $res[0]['ident'] ?? 0;
        return $id;
    }

    public function get_id_and_delete($name, $page_type_id){
        $res = $this->urlModel->get_id($name, $page_type_id);

        $id = $res[0]['ident'] ?? 0;
        $this->urlModel->where("ident",$id)->where("page_type_id",$page_type_id)->delete();
        return $id;
    }

    public function generate_url($device_data, $page_type_id = 0)
    {
        if ($page_type_id == 1) {
            $sql = "SELECT `name` as name
            FROM activity
            WHERE id = ?";
            $query = $this->db->query($sql, [$device_data])->getRow();
            $new_url = mb_url_title($query->name, '-', TRUE);
        } elseif ($page_type_id == 2) {
            $sql = "SELECT `name` as name
            FROM notification
            WHERE id = ?";
            $query = $this->db->query($sql, [$device_data])->getRow();
            $new_url = mb_url_title($query->name, '-', TRUE);
        }

        $skip = 0;

        // get all URL's fitting pattern
        $sql = "SELECT `ident`, `url`, `default`, `page_type_id` FROM `url` WHERE page_type_id = ? AND (`url` = ?  OR `url` REGEXP '^(" . esc($new_url) . ")(-{2}[0-9]+)$')";
        $res = $this->db->query($sql, [$page_type_id, $new_url]);
        $url = $res->getResultArray();

        // if no URL address exist
        if (count($url) == 0) {
            $sql = "UPDATE `url` SET `default` = '0' WHERE `page_type_id` = ? AND `ident` = ?;";
            $this->db->query($sql, [$page_type_id, $device_data]);
            $sql = "INSERT INTO url (`page_type_id`, `ident`, `default`, `url`) VALUES (?, ?, ?, ?)";
            $this->db->query($sql, [$page_type_id, $device_data, 1, $new_url]);
        } else {
            // generate new address
            $max_suffix = 0;
            foreach ($url as $key => $val) {
                // if alternative address exist and it's default - break
                if ($val['ident'] == $device_data && $val['page_type_id'] == $page_type_id && $val['default'] == 1) {
                    $skip = 1;
                    break;
                } else {
                    preg_match('/-{2}(\d+)$/', $val['url'], $indexes);
                    $actual = (count($indexes) > 0 ? $indexes[1] : 0);
                    if ($actual > $max_suffix) {
                        $max_suffix = $actual;
                    }
                }
            }
            if ($skip == 0) {
                $sql = "UPDATE `url` SET `default` = '0' WHERE `page_type_id` = ? AND `ident` = ?;";
                $this->db->query($sql, [$page_type_id, $device_data]);
                $sql = "INSERT INTO url (`page_type_id`, `ident`, `default`, `url`) VALUES (?, ?, ?, ?)";
                $max_suffix++;
                $new_generated_url = $new_url . "--" . $max_suffix;
                $this->db->query($sql, [$page_type_id, $device_data, 1, $new_generated_url]);
            }
        }
    }


}
