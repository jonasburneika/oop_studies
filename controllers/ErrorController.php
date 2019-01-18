<?php
include_once 'libs/Controller.php';
class ErrorController extends Controller
{
    public function noPage($message)
    {
        $this->view->errorMessage = $message;
        $this->view->title = '404 Page';
        $this->view->render('error');
    }
}
