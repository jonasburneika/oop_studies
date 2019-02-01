<?php
namespace App\Controllers;
use App\Libs\Controller;
use App\Models\Posts;
use App\Models\Users;

class PageController extends Controller
{
    private $content = [];

    public function index()
    {
        $posts = new Posts;
       
        /** Padaryti ne is cia */
        $this->view->addBlock('getBanner','banner');
        $this->view->addBlock('getContent','featured');
        $this->view->addBlock('getContent','content');

        $this->view->title = 'Musu super title';
        $this->view->headLine = 'Mūsų headline';
        $this->view->p = 'Trumpas aprasymas';
        $this->view->h1 = 'Didelis aprasymas';
        $this->view->link = baseURL .'index.php';
        /** Padaryti ne is cia */



        $user = new Users;
        $postData = $posts->getAllPosts();
        $postData = mysqli_fetch_all($postData, MYSQLI_ASSOC);
        foreach ($postData as $key => $post) {
            $postData[$key]['author'] = $user->getUserById($post['author_id'])['username'];
        }
        $this->view->posts = $postData;
        $this->view->render($this->view->content);
    }
}
