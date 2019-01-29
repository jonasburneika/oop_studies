<?php
// include_once 'app/libs/Database.php';

namespace App\Models;
use App\Libs\Database;

class Posts
{

    public function getAllPosts()
    {
        $db = new Database(); // Skliausteliai leidzia i konstruktoriu nusiusti parametrus
        $db->select()->from('posts');
        return $db->get();

    }

    public function getPostById($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('id',$id);
        return $db->get()->fetch_assoc();
    }

}