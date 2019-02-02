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
        return $db->execute();

    }

    public function getPostById($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('id',$id);
        return $db->execute()->fetch_assoc();
    }

    public function getPostsByAuthorId($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('author_id',$id);
        return mysqli_fetch_all($db->execute(), MYSQLI_ASSOC);
    }

}