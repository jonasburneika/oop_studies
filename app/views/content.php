<main role="main" class="container">
    <div class="row">
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
        From the Firehose
        </h3>

        <?php 
            $postsData = $this->posts;
          foreach ($postsData as $post ) {
          
                echo '
                <div class="blog-post">
                    <a href="'; echo 'index.php/Post/show/'.$post['post_slug'] .'?id=' . $post['id'].'" target="_self" ><h2 class="blog-post-title">'.$post['title'].'</h2></a>
                    <p class="blog-post-meta">'.$post['creationTime'].' by <a href="'.indexURL.'index.php/user/profile/'.$post['author_id'].'">'. $post['author'] .'</a></p>
                    <p>'.$post['content'].'</p>
                </div><!-- /.blog-post -->
                ';
            }   
        ?>
        <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>

    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">
        <!-- SEARCH FORM -->
        <div class="searchbox">
            <form autocomplete="off" id="searchForm" action="<?= indexURL ?>index.php/search/index">
                <div class="input-group mb-3">                 
                    <div class="autocomplete">
                        <input id="searchText" name="searchText" type="text" class="form-control" placeholder="Search (min 3chars)" aria-label="Search phrase" aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div class="pl-3 pr-3 search-result">
                <span id = "txtHint"></span>
            </div>
        </div>
        <!-- END OF SEARCH FORM -->
        <div class="p-3 mb-3 bg-light rounded">
            <h4 class="font-italic">About</h4>
            <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>

        <div class="p-3">
            <h4 class="font-italic">Archives</h4>
            <ol class="list-unstyled mb-0">
                <li><a href="#">March 2014</a></li>
                <li><a href="#">February 2014</a></li>
                <li><a href="#">January 2014</a></li>
                <li><a href="#">December 2013</a></li>
                <li><a href="#">November 2013</a></li>
                <li><a href="#">October 2013</a></li>
                <li><a href="#">September 2013</a></li>
                <li><a href="#">August 2013</a></li>
                <li><a href="#">July 2013</a></li>
                <li><a href="#">June 2013</a></li>
                <li><a href="#">May 2013</a></li>
                <li><a href="#">April 2013</a></li>
            </ol>
        </div>
        <div class="p-3">
            <h4 class="font-italic">Elsewhere</h4>
            <ol class="list-unstyled">
                <li><a href="#">GitHub</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
            </ol>
        </div>
    </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main>