<?php

namespace App\Controllers;
use App\Libs\Controller;
use App\Models\Posts;


class PostController extends Controller
{
    protected $ID;
    protected $author;

    public function index()
    {
        $posts = new Posts;
       
        $this->view->posts = $posts->getAllPosts();
        $this->view->title = 'Musu super title';
        $this->view->headLine = 'Mūsų headline';
        $this->view->render(['getContent'=>'posts']);

    }

    public function show($id)
    {
        $post = new Posts;
        $this->view->post = $post->getPostById($id);
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
