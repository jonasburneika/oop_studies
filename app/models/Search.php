<?php

namespace App\Models;
use App\Libs\Database;

class Search{
    
    public function searchInSlug($phrase){
        $db = new Database;
        $pattern = '\'%'.$phrase.'%\'';
        $db->select(['post_slug','id','title'])->from('posts')->whereLike('post_slug',$pattern)->whereAnd('status',1);
        return $db->execute()->fetch_assoc();
    }

    public function searchInTitle($phrase){
        $db = new Database;
        $pattern = '\'%'.$phrase.'%\'';
        $db->select(['post_slug','id','title'])->from('posts')->whereLike('title',$pattern)->whereAnd('status',1);
        return $db->execute()->fetch_assoc();
    }

    public function searchInContent($phrase){
        $db = new Database;
        $pattern = '\'%'.$phrase.'%\'';
        $db->select(['post_slug','id','title'])->from('posts')->whereBlobLike('content',$pattern)->whereAnd('status',1);
        return $db->execute()->fetch_assoc();
    }
}

?>