<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class MakeSetup extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'make';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'make:setup';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'make:setup [arguments]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];


    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        // if $params is defined and if it's numeric value, then create file in folder \app\Migrations\ with name
        // 'setup_'.$params[0].'_year_month_day_hour_minute.php' and in file will be code
        // <?php and on another line qry('');
        $result = false;
        if (isset($params[0]) && is_numeric($params[0])) {
            $result = $this->createFile($params[0]);
        } else {
            $result = $this->createFile();
        }
        if ($result) {
            CLI::write('File created', 'green');
        } else {
            CLI::write('File not created', 'red');
        }
    }

    protected function createFile($number = null)
    {
        $path = APPPATH . 'Migrations';
        $file = 'setup_' . date('Y_m_d_H_i') . '.php';
        if ($number) {
            $file = 'setup_' . $number . '_' . date('Y_m_d_H_i') . '.php';
        }
        $content = '<?php

    $this->qry("");

?>';

        return write_file($path . '/' . $file, $content);
    }

}
