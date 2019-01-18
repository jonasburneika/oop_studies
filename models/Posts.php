<?php
include_once 'libs/Database.php';

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