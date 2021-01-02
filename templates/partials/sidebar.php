<div class="col-md-3 col-12">
    <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action <?php if($activeMenu=='dashboard') echo 'active' ;?>" id="list-home-list" data-toggle="list" href="<?php echo home_url().'/user/dashboard/'?>" role="tab" aria-controls="home"><i class="fas fa-user"></i> Account Information</a>

        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="<?php echo home_url().'/user/bookmarks/'?>" role="tab" aria-controls="profile"><i class="fas fa-bookmark"></i> Bookmarks</a>

        <!-- If user is congtribtuor, show the other options -->
        <?php 
            $user = wp_get_current_user();
            if ( in_array( 'administrator', (array) $user->roles ) || in_array( 'contributor', (array) $user->roles )):
        ?>

        <a class="list-group-item list-group-item-action <?php if($activeMenu=='posts') echo 'active' ;?>" id="list-messages-list" data-toggle="list" href="<?php echo home_url().'/user/posts/'?>" role="tab" aria-controls="messages"><i class="fas fa-file-alt"></i> Posts</a>

        <?php endif; ?>

        <a class="list-group-item list-group-item-action <?php if($activeMenu=='change-password') echo 'active' ;?>" id="list-messages-list" data-toggle="list" href="<?php echo home_url().'/user/change-password/'?>" role="tab" aria-controls="messages"><i class="fas fa-lock"></i> Change Password</a>

        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="<?php echo esc_url( wp_logout_url('user/dashboard') ); ?>" role="tab" aria-controls="settings"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

</div>
