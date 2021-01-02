<?php
/*@Cawoy Post Save System
 * This script manages the follow and unfollow part of the system.
 */
function property_slideshow( $content ) {
    if ( is_single()) {
        global $current_user;
        wp_get_current_user();
        $custom_content="";
        
        $custom_content = "<button>Button</button>";
        $custom_content .= $content;
        return $custom_content;
    } else {
        return $content;
    }
}
add_filter( 'the_content', 'property_slideshow' );
?>
