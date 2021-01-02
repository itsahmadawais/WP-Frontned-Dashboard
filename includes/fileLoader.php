<?php

/*
Loading Script Files
*/
if(!function_exists('cawoy_plugin_scripts'))
{
    function cawoy_plugin_scripts(){
        wp_enqueue_style('ca-frontend-css-fa',Cawoy_Frontend_DIR.'assets/css/font-awesome.css');
        wp_enqueue_style('ca-frontend-css-bootstrap',Cawoy_Frontend_DIR.'assets/css/bootstrap.css');
        wp_enqueue_style('ca-frontend-css-style',Cawoy_Frontend_DIR.'assets/css/style.css');
        wp_enqueue_script('jquery');
        wp_enqueue_script('ca-frontend-js',Cawoy_Frontend_DIR.'assets/js/main.js','jQuery','1.0.0',true);
        wp_enqueue_script('ca-frontend-ajax',Cawoy_Frontend_DIR.'assets/js/ajaxcalls.js','jQuery','1.0.0',false);
        wp_localize_script( 'ca-frontend-ajax', 'ca_ajax_url', array(
    'ajax_url' => admin_url( 'admin-ajax.php' ),
) ); 
    }
    add_action('wp_enqueue_scripts','cawoy_plugin_scripts');
}
$user = wp_get_current_user();
if(in_array( 'contributor', (array) $user->roles ) || in_array( 'subscriber', (array) $user->roles ))
{
    show_admin_bar( false );
}
/*
add_filter( 'template_include_part','frontened_template_loader');
function frontened_template_loader( $template ) {
    
    echo "<script>alert('".get_query_var('pg')."');</script>";
   return plugin_dir_path( __FILE__ ) . "templates/".get_query_var('pg').".php";
       
    if ( isset( $_GET['pg'] ) ) 
    {
        $pg_name=$_GET['pg'];
        if($pg_name=='login' && !is_user_logged_in())
        {
            return plugin_dir_path( __FILE__ ) . 'templates/login.php';
        }
        else if($pg_name=='register' && !is_user_logged_in())
        {
            return plugin_dir_path( __FILE__ ) . 'templates/register.php';
        }
        else if($pg_name=='register' && is_user_logged_in())
        {
            return plugin_dir_path( __FILE__ ) . 'templates/login.php';
        }
        else if($pg_name=='dashboard')
        {
            return plugin_dir_path( __FILE__ ) . 'templates/dashboard.php';
        }
    }
    
    else {
    return $template;
  }
}
*/
add_filter( 'document_title_parts', 'cyb_change_document_title_parts' );
function cyb_change_document_title_parts ( $title_parts ) {
if ( get_query_var('pg') ) 
    {
        $pg_name=get_query_var('pg');
        switch($pg_name)
        {
            /*For Login & Register Page*/
            case 'login':
                $title_parts['title'] = 'User - Login';
                break;
            case 'register':
                $title_parts['title'] = 'User - Registration';
                break;
                
            case 'dashboard': 
                $title_parts['title'] = 'User - Dashboard';
                break;
            case 'change-password':
                 $title_parts['title'] = 'User - Change Password';
                break;
            case 'posts':
                $title_parts['title'] = 'User - Posts';
                break;
                
            case 'add-new-post':
                $title_parts['title'] = 'User - Add New Post';
                break;
                
            default:
                $title_parts['title'] = 'User Dashboard';
        }
    }

    return $title_parts;

}

add_action('init', 'plugin_add_rewrite_rule');
function plugin_add_rewrite_rule(){
    add_rewrite_rule('^user/([^/]+)/([0-9]+)/?','index.php?pg=$matches[1]&postID=$matches[2]','top');
    add_rewrite_rule('^user/([^/]+)/page/([0-9]+)/?','index.php?pg=$matches[1]&paged=$matches[2]','top');
    add_rewrite_rule('^user/([^/]+)/?','index.php?pg=$matches[1]','top');
    flush_rewrite_rules();  
}

//2. add a wp query variable to redirect to
add_action('query_vars','plugin_set_query_var');
function plugin_set_query_var($vars) {
    array_push($vars, 'pg'); // ref url redirected to in add rewrite rule
    array_push($vars, 'postID'); // ref url redirected to in add rewrite rule
    array_push($vars, 'paged'); // ref url redirected to in add rewrite rule
    return $vars;
}

add_filter('template_include', 'plugin_include_template');
function plugin_include_template($template){
    global $activeMenu;
    $new_template=Cawoy_PLUG_PATH . 'templates/dashboard.php';
    // see above 2 functions..
    if(get_query_var('pg'))
    {
        $pg_name=get_query_var('pg');
        switch($pg_name)
        {
            /*For Login & Register Page*/
            case 'login':
            case 'register':
            case 'forget_password':
                if(!is_user_logged_in())
                {
                    $new_template = Cawoy_PLUG_PATH. 'templates/'.$pg_name.'.php';
                }
                else if(is_user_logged_in())
                {
                    wp_redirect( home_url()."/user/dashboard/" ); exit; 
                }
                break;
                
            case 'dashboard':
            case 'change-password':
            case 'posts':
            case 'add-new-post':
            case 'edit-profile':
            case 'bookmarks':
            case 'edit-post':
            case 'draft-posts':
                if(is_user_logged_in())
                {
                    $new_template = Cawoy_PLUG_PATH . 'templates/'.$pg_name.'.php';
                    $activeMenu=$pg_name;
                }
                else
                {
                    wp_redirect( home_url()."/user/login/" ); exit; 
                }
                break;
            default:
                wp_redirect( home_url()); exit;
        }
       
        if(file_exists($new_template)){
            $template = $new_template;
        } 
        // else needed? up to you maybe 404?
    }    
    return $template;    

}
function cm_redirect_users_by_role() {
 
    $current_user   = wp_get_current_user();
    $role_name      = $current_user->roles[0];
 
    if ( 'subscriber' === $role_name || 'contributor' === $role_name ) {
       wp_redirect( home_url()."/user/dashboard/" );
    } // if
 
} // cm_redirect_users_by_role
add_action( 'admin_init', 'cm_redirect_users_by_role' );
?>
