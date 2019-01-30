<?php
namespace App\Libs;
use App\Libs\View as View;
// include_once 'View.php';


class Controller
{
    protected $view;
    
    public function __construct()
    {
        $this->view = new View;
    }

}