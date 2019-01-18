<?php
include_once 'models/Posts.php';
include_once 'libs/Controller.php';

class PageController extends Controller
{
    private $content = [];

    public function index()
    {
        $posts = new Posts;
       
        /** Padaryti ne is cia */
        $this->addBlock('getBanner','banner');
        $this->addBlock('getContent','featured');
        $this->addBlock('getContent','content');

        $this->view->title = 'Musu super title';
        $this->view->headLine = 'Mūsų headline';
        $this->view->p = 'Trumpas aprasymas';
        $this->view->h1 = 'Didelis aprasymas';
        $this->view->link = baseURL .'index.php';
        /** Padaryti ne is cia */

        $this->view->posts = $posts->getAllPosts();
        $this->view->render($this->content);
    }

    public function addBlock($method, $value)
    {
        $this->content[] = [$method => $value];
    }
}
