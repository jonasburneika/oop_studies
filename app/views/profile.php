
<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
<?php
$userData = $this->user;
$socialData = $this->user['social'];
?>
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
                    <?php
                        if (isset($userData['profileImageUrl'])){
                            echo '<img src="'. indexURL.'img/profiles/'.$userData['profileImageUrl'].'" class="img-responsive" alt="">';
                        } else {
                            echo '<img src="'. indexURL.'img/profile.jpg" class="img-responsive" alt="">';
                        }
                        
                    ?>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?= $userData['username']?>
					</div>
					<div class="profile-usertitle-job">
                        <?= $userData['username']?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
                    <?php
                    
                        foreach($socialData as $social){
                            
                            echo '    
                            <a href="'.$social['link'].'" target="_blank">
                                <img src="'.indexURL. 'img/'.$social['icon'].'" class="img-responsive" alt="" height="42" width="42">
                            </a>';
                           
                       }
					?>
					
				</div>
                <!-- END SIDEBAR BUTTONS -->
                
                <!-- SIDEBAR MENU -->
                <?php 
                if ($_SESSION['loged']){
                    echo '
                    <div class="profile-usermenu">
                        <ul class="nav">';

                                echo '
                                <li class="active">
                                    <a href="'.indexURL.'index.php/user/profile">
                                        <i class="glyphicon glyphicon-home"></i>Overview
                                    </a>
                                </li>';
                            
                                echo '
                                <li>
                                    <a href="'.indexURL.'index.php/user/profile?tab=settings" target="_self">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Account Settings </a>
                                </li>';
                                echo '
                                <li>
                                    <a href="'.indexURL.'index.php/user/profile?tab=posts" target="_self">
                                    <i class="glyphicon glyphicon-ok"></i>
                                    My Posts </a>
                                </li>';
                            echo '
                        </ul>
                    </div>';
                }
                ?>
                <!-- END MENU -->
                
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
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
                        $posts = $this->posts;
                        if (count($posts)>0){
                            echo '<h2 class="pt-5">'.$userData['username'].'\'s articles</h2>';
                            foreach ($posts as $post){
                                echo '<div class = "row pt-3">
                                    <div class="col-12">
                                        <div class="post">
                                            <div class="post-head-title">
                                                <a href="'.indexURL.'index.php/Post/show/'.$post['id'].'" target="_self"><h3>'.$post['title'].'</h3></a>
                                            </div>
                                            <div class="post-head">
                                                <p>
                                                    <span class="date">'. $post['creationTime'] . '</span>
                                                </p>
                                            </div>
                                            <div class="entry" data-content-ads-inserted="true">';
                                                if (strlen($post['content'])>250){
                                                    echo '<span class="articleAnotation">'. substr($post['content'], 0, 250).'...</span>';
                                                    echo '<br><div class="float-right"><a href="'.indexURL.'index.php/Post/show/'.$post['id'].'" target="_self">Read more</a> </div>';
                                                } else {
                                                    echo $post['content'];
                                                }
                                            echo'</div>
                                        </div>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        }

                    }
                ?>
               
            </div>
		</div>
	</div>
</div>