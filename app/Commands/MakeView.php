<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class MakeView extends BaseCommand
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
    protected $name = 'make:viewLayout';

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
    protected $usage = 'make:viewLayout [name]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
    * Actually execute a command.
    *
    * @param array $params
    */
   public function run(array $params)
   {
        $result = false;
        if (isset($params[0])) {
            $result = $this->createFile($params[0]);
            if ($result) {
               CLI::write('File created', 'green');
            } else {
               CLI::write('File not created', 'red');
            }
        } else {
            CLI::write('File not created, specify name', 'red');
        }
   }

   protected function createFile($name)
   {
       $path = APPPATH . 'Views';
       $file = $name . '.php';
       $content = '<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">' . $name . ' view</h1>

<?= $this->endSection() ?>';

       return write_file($path . '/' . $file, $content);
   }
}
