<?php
/*@Cawoy Activation Hooks
 * When plugin is activated, crete two tables:
 * 1- ca_activity
 * 2- ca_follow_system
 * ca_ actitivy table holds the bookmarks posts ids
 * ca_follow_system holds the follow and unfollow system ids
 */
function UserActivityTable()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ca_activity";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      user_id mediumint(9) NOT NULL,
      post_id mediumint(9) NOT NULL,
      status varchar(50),
      time datetime DEFAULT current_timestamp() NOT NULL,
      PRIMARY KEY (id)
    )$charset_collate";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
     dbDelta( $sql );
    
}
register_activation_hook( __FILE__, 'UserActivityTable');
function UserFollowDB()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ca_follow_system";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      follower_id mediumint(9) NOT NULL,
      follow_id mediumint(9) NOT NULL,
      status varchar(50),
      time datetime DEFAULT current_timestamp() NOT NULL,
      PRIMARY KEY (id)
    )$charset_collate";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'UserFollowDB');
function FlushRewriteRules()
{
     flush_rewrite_rules();  
}
register_activation_hook( __FILE__, 'FlushRewriteRules');
?>
