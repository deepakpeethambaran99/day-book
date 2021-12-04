<div class="col profile">
				<?php $path = base_url()."css/img/profile-default.png"; ?>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?php if($loggedin){echo $this->session->userdata('avatar');} else{ echo $path; }?>" alt="profile-image" data-toggle="tooltip" title="profile"></a>
					<!-- -->
				<div class="dropdown-menu">
					<a href="<?php echo site_url('Profile');?>" class="dropdown-item"><span class="fa fa-user"></span> Profile</a>
					<a href="<?php echo site_url('About');?>" class="dropdown-item"><span class="fa fa-info-circle"></span> About</a>
					<div class="separator"></div>
					<?php if($loggedin){?>
						<a href="<?php echo site_url('Logout');?>" class="dropdown-item"><span class="fa fa-sign-in"></span> Log Out</a>
					<?php } 
						else{
					?>
					<a href="<?php echo site_url('Login-Register');?>" class="dropdown-item"><span class="fa fa-sign-in"></span> Login</a>
				<?php } ?>
				</div>
			</div>