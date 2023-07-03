<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
// use App\Models\UserModel;

class UserSelect extends Cell
{
    // construct
    public function __construct()
    {
        // $this->UserModel = new UserModel();
    }

    public function userMAilInput(){

        $ret = form_dropdown('userMailInput[]', [], [], [
            'class' => 'form-control',
            'id' => 'userInput',
            'multiple' => 'multiple',
        ])."
        <script>
            $('#userInput').select2({
                tags: true,
            });
        </script>
        ";

        return $ret;

    }

    

}
