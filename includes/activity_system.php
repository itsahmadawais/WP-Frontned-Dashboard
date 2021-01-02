<?php
/*@Cawoy Post Save System
 * This script manages how you can bookmark posts and store into the database.
 */
function property_slideshow( $content ) {
    if ( is_single() && !is_author()){
        $custom_content="";
        global $current_user,$post;
        wp_get_current_user();
        
        $have_saved=PostSavedUnsavedCounter($current_user->ID,get_the_ID(),'saved');
        $result="<div class='ca-user-div'>";
        if(is_user_logged_in()){
        $result  = $result ."<div class='ca-activity-btn'>";
        if($current_user->ID!=get_the_author_ID() && $have_saved==0)
            $result  = $result . '<button onclick="ca_save_post_ajax('.$current_user->ID.','.get_the_ID().')">Save</button>';
        else if($current_user->ID!=get_the_author_ID())
            $result  = $result . '<button onclick="ca_unsave_post_ajax('.$current_user->ID.','.get_the_ID().')">Unsave</button>';
        $result  = $result ."</div>";
        }
        $result  = $result ."</div>";
        $custom_content=$result;
        $custom_content .= $content;
        return $custom_content;
    } else {
        return $content;
    }
}
add_filter( 'the_content', 'property_slideshow' );


function ca_save_post_ajax_action()
{
    global $wpdb;
    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
    $table_name=$wpdb->prefix. "ca_activity";
    if(isset($_POST['pid']) && isset($_POST['uid']))
    {
        $have_unsaved=PostSavedUnsavedCounter($_POST['uid'],$_POST['pid'],'unsaved');
        if($have_unsaved>0)
        {
            $result=$wpdb->update(
            $table_name,
            array(
            'status'=>'saved'
            ),
            array(
            'post_id'=>$_POST['pid'],
            'user_id'=>$_POST['uid'],
            )
        );
        if($result)
            echo "1";
        else
            echo "0";
        }
        else if($have_unsaved==0)
        {
            $wpdb->insert(
            $table_name,
            array(
            'post_id'=>$_POST['pid'],
            'user_id'=>$_POST['uid'],
            'status'=>'saved'
            ),
            array(
            '%d',
            '%d',
            '%s'
            )
        );
        if($wpdb->insert_id)
            echo "1";
        else
            echo "0";
        }
    }
    wp_die();
}
add_action("wp_ajax_ca_save_post_ajax_action","ca_save_post_ajax_action");

function my_must_login() {
   echo "You must log in to vote";
   die();
}
add_action("wp_ajax_nopriv_my_user_vote", "my_must_login");


function ca_unsave_post_ajax_action()
{
    global $wpdb;
    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
    $table_name=$wpdb->prefix. "ca_activity";
    if(isset($_POST['pid']) && isset($_POST['uid']))
    {
        $result=$wpdb->update(
            $table_name,
            array(
            'status'=>'unsaved'
            ),
            array(
            'post_id'=>$_POST['pid'],
            'user_id'=>$_POST['uid'],
            )
        );
        if($result)
            echo "1";
        else
            echo "0";
    }
    wp_die();
}
add_action("wp_ajax_ca_unsave_post_ajax_action","ca_unsave_post_ajax_action");


?>
