<?php
namespace App\Controllers;
use App\Libs\Controller;
use App\Libs\Validation;
use App\Models\Users;
use App\Models\Posts;
use App\Helpers\FormHelper;
use App\Helpers\AlertHelper;

class UserController extends Controller
{
    
    public function login()
    {
        $user = new Users;
        $form = new FormHelper('POST','user/checkLogin', 'form-signin');
        /** Padaryti ne is cia */
        $this->view->title = 'Musu super title';
        /** Padaryti ne is cia */

        $this->view->form = '';
        $alert = new AlertHelper;
        if (isset($_GET['error'])){
            $this->view->form .= $alert->showErrorAlert($_GET['error']);
        }
        if (isset($_GET['success'])){
            $this->view->form .= $alert->showSuccessAlert($_GET['success']);
        }

        $form->openDiv(['class'=>'form-label-group']);
        $form->label('username','User Name');
        $form->input(['type'=>'text', 'name'=>'username', 'id'=>'username', 'class'=>'form-control', 'placeholder'=>'Your Name']);
        $form->closeDiv();

        $form->openDiv(['class'=>'form-label-group']);
        $form->label('inputPassword','Password');
        $form->input(['type'=>'password', 'name'=>'password', 'id'=>'inputPassword', 'class'=>'form-control', 'placeholder'=>'Password']);
        $form->closeDiv();

        $form->openDiv(['class'=>'checkbox mb-3 pt-2']);
        $form->addHTML('<label>');
        $form->checkbox(['type'=>'checkbox', 'name'=>'remember', 'class'=>'pt-2','value'=>'remember-me'],'Remember me');
        $form->addHTML('</label>');     
        $form->closeDiv();

        $form->button(['class'=>'btn btn-lg btn-primary btn-block', 'name'=>'submit', 'type'=>'submit'],'Login');
        
        $this->view->form .= $form->getForm();
        $this->view->render(['getContent'=>'login']);
    }

    public function register()
    {
        
        $form = new FormHelper('POST','user/checkRegister', 'form-signin');
        $this->view->form = '';
        $alert = new AlertHelper;
        if (isset($_GET['error'])){
            $this->view->form .= $alert->showErrorAlert($_GET['error']);
        }
        if (isset($_GET['success'])){
            $this->view->form .= $alert->showSuccessAlert($_GET['success']);
        }

        
        /** Padaryti ne is cia */
        $this->view->title = 'Musu super title';
        /** Padaryti ne is cia */

        $form->openDiv(['class'=>'form-label-group']);
        $form->label('username','User Name');
        $form->input(['type'=>'text', 'name'=>'username', 'id'=>'username', 'class'=>'form-control', 'placeholder'=>'Your Name']);
        $form->closeDiv();

        $form->openDiv(['class'=>'form-label-group']);
        $form->label('inputEmail','Email address');
        $form->input(['type'=>'email', 'name'=>'email', 'id'=>'inputEmail', 'class'=>'form-control', 'placeholder'=>'Email address']);
        $form->closeDiv();

        $form->openDiv(['class'=>'form-label-group']);
        $form->label('inputPassword1','Password');
        $form->input(['type'=>'password', 'name'=>'password1', 'id'=>'inputPassword1', 'class'=>'form-control', 'placeholder'=>'Password']);
        $form->closeDiv();

        $form->openDiv(['class'=>'form-label-group']);
        $form->label('inputPassword2','Repeat Password');
        $form->input(['type'=>'password', 'name'=>'password2', 'id'=>'inputPassword2', 'class'=>'form-control', 'placeholder'=>'Repeat Password']);
        $form->closeDiv();

        $form->openDiv(['class'=>'checkbox mb-3 pt-2']);
        $form->addHTML('<label>');
        $form->checkbox(['type'=>'checkbox', 'name'=>'remember','value'=>'remember-me'],'Remember me');
        $form->addHTML('</label>');     
        $form->closeDiv();

        $form->button(['class'=>'btn btn-lg btn-primary btn-block', 'name'=>'submit', 'type'=>'submit'],'Sign up');
        
        $this->view->form .= $form->getForm();
        $this->view->render(['getContent'=>'register']);
    }

    public function checkLogin()
    {
        if (isset($_POST['submit'])){
            $user = new Users;
            $userName = $_POST['username'];
            $userPassword1 = $_POST['password'];
            $hashPassword = $user->hashPassword($userPassword1);
            $result = $user->getUserIdByUserNameAndPassword($userName,$hashPassword);
            if (is_integer($result)){
                $userData = $user->getUserById($result);
                $_SESSION['loged'] = true;
                $_SESSION['username'] = $userData['username'];
                $_SESSION['userID'] = $userData['id'];
                $this->view->redirect('index.php/user/profile?success=Welcome%20'.$_SESSION['username']);
            }
        }
    }

    public function checkRegister()
    {
        if (isset($_POST['submit'])){
            $user = new Users;
            $validation = new Validation();
            $userEmail =  $validation->validateEmail($_POST['email']);
            $userName = $_POST['username'];
            $userPassword1 = $_POST['password1'];
            $userPassword2 = $_POST['password2'];
            $hashPassword = $user->hashPassword($userPassword1);
            if ($userPassword1 == $userPassword2){
                $checkUserName = $user->checkUserName($userName);
                if ($checkUserName == false){
                    $result = $user->addNewUser(['username'=>$userName,'email'=>$userEmail,'password'=>$hashPassword]);
                    if ($result){
                        $_SESSION['loged'] = true;
                        $_SESSION['username'] = $result['username'];
                        $_SESSION['userID'] = $result['id'];
                        $this->view->redirect('index.php/user/login?success=Welcome%20'.$_SESSION['username']);
                    }
                } else {
                    $this->view->redirect('index.php/user/register?error=User%20'.$userName.'%20exist');
                }
            } else {
                $this->view->redirect('index.php/user/register?error=password%20did%20match');
            }

        }
    }

    public function profile($id=null){
        $user = new Users;
        $post = new Posts;
        if ($_SESSION['loged'] && $id == null){
            $id = $_SESSION['userID'];
        }
        if (isset($_GET['success'])){
            $alert = new AlertHelper;
            $this->view->alert = $alert->showSuccessAlert($_GET['success']);
        }
        if ($id !== null && is_numeric($id)){
            $id = (int) $id;
            $userData = $user->getUserById($id); // returns array of userdata OR false
            if (is_array($userData)){
                $this->view->user = $userData;
                $this->view->title = $userData['username'] . ' Profile';
                $this->view->tab = 'profile';

                $this->view->profileNavigation = $this->view->getBlock('user/navigation');
                $this->view->profileContent = $this->view->getBlock('user/profile');
                $this->view->render(['getContent'=>'user']);
            } else {
                $this->view->redirect('index.php/error/noPage/User-does\'t-exist');
            }
        } else {
            $this->view->redirect('index.php');
        }
       
    }

    public function settings(){
        $user = new Users;
        $post = new Posts;
        if ($_SESSION['loged']){
            $id = $_SESSION['userID'];
        }
        if ($id !== null && is_numeric($id)){
            $id = (int) $id;
            $userData = $user->getUserById($id); // returns array of userdata OR false
            if (is_array($userData)){
                $this->view->user = $userData;
                $this->view->title = $userData['username'] . ' Settings';
                $this->view->tab = 'settings';
                $this->view->profileNavigation = $this->view->getBlock('user/navigation');
                $this->view->profileContent = $this->view->getBlock('user/settings');
                $this->view->render(['getContent'=>'user']);
            } else {
                $this->view->redirect('index.php/error/noPage/User-does\'t-exist');
            }
        } else {
            $this->view->redirect('index.php');
        }
    }

    public function posts($id=null){
        $user = new Users;
        $post = new Posts;
        $status = true;
        if ($_SESSION['loged']){
            $id = $_SESSION['userID'];
            $status = 'IS NOT NULL';
        }
        if ($id !== null && is_numeric($id)){
            $id = (int) $id;
            $userData = $user->getUserById($id); // returns array of userdata OR false
            if (is_array($userData)){
                $this->view->user = $userData;
                $this->view->title = $userData['username'] . ' Posts';
                $this->view->tab = 'posts';
                if (isset($_SESSION['userID']) && $id == $_SESSION['userID']){
                    $this->view->posts = $post->getPostsByAuthorId($id);
                } else {
                    $this->view->posts = $post->getActivePostsByAuthorId($id);
                }
                
                $this->view->profileNavigation = $this->view->getBlock('user/navigation');
                $this->view->profileContent = $this->view->getBlock('user/posts');
                $this->view->render(['getContent'=>'user']);
            } else {
                $this->view->redirect('index.php/error/noPage/User-does\'t-exist');
            }
        } else {
            $this->view->redirect('index.php');
        }
    }

    public function logout(){
        session_destroy();
        $this->view->redirect('index.php/user/login?success=Logged%20out%20successfully');
    }
}