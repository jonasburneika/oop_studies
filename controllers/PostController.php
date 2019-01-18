<?php
include_once 'libs/Controller.php';
include_once 'models/Posts.php';

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
    
}
