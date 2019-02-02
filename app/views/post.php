<?php
    $post = $this->post;
 ?>

<div class="post">
    <div class="post-head-title">
        <h1><?= $post['title']?></h1>
    </div>
        <div class="post-head">
            <a class="image" href="https://www.miss-thrifty.co.uk/author/missthrifty/">
                <img alt="" src="https://secure.gravatar.com/avatar/a9443ce9d0cd7ea643f6f0b717218f6b?s=51&amp;d=mm&amp;r=g"
                    srcset="https://secure.gravatar.com/avatar/a9443ce9d0cd7ea643f6f0b717218f6b?s=102&amp;d=mm&amp;r=g 2x"
                    class="avatar avatar-51 photo" height="51" width="51"></a>
            <p><a href="<?= indexURL ?>index.php/user/profile/<?= $post['author_id'] ?>"><?= $post['author'] ?> </a><a href="https://www.miss-thrifty.co.uk/the-mythbusters-guide-to-saving-money-on-energy-bills/#respond"
                    class="comments">(0) </a><span class="date"><?= $post['creationTime'] ?></span></p>
        </div>
        <div class="entry">
            <?= $post['content'] ?>
        </div>
    </div>
</div>