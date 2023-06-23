<?php

namespace App\Validation;

use App\Models\AdminModels\WhitelistedIPsModel;

class WhitelistRules
{
    public function is_valid_ip(string $str, string $fields, array $data)
    {
        // $model = new WhitelistedIPsModel();

        if (preg_match('/^[A-Za-z0-9.:*]+$/', $data['ip_address'])) {
            return true;
        } else {
            return false;
        }
    }
}
