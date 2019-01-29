<?php
// include_once 'libs/Controller.php';
namespace App\Controllers;
use App\Libs\Controller;


class ErrorController extends Controller
{
    public function noPage($message)
    {
        $this->view->errorMessage = $message;
        $this->view->title = '404 Page';
        $this->view->render('error');
    }
}
