
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
    <?php if (isset($this->alert)){echo $this->alert;}?>
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
                    <div class="center">
                        <?php
                            if (isset($userData['profileImageUrl'])){
                                echo '<img src="'. indexURL.'img/profiles/'.$userData['profileImageUrl'].'" class="img-responsive" alt="">';
                            } else {
                                echo '<img src="'. indexURL.'img/profile.jpg" class="img-responsive" alt="">';
                            }
                            
                        ?>
                    </div>
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
                        $i = 0;
                        foreach($socialData as $social){
                            if ($i % 5 == 0 && $i != 0){
                                echo '<br>';
                            }
                            echo '    
                            <a href="'.$social['link'].'" target="_blank">
                                <img src="'.indexURL. 'img/'.$social['icon'].'" class="img-responsive" alt="" height="42" width="42">
                            </a>';
                            $i++;
                       }
					?>
					
				</div>
                <!-- END SIDEBAR BUTTONS -->
                
                <!-- SIDEBAR MENU -->
                <?php 
                    echo '<div class="profile-usermenu">';
                        include $this->profileNavigation;
                    echo '</div>';
                ?>
                <!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
                <?php include $this->profileContent;?>
            </div>
		</div>
	</div>
</div>