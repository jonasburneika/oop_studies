<?php
namespace App\Controllers;
use App\Libs\Controller;
use App\Models\Users;
use App\Helpers\FormHelper;

class UserController extends Controller
{

    public function login()
    {
        $form = new FormHelper('POST','User/checkLogin');
        /** Padaryti ne is cia */
        $this->view->title = 'Musu super title';
        /** Padaryti ne is cia */
        $formFields = ['type'=>'text', 'name'=>'userName', 'id'=>'userName','label'=>'Vartotojo vardas'];
        $form->input($formFields);
        $formFields = ['type'=>'text', 'name'=>'pass1', 'id'=>'pass1','label'=>'Slaptažodis'];
        $form->input($formFields);
        
        $this->view->form = $form->getForm();
        $this->view->render(['getContent'=>'login']);
    }

    public function register()
    {
        /** Padaryti ne is cia */
        $this->view->title = 'Musu super title';
        /** Padaryti ne is cia */

        $this->view->render(['getContent'=>'register']);
    }

    public function checkLogin($data)
    {
        var_dump($_POST);
    }
}