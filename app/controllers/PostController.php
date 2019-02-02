<?php

namespace App\Controllers;
use App\Libs\Controller;
use App\Helpers\SlugHelper;
use App\Models\Posts;
use App\Models\Users;


class PostController extends Controller
{
    public function index()
    {
        $posts = new Posts;
        $user = new Users;
        $postData = $posts->getAllPosts();
        $postData = mysqli_fetch_all($postData, MYSQLI_ASSOC);
        foreach ($postData as $key => $post) {
            $postData[$key]['author'] = $user->getUserById($post['author_id'])['username'];
        }
        $this->view->posts = $postData;
        
        $this->view->title = 'Musu super title';
        $this->view->headLine = 'Mūsų headline';
        $this->view->render(['getContent'=>'post']);

    }

    public function show($id = null)
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = (int) $_GET['id'];
            $this->showPostByID($id);
        } else if (is_numeric($id)){
            $id = (int) $id;
            $this->showPostByID($id);
        } else {
            $this->showPostBySlug($id); 
        }
    }

    private function showPostByID($id){
        $post = new Posts;
        $user = new Users;
        $postData = $post->getPostById($id);
        if (is_array($postData)){
            if ($postData['status'] == true){
                $postData['author'] = $user->getUserById($postData['author_id'])['username'];
                $this->view->post = $postData;
                $this->view->title = $postData['title'];
                $this->view->render(['getContent'=>'post']);
            } else {
                if ($_SESSION['loged'] && $_SESSION['userID'] == $postData['author_id']){
                    $postData['author'] = $user->getUserById($postData['author_id'])['username'];
                    $this->view->post = $postData;
                    $this->view->title = $postData['title'];
                    $this->view->render(['getContent'=>'post']);
                } else {
                    $this->view->redirect('index.php/error/noPage/Post%20does\'t%20exist');
                }
            }
        } else {
            $this->view->redirect('index.php/error/noPage/Post%20does\'t%20exist');    
        }
    }

    private function showPostBySlug($slug){
        $post = new Posts;
        $user = new Users;
        $postData = $post->getPostBySlug($slug);
        if (is_array($postData)){
            if ($postData['status'] == true){
                $postData['author'] = $user->getUserById($postData['author_id'])['username'];
                $this->view->post = $postData;
                $this->view->title = $postData['title'];
                $this->view->render(['getContent'=>'post']);
            } else {
                if ($_SESSION['loged'] && $_SESSION['userID'] == $postData['author_id']){
                    $postData['author'] = $user->getUserById($postData['author_id'])['username'];
                    $this->view->post = $postData;
                    $this->view->title = $postData['title'];
                    $this->view->render(['getContent'=>'post']);
                } else {
                    $this->view->redirect('index.php/error/noPage/Post%20does\'t%20exist');
                }
            }
        } else {
            $this->view->redirect('index.php/error/noPage/Post%20does\'t%20exist');    
        }
    }

    public function add()
    {
        $this->view->title = 'Naujas Post\'as';
        $this->view->render(['getContent'=>'postEditor']);

    }

    public function save()
    {
        $post = new Posts;
        $slugObj = new SlugHelper;
        if (isset($_POST['save'])){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $slug = $slugObj->getSlug($title);
            $postID = (int) $_POST['post_id'];
            if ($_SESSION['postID'] == $postID){
                if ($_SESSION['operation'] == 'edit'){
                    $result = $post->updatePost($postID, $title, $content, $slug, 1);
                    if($result){
                        $redirectUrl = 'index.php/post/show/'.$slug.'?id='.$postID;
                        $this->view->redirect($redirectUrl);
                    }
                }
                if ($_SESSION['operation'] == 'new'){
                    if(is_array($post->addNewPost())){ // turi grazinti naujo posto ID
                       // $redirectUrl = 'index.php/post/show/'.$postID;
                       // $this->view->redirect($redirectUrl);
                    }
                }
            }
        }
        
    }

    public function edit($id)
    {
        $post = new Posts;
        $user = new Users;
        $postData = $post->getPostById($id);
        if (is_array($postData)){
            
            if ($_SESSION['loged'] && $_SESSION['userID'] == $postData['author_id']){
                $postData['author'] = $user->getUserById($postData['author_id'])['username'];
                $this->view->post = $postData;
                $this->view->title = 'Edit Post';
                $_SESSION['operation'] = 'edit';
                $_SESSION['postID'] = $id;
                $this->view->render(['getContent'=>'postEditor']);
            } else {
                $this->view->redirect('index.php/error/noPage/Post%20does\'t%20exist');
            }
            
        } else {
            $this->view->redirect('index.php/error/noPage/Post%20does\'t%20exist');    
        }
    }
    
}
