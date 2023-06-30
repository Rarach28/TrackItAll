<?php

namespace App\Controllers\Setup;

use App\Controllers\BaseController;
use App\Models\SetupModel;

class Setup extends BaseController
{
    private $success = 0;
    private $failure = 0;
    private $queryNum = 1;
    private $migrationLog = "";

    public function __construct()
    {
        $this->setupModel = new SetupModel();
        // $this->permissions = new Permission();
    }

    public function index() {
        $this->setupModel->createModuleTable();
        $data['installed_migrations'] = $this->setupModel->getInstalledModules();

        // get name of all files in app/Migrations
        $migrations = scandir(APPPATH . 'Migrations');
        // remove . and ..
        unset($migrations[0]);
        unset($migrations[1]);
        // remove .php extension

        usort($migrations, function($one, $two) {
            $oneNum = explode('_', $one)[1];
            $twoNum = explode('_', $two)[1];

            if($oneNum == $twoNum) {
                return 0;
            }
            return $oneNum > $twoNum ? 1 : -1;
        });

        $data['migrations'] = array_map(function ($migration) use ($data) {
            $migration = substr($migration, 0, -4);
            $parts = explode('_', $migration);
            return [
                'migration' => $parts[1],
                'revision_formatted' => implode('.', [$parts[3], $parts[4]]) . ' ' . $parts[2] . ' ' . implode(':', [$parts[5], $parts[6]]),
                'isInstalled' => (bool) array_filter($data['installed_migrations'], function ($installed) use ($parts) {
                    return $installed['migration'] == $parts[1] && $installed['revision'] == implode('_', array_slice($parts, 2));
                }),
            ];
        }, $migrations);
        
        return view('Setup/setup', $data);
    }

    public function runPermissionsAJAX() {
        return json_encode(['code' => '200', 'message' => 'Permissions regenerated and updated']);
    }

    public function runDatabaseAJAX()
    {
        $this->setupModel->createModuleTable();
        $installed = $this->setupModel->getInstalledModules();

        // get name of all files in app/Migrations
        $migrations = scandir(APPPATH . 'Migrations');
        // remove . and ..
        unset($migrations[0]);
        unset($migrations[1]);
        // remove .php extension
        $migrations = array_map(function ($migration) {
            return substr($migration, 0, -4);
        }, $migrations);

        // sort the migrations so they are executed in the correct order
        usort($migrations, function($one, $two) {
            $oneNum = explode('_', $one)[1];
            $twoNum = explode('_', $two)[1];

            if($oneNum == $twoNum) {
                return 0;
            }
            return $oneNum > $twoNum ? 1 : -1;
        });

        foreach ($installed as $module) {
            // remove already installed modules from $migrations
            $key = array_search('setup_'.$module['migration'] . '_' . $module['revision'], $migrations);
            if ($key !== false) {
                unset($migrations[$key]);
            }
        }

        if(!count($migrations)) {
            return json_encode(['code' => '200', 'log' => 'Migrations are up to date']);
        }

        foreach ($migrations as $migration) {
            $this->migrationLog .= "<i class='fas fa-play'></i> Running migration <strong>". $migration . "</strong><br>";
            $content = file_get_contents(APPPATH . 'Migrations/' . $migration . '.php');
            // include all files in content and run all queries
            include(APPPATH . 'Migrations/' . $migration . '.php');
            if($this->failure > 0) {
                $this->migrationLog .= "<i class='fas fa-circle-xmark text-danger'></i> Migration <strong>". $migration . "</strong> failed<br><hr>";
            } else {
                $this->migrationLog .= "<i class='fas fa-circle-check text-success'></i> Migration <strong>". $migration . "</strong> ran<br><hr>";
                $this->setupModel->updateModule($migration);
            }
            $this->queryNum = 1;
            $this->success = 0;
            $this->failure = 0;

            // insert module into modules table
        }
        $this->migrationLog .= "All migrations ran.";
        return json_encode(['code' => '200', 'message' => 'Migrations are up to date', 'log' => $this->migrationLog]);
    }

    public function qry($txt) {
        $db = \Config\Database::connect();
        // echo "<pre>".$txt."</pre><br />";
        try {
            $db->query($txt);
            $this->migrationLog .= "<i class='fas fa-circle-check text-success'></i> " . $this->queryNum . ". Query successful<br/>";
            $this->success++;
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // Handle the exception
            log_message('error', 'Database query error: '.$e->getMessage());
            $this->migrationLog .= "<i class='fas fa-circle-xmark text-danger'></i> " . $this->queryNum . ". Query failed: " . $e->getMessage() . "<br/>";
            // echo "problem -----------------";
            $this->failure++;
        }
        $this->queryNum++;
        $db->close();
    }
}
