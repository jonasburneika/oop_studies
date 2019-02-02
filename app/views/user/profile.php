<?php
    $tabList = ['settings'=>'Account Settings','posts'=>'My Posts'];
    if (isset($_GET['tab'])){
        $tab = $_GET['tab'];
        if (key_exists($tab, $tabList)){
            echo '<div class = "row">
                <div class="col-12">';
                    echo '<h2>'.$tabList[$tab].'</h2>';
                echo '</div>';
            echo '</div>';
        } else {

        }
    } else {
        echo '<div class = "row">
            <div class="col-12">';
            echo '<h2>About Me</h2>';
            echo $userData['about'];
        echo '</div></div>';
    }
?>