<?php
    echo '<h2>'.$userData['username'].'\'s articles</h2>';
    $posts = $this->posts;
    if (count($posts)>0){
        foreach ($posts as $post){
            echo '<div class = "row pt-3">
                <div class="col-12">
                    <div class="post">
                        <div class="post-head-title">
                            <a href="'.indexURL.'index.php/Post/show/'.$post['post_slug'].'?id='.$post['id'].'" target="_self"><h3>'.$post['title'].'</h3></a>
                        </div>
                        <div class="post-head">
                            <p>
                                <span class="date">'. $post['creationTime'] . '</span>
                            </p>
                        </div>
                        <div class="entry" data-content-ads-inserted="true">';
                            if (strlen($post['content'])>250){
                                echo '<span class="articleAnotation">'. substr($post['content'], 0, 250).'...</span>';
                                echo '<br><div class="float-right">';
                                    if ($_SESSION['loged'] && $post['author_id'] == $_SESSION['userID']){
                                        echo '<span class="post-edit"><a href="'.indexURL.'index.php/post/edit/'.$post['id'].'" target="_self">Edit article</a></span>';
                                    }
                                    echo '<span class="post-read"><a href="'.indexURL.'index.php/post/show/'.$post['post_slug'].'?id='.$post['id'].'" target="_self">Read more</a></span>';
                                echo '</div>';
                            } else {
                                echo $post['content'];
                            }
                        echo'</div>
                    </div>';
                echo '</div>';
            echo '</div>';
        }
    }
?>