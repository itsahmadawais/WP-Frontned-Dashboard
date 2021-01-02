<?php
/*Requests*/
if(isset($_POST['register_account']))
{
    $username=sanitize_user($_POST['username']);
    $password=esc_attr($_POST['password']);
    $cpassword=esc_attr($_POST['cpassword']);
    $email=sanitize_email($_POST['email']);
    $role=esc_attr($_POST['role']);
    if($role=="admin")
    {
        $role="subscriber";
    }
    /*Validating Form*/
    if(cawoy_registration_validation($username,$email,$password,$cpassword,$role))
    {
        $userdata = array(
        'user_login'    =>   $username,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'role'    =>   $role
        );
        
    $user = wp_insert_user( $userdata );
    wp_redirect( home_url()."/user/login/" ); exit; 
    }
}

/* Main redirection of the default login page */
if(isset($_POST['ca-loginuser']) && wp_verify_nonce($_POST['ca_login_nonce'], 'ca-login-nonce'))
{
    global $customMessage;
     //We shall SQL escape all inputs  
    $username = $wpdb->escape($_REQUEST['username']);  
    $password = $wpdb->escape($_REQUEST['password']);  
    $remember = $wpdb->escape($_REQUEST['rememberPasswordCheck']); 
    if($remember) $remember = "true";  
    else $remember = "false";
     $login_data = array(); 
    $login_data['user_login'] = $username; 
    $login_data['user_password'] = $password; 
    $login_data['remember'] = $remember; 
   
    $user_verify = wp_signon( $login_data, false );   
   
    if ( is_wp_error($user_verify) )   
    {  
        $customMessage['Login Error']="Please enter correct email/username or password!";
     } else
    {    
       echo "<script type='text/javascript'>window.location.href='". home_url() ."/user/dashboard/'</script>";  
       exit();  
     }  
     
}
if(isset($_POST['ca-update_password']))
{
    global $reg_errors;
    global $customMessage;
    $reg_errors = new WP_Error;
    $password = esc_attr($_POST['password']);  
    $cpassword = esc_attr($_POST['cpassword']);
    $currpassword = esc_attr($_POST['currpassword']);
    $user_id = get_current_user_id();

    // Check for errors
    if (empty($currpassword) && empty($password) && empty($cpassword) ) {
    $reg_errors->add( 'Error', 'Form is empty!' );
    }
    if($current_user && wp_check_password($currpassword, $current_user->data->user_pass, $current_user->ID)){
    //match
    } else {
        $reg_errors->add( 'Password', 'Passowrd is incorrect!' );
    }
    if($password != $cpassword){
        $reg_errors->add( 'Password', 'Passowrd  does not match!' );
    }
    if(strlen($password) < 6){
        $reg_errors->add( 'Password', 'Passord is too short!' );
    }
    if(is_wp_error( $reg_errors ))
    {
        $result=wp_set_password( $password, $user_id);
        if(!is_wp_error($result))
        {
            wp_set_auth_cookie( $user_id, true);
        }
    }
}
if(isset($_POST['ca-submit-post']) || isset($_POST['ca_save_draft']))
{
    if ( trim( $_POST['postTitle'] ) === '' ) {
        $postTitleError = 'Please enter a title.';
        $hasError = true;
    }
    $status= isset($_POST['ca_save_draft']) ? "draft" : "pending";
    $attach_id = upload_user_file($_FILES["featuredimgfile"]);
    $post_information = array(
        'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
        'post_content' => $_POST['postContent'],
        'post_category' => array($_POST['postCategory']),
        'post_type' => 'post',
        'post_status' => $status
    );
 
    $pid=wp_insert_post( $post_information );
    wp_set_post_tags($pid, $_POST['postTags']);
    if ( $pid) {
        set_post_thumbnail( $pid, $attach_id );
        if($status=='draft')
            wp_redirect( home_url()."/user/edit-post/".$pid );
        else
            wp_redirect( home_url()."/user/posts/" );
        exit;
}
}
if(isset($_POST['ca-update-post']) || isset($_POST['ca_update_saved_draft']))
{
    if ( trim( $_POST['postTitle'] ) === '' ) {
        $postTitleError = 'Please enter a title.';
        $hasError = true;
    }
    $attach_id=false;
    $status=isset($_POST['ca_update_saved_draft']) ? "draft" : "pending";
    if(isset($_FILES["featuredimgfile"]))
        $attach_id = upload_user_file($_FILES["featuredimgfile"]);
    $post_information = array(
        'ID' => $_POST['postID'],
        'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
        'post_content' => $_POST['postContent'],
        'post_category' => array($_POST['postCategory']),
        'post_type' => 'post',
        'post_status' => $status
    );
    $pid=wp_update_post( $post_information );
    wp_set_post_tags($pid, $_POST['postTags']);
    if ( $pid) {
        if($attach_id)
            set_post_thumbnail( $pid, $attach_id );
        wp_redirect( home_url()."/user/edit-post/".$pid );
        exit;
}
}
if(isset($_POST['ca-update-info']))
{
    global $reg_errors;
    global $customMessage;
    $reg_errors = new WP_Error;
    
    $userInfo = array();
    $customMessage = array();
    
    if(empty($_POST['fname']))
    {
        $userInfo['fname']="";
    }
    else{
        $userInfo['fname']=$_POST['fname'];
    }
    
    if(empty($_POST['lname']))
    {
        $userInfo['lname']="";
    }
    else{
        $userInfo['lname']=$_POST['lname'];
    }
    
    if(empty($_POST['company_name']))
    {
        $userInfo['company_title']="";
    }
    else{
        $userInfo['company_title']=$_POST['company_name'];
    }
    
    if(empty($_POST['job_title']))
    {
        $userInfo['job_title']="";
    }
    else{
        $userInfo['job_title']=$_POST['job_title'];
    }
    
    if(empty($_POST['email']))
    {
        $userInfo['email']="";
    }
    else{
        $userInfo['email']=$_POST['email'];
    }
    /*if(empty($_POST['website_url']))
    {
        $customMessage[]="Please add your website";
    }
    else{
        $userInfo['website_url']=$_POST['website_url'];
    }*/
        
    $userInfo['website_url']=$_POST['website_url'];
    
    $userInfo['facebook']=$_POST['facebook'];

    $userInfo['linkedin']=$_POST['linkedin'];

    $userInfo['twitter']=$_POST['twitter'];

    $userInfo['youtube']=$_POST['youtube'];

    $userInfo['googleplus']=$_POST['googleplus'];

    $userInfo['instagram']=$_POST['instagram'];
    
    if(empty($_POST['about']))
    {
        $userInfo['about']="";
    }
    else{
        $userInfo['about']=$_POST['about'];
    }
    foreach($customMessage as $m)
        echo $m;
    
    if(!(count($customMessage)>0))
    {
        global $current_user;
        wp_get_current_user();
        $user_data = wp_update_user( 
            array( 
            'ID' => $current_user->ID, 
            'user_url' => $userInfo['website_url'],
            'user_email'=>$userInfo['email'],
            'first_name'      => $userInfo['fname'],
            'last_name'       => $userInfo['lname'],
            'description'     => $userInfo['about'],
            'company_title'     => $userInfo['company_name'],
            'job_title'     => $userInfo['job_title']
                )
        ); 
        
    update_usermeta( $current_user->ID, 'job_title', $userInfo['job_title'] );
        
    update_usermeta( $current_user->ID, 'company_title', $userInfo['company_title'] );
   
    update_usermeta( $current_user->ID, 'facebook', $userInfo['facebook']);
    
    update_usermeta( $current_user->ID, 'youtube', $userInfo['youtube']);

    update_usermeta( $current_user->ID, 'linkedin', $userInfo['linkedin']);

    update_usermeta( $current_user->ID, 'twitter', $userInfo['twitter']);

    update_usermeta( $current_user->ID, 'instagram', $userInfo['instagram']);

    update_usermeta( $current_user->ID, 'googleplus', $userInfo['googleplus']);
}
}
/*Upload User Profile Photo*/
if(isset($_FILES['newUserPhotoFile']))
{
    $attach_id = upload_user_file($_FILES["newUserPhotoFile"]);
    if($attach_id)
    {
        global $current_user;
        wp_get_current_user();
        update_usermeta( $current_user->ID, 'wp_kljt_user_avatar', $attach_id);
    }
}
?>
