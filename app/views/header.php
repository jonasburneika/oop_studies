<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- include libraries(jQuery, bootstrap) -->

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
    
    <link rel="stylesheet" type="text/css" media="screen" href="<?= cssURL ?>app/views/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?= cssURL ?>app/views/css/main.css" />
    <script src="<?= baseURL ?>app/views/js/profile.js"></script>
    <script src="<?= baseURL ?>app/views/js/bootstrap.js"></script>
</head>
<body>
    
    <div class="header" id="myHeader">
        <div class="container">
            <header class="blog-header py-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                <?php if (isset($_SESSION['username'])){
                    echo '<a class="text-muted" href="' . indexURL . 'index.php/user/profile/">'.$_SESSION['username'].'</a>';
                } else {
                    echo '<a class="text-muted" href="' . indexURL . 'index.php/user/register">Register</a>';
                } 
                    
                ?>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="<?= indexURL ?>index.php">OOP MVC PROJECT</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">      
                    <a class="text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                    </a>
                    <?php
                        if($_SESSION['loged']){
                            echo '<a class="btn btn-sm btn-outline-info" href="' . indexURL . 'index.php/user/logout">Log Out</a>';
                        } else {
                            echo '<a class="btn btn-sm btn-outline-success" href="' . indexURL . 'index.php/user/login">Sign in</a>';
                            
                        }
                    ?>
                </div>
                </div>
            </header>
            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between">
                    <a class="p-2 text-muted" href="page/">World</a>
                    <a class="p-2 text-muted" href="#">U.S.</a>
                    <a class="p-2 text-muted" href="#">Technology</a>
                    <a class="p-2 text-muted" href="#">Design</a>
                    <a class="p-2 text-muted" href="#">Culture</a>
                    <a class="p-2 text-muted" href="#">Business</a>
                    <a class="p-2 text-muted" href="#">Politics</a>
                    <a class="p-2 text-muted" href="#">Opinion</a>
                    <a class="p-2 text-muted" href="#">Science</a>
                    <a class="p-2 text-muted" href="#">Health</a>
                    <a class="p-2 text-muted" href="#">Style</a>
                    <a class="p-2 text-muted" href="#">Travel</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
