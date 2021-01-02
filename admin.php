<?php
function professionInfo( $user ) { ?>
   
    <h3><?php _e('Job Info'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="job_title">Job Title</label></th>
            <td>
            <input type="text" name="job_title" id="job_title" value="<?php echo esc_attr( get_the_author_meta( 'job_title', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter your Job Title</span>
            </td>
        </tr>
        <tr>
            <th><label for="company_title">Company Title</label></th>
            <td>
            <input type="text" name="company_title" id="company_title" value="<?php echo esc_attr( get_the_author_meta( 'company_title', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter Company Title.</span>
            </td>
        </tr>
    </table>
<?php

}

// Then we hook the function to "show_user_profile" and "edit_user_profile"
add_action( 'show_user_profile', 'professionInfo', 10 );
add_action( 'edit_user_profile', 'professionInfo', 10 );
function save_professionInfo( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    /* Edit the following lines according to your set fields */
    update_usermeta( $user_id, 'job_title', $_POST['job_title'] );
    update_usermeta( $user_id, 'company_title', $_POST['company_title'] );
}

add_action( 'personal_options_update', 'save_professionInfo' );
add_action( 'edit_user_profile_update', 'save_professionInfo' );


function SocialMediaInfo( $user ) { ?>
   
    <h3><?php _e('Social Media'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="job_title">Facebook</label></th>
            <td>
            <input type="text" name="job_title" id="job_title" value="<?php echo esc_attr( get_the_author_meta( 'job_title', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter your Job Title</span>
            </td>
        </tr>
        <tr>
            <th><label for="company_title">Twitter</label></th>
            <td>
            <input type="text" name="company_title" id="company_title" value="<?php echo esc_attr( get_the_author_meta( 'company_title', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter Company Title.</span>
            </td>
        </tr>
        <tr>
            <th><label for="company_title">LinkedIn</label></th>
            <td>
            <input type="text" name="company_title" id="company_title" value="<?php echo esc_attr( get_the_author_meta( 'company_title', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter Company Title.</span>
            </td>
        </tr>
        <tr>
            <th><label for="company_title">Youtube</label></th>
            <td>
            <input type="text" name="company_title" id="company_title" value="<?php echo esc_attr( get_the_author_meta( 'company_title', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter Company Title.</span>
            </td>
        </tr>
    </table>
<?php
}
add_action( 'show_user_profile', 'SocialMediaInfo', 10 );


?>