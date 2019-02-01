<?php

namespace App\Controllers;
use App\Libs\Controller;
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

    public function show($id)
    {
        $post = new Posts;
        $user = new Users;
        $postData = $post->getPostById($id);
        $postData['author'] = $user->getUserById($postData['author_id'])['username'];
        $this->view->post = $postData;
        $this->view->render(['getContent'=>'post']);
    }

    public function addPost()
    {
        $this->view->title = 'Naujas Post\'as';
        $this->view->render(['getContent'=>'newPost']);

    }

    public function savePost()
    {
        var_dump($_POST);
    }
    
}
