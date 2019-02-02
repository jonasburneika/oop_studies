<?php
echo '<ul class="nav">';
    echo '
    <li ';
        if ($this->tab == 'profile'){
            echo 'class="active" ';
        }
    echo '>
        <a href="'.indexURL.'index.php/user/profile/'.$userData['id'].'">
            <i class="glyphicon glyphicon-home"></i>Overview
        </a>
    </li>';
    if ($_SESSION['loged']){
        echo '
        <li ';
            if ($this->tab == 'settings'){
                echo 'class="active" ';
            }
        echo '>
            <a href="'.indexURL.'index.php/user/settings" target="_self">
            <i class="glyphicon glyphicon-user"></i>
            Account settings </a>
        </li>';
    }
        echo '
        <li ';
            if ($this->tab == 'posts'){
                echo 'class="active" ';
            }
        echo '>
            <a href="'.indexURL.'index.php/user/posts/'.$userData['id'].'" target="_self">
            <i class="glyphicon glyphicon-ok"></i>
            Articles </a>
        </li>';
echo '</ul>';
?>
