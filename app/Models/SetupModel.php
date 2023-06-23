<?php

namespace App\Models;

use CodeIgniter\Model;

class SetupModel extends Model
{
    // make query create a table Modules with columns module int(10) and revision int(10)
    public function createModuleTable()
    {
        $db = \Config\Database::connect();
        $sql = "CREATE TABLE IF NOT EXISTS `migrations` (
            `migration` int(10) NOT NULL,
            `revision` varchar(16) NOT NULL DEFAULT '',
            UNIQUE KEY unique_migrations (migration, revision)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        $db->query($sql);
        $db->close();
    }

    public function getInstalledModules()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `migrations`";
        $query = $db->query($sql);
        $result = $query->getResultArray();
        $db->close();
        return $result;
    }

    public function updateModule($migration)
    {
        $migration = substr($migration, 6);
        $migration_temp = explode('_', $migration, 2);

        $db = \Config\Database::connect();
        $sql = "INSERT INTO `migrations` (`migration`, `revision`) VALUES ('" . $migration_temp[0] . "', '" . $migration_temp[1] . "')";
        $db->query($sql);
        $db->close();
    }

    public function createAvailablePermissions($permissions) {
        $db = \Config\Database::connect();
        foreach($permissions as $id => $permission) {
            $sql = "REPLACE INTO `permission` (`id`, `name`) VALUES (?,?)";
            $db->query($sql, [$id+1, $permission]);
        }
    }

    public function createModulesFeatures($permissions) {
        $db = \Config\Database::connect();
        // get all existing modules, dont use *
        $sql = "SELECT `id`, `name` FROM `module`";
        
        $existingModules = $db->query($sql)->getResultArray();
        $existingModuleNames = array_map(function($module) {
            return $module['name'];
        }, $existingModules);

        $sql = "SELECT `id`, `name` FROM `module_feature`";
        $existingFeatures = $db->query($sql)->getResultArray();
        $existingFeatureNames = array_map(function($feature) {
            return $feature['name'];
        }, $existingFeatures);

        foreach($permissions as $module => $moduleInfo) {
            if(in_array($module, $existingModuleNames)) {
                $sql = "UPDATE `module` SET `display_name` = ?, `description` = ? WHERE `name` = ?";
                $db->query($sql, [$moduleInfo['displayName'], $moduleInfo['description'], $module]);
                foreach($existingModules as $existingModule) {
                    if($existingModule['name'] == $module) {
                        $moduleID = $existingModule['id'];
                        break;
                    }
                }
            } else {
                $sql = "INSERT INTO `module` (`name`, `display_name`, `description`) VALUES (?,?,?)";
                $db->query($sql, [$module, $moduleInfo['displayName'], $moduleInfo['description']]);
                $moduleID = $db->insertID();
            }

            // for now, implicitly allow all permissions for the module
            $sql = "REPLACE INTO `module_permission` (`module_id`, `permission_id`) SELECT ?, `id` FROM `permission`";
            $db->query($sql, [$moduleID]);

            if(isset($moduleInfo['features']) && !empty($moduleInfo['features'])) {
                foreach($moduleInfo['features'] as $feature => $featureInfo) {
                    if(in_array($feature, $existingFeatureNames)) {
                        $sql = "UPDATE `module_feature` SET `display_name` = ?, `description` = ? WHERE `name` = ?";
                        $db->query($sql, [$featureInfo['displayName'], $featureInfo['description'], $feature]);
                    } else {
                        $sql = "INSERT INTO `module_feature` (`name`, `display_name`, `description`, `module_id`) VALUES (?,?,?,?)";
                        $db->query($sql, [$feature, $featureInfo['displayName'], $featureInfo['description'], $moduleID]);
                    }
                }
            }
        }
    }

    
}
