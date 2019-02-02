<?php
// include_once 'app/libs/Database.php';

namespace App\Models;
use App\Libs\Database;

class Posts
{

    public function getAllPosts()
    {
        $db = new Database(); // Skliausteliai leidzia i konstruktoriu nusiusti parametrus
        $db->select()->from('posts')->where('status',true)->orderBy('creationTime','desc');
        return $db->execute();

    }

    public function getPostById($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('id',$id);
        return $db->execute()->fetch_assoc();
    }

    public function getPostBySlug($slug)
    {
        $db = new Database();
        $db->select()->from('posts')->where('post_slug',$slug);
        return $db->execute()->fetch_assoc();
    }

    public function getActivePostById($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('id',$id)->whereAnd('status',true);
        return $db->execute()->fetch_assoc();
    }

    public function getPostsByAuthorId($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('author_id',$id);
        return mysqli_fetch_all($db->execute(), MYSQLI_ASSOC);
    }
    public function getActivePostsByAuthorId($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('author_id',$id)->whereAnd('status','1');
        return mysqli_fetch_all($db->execute(), MYSQLI_ASSOC);
    }

    public function updatePost($id, $title, $content, $slug, $status){
        $db = new Database();
        $content = $db->escape($content);
        $title = $db->escape($title);
        $slug = $db->escape($slug);
        $db->update('posts')->set(['title'=>$title,'content'=>$content,'status'=>$status, 'post_slug'=>$slug])->where('id',$id);
        return $db->execute();
    }

}