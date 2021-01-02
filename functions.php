<?php
// Login ShortCode
if(!function_exists('cawoy_login'))
{
    function cawoy_login() {
        require_once('templates/login.php');
    }
    add_shortcode( 'cawoy_login', 'cawoy_login' );
}
// Register ShortCode
if(!function_exists('cawoy_register'))
{
    function cawoy_register() {
        require_once('templates/register.php');
    }
    add_shortcode( 'cawoy_register', 'cawoy_register' );
}
// Dashboard ShortCode
if(!function_exists('cawoy_dashboard'))
{
    function cawoy_dashboard() {
        include('templates/dashboard.php');
    }
    add_shortcode( 'cawoy_dashboard', 'cawoy_dashboard' );
}
// Forget Password ShortCode
if(!function_exists('cawoy_forget_password'))
{
    function cawoy_forget_password() {
        require_once('templates/forget_password.php');
    }
    add_shortcode( 'cawoy_forget_password', 'cawoy_forget_password' );
}
// Bookmarks ShortCode
if(!function_exists('cawoy_bookmarks'))
{
    function cawoy_bookmarks() {
        require_once('templates/bookmarks.php');
    }
    add_shortcode( 'cawoy_bookmarks', 'cawoy_bookmarks' );
}
// Change Passsword ShortCode
if(!function_exists('cawoy_change_password'))
{
    function cawoy_change_password() {
        require_once('templates/change-password.php');
    }
    add_shortcode( 'cawoy_change_password', 'cawoy_change_password' );
}
/*
 * Registration Form
 */
if(!function_exists('cawoy_registration_validation'))
{
    function cawoy_registration_validation($username,$email,$password,$cpassword,$role){
        global $reg_errors;
        $reg_errors = new WP_Error;
        if ( empty( $username ) || empty( $password ) || empty( $email ) ) 
        {
            $reg_errors->add('field', 'Required form field is missing');
        }
        if ( 4 > strlen( $username ) ) 
        {
            $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
        }
        if ( username_exists( $username ) )
            $reg_errors->add('user_name', 'Sorry, that username already exists!');
        if ( 5 > strlen( $password ) ) 
            $reg_errors->add( 'password', 'Password length must be greater than 5' );
        if ( !is_email( $email ) ) {
            $reg_errors->add( 'email_invalid', 'Email is not valid' );
        }
        if ( email_exists( $email ) ) {
            $reg_errors->add( 'email', 'Email Already in use' );
        }
        if($password!==$cpassword)
            $reg_errors->add( 'Password', 'Passowrd is not same!' ); 
    if(1 > count( $reg_errors->get_error_messages()))
    {
        return true;
    }
    return false;
         }
}
if(!function_exists('cawoy_follow_count'))
{
    function cawoy_follow_count()
    {
        global $wpdb;
        global $current_user;
        wp_get_current_user();
        $table_name   = $wpdb->prefix . "ca_follow_system";
        $follow_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE follow_id= '$current_user->ID' AND status='follow'");
        if($follow_count >0)
            return $follow_count ;
        return 0;
    }
}
if(!function_exists('cawoy_following_count'))
{
    function cawoy_following_count()
    {
        global $wpdb;
        global $current_user;
        wp_get_current_user();
        $table_name   = $wpdb->prefix . "ca_follow_system";
        $follow_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE follower_id= '$current_user->ID' AND status='follow'");
        if($follow_count >0)
            return $follow_count ;
        return 0;
    }
}
if(!function_exists('upload_user_file'))
{
function upload_user_file( $file = array() ) {

	require_once( ABSPATH . 'wp-admin/includes/admin.php' );

      $file_return = wp_handle_upload( $file, array('test_form' => false ) );

      if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
          return false;
      } else {

          $filename = $file_return['file'];

          $attachment = array    (
              'post_mime_type' => $file_return['type'],
              'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
              'post_content' => '',
              'post_status' => 'inherit',
              'guid' => $file_return['url']
          );

          $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );

          require_once(ABSPATH . 'wp-admin/includes/image.php');
          $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
          wp_update_attachment_metadata( $attachment_id, $attachment_data );

          if( 0 < intval( $attachment_id ) ) {
          	return $attachment_id;
          }
      }

      return false;
}
}
if(!function_exists('woy_following_count'))
{
function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}
}
if(!function_exists('PostSavedUnsavedCounter'))
{
function PostSavedUnsavedCounter($user_id,$post_id,$status)
{
    global $wpdb;
    $table_name=$wpdb->prefix. "ca_activity";
    $count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE user_id='$user_id' AND post_id='$post_id' AND status='$status'");
   
    if($count >0)
        return $count;
    return 0;
}
}
if(!function_exists('UserInfo'))
{
function UserInfo($user_id)
{
    $user=get_user_by('ID', $user_id);
    $result="<div class='ca-author-info'>";
    $result = $result . "<div class='ca-author-img'>";
    $result = $result . "<a href='".home_url()."/author/".$user->user_login."'>";
    if($user->wp_kljt_user_avatar)
        $result = $result . "<img src='". wp_get_attachment_url($user->wp_kljt_user_avatar)."'>";
    else
        $result  = $result . "<img src='".Cawoy_Frontend_DIR."/assets/images/post_snippet.png' >";
    $result = $result . "</a>";
    $result = $result . "</div>";
    
    $result = $result . "<div class='ca-author-meta'><h2>";
    
    $result = $result . $user->first_name." ".$user->last_name;

    $result = $result . "</h2>";
    if(empty($user->job_title))
        $user->job_title="";
    $result = $result . "<p>".$user->job_title;
    if(empty($user->company_title))
        $user->company_title="";
    else
        $user->company_title=",".$user->company_title;
    $result = $result .  $user->company_title."</p>";
    $result = $result . "</div>";
    $result = $result . "</div>";
    return $result ;
}
}
?>
