<?php
namespace App\Controllers;
use App\Libs\Controller;
use App\Models\Users;
use App\Helpers\FormHelper;

class UserController extends Controller
{

    public function login()
    {
        $form = new FormHelper('POST','user/checkLogin', 'form-signin');
        /** Padaryti ne is cia */
        $this->view->title = 'Musu super title';
        /** Padaryti ne is cia */
        $form->openDiv(['class'=>'form-label-group']);
        $form->label('inputEmail','Email address');
        $form->input(['type'=>'email', 'name'=>'email', 'id'=>'inputEmail', 'class'=>'form-control', 'placeholder'=>'Email address']);
        $form->closeDiv();

        $form->openDiv(['class'=>'form-label-group']);
        $form->label('inputPassword','Password');
        $form->input(['type'=>'password', 'name'=>'password', 'id'=>'inputPassword', 'class'=>'form-control', 'placeholder'=>'Password']);
        $form->closeDiv();

        $form->openDiv(['class'=>'checkbox mb-3']);
        $form->addHTML('<label>');
        $form->checkbox(['type'=>'checkbox', 'name'=>'remember', 'value'=>'remember-me'],'Remember me');
        $form->addHTML('</label>');     
        $form->closeDiv();

        $form->button(['class'=>'btn btn-lg btn-primary btn-block', 'name'=>'submit', 'type'=>'submit'],'Sign in');
        
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

    public function checkLogin()
    {
        var_dump($_POST);
    }
}