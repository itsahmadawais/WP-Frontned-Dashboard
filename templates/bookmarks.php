<?php
    global $current_user;
    global $wpdb;
    wp_get_current_user();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $table_name = $wpdb->prefix . "ca_activity";

    $sql="SELECT  post_id, status FROM $table_name  INNER JOIN $wpdb->prefix"."posts ON $wpdb->prefix"."posts.ID = $table_name.post_id WHERE $table_name.status='saved' AND $table_name.user_id = $current_user->ID";

    $resultsPosts = $wpdb->get_results($sql);
    $postIDs=array();
    foreach( $resultsPosts as $resultPost)
    {
        $postIDs[]=$resultPost->post_id;
    }
    $author_query = array(
                          'post__in' => $postIDs,
                          'post_status' => 'publish',
                          'paged' => $paged,
                          'orderby'=>'post__in'
                         );
    $author_posts = new WP_Query($author_query);
    wp_reset_postdata();
?>
<?php get_header(); ?>
<div class="container">
    <div class="row ca-user-dashboard">
        <!--Side Bar-->
        <?php include("partials/sidebar.php"); ?>
        <!--./Side Bar-->
        <div class="col-md-9 col-12 ca-main-content">
            <!--Post Buttons-->
            <?php include("partials/posts-btns.php"); ?>
            <!--./Post Buttons-->
            <div class="card-header">
                <h2>Bookmarked</h2>
            </div>
            <?php  if ( $author_posts->have_posts()) : ?>
            <div class="row ca-post-cards" id="ca-post-cards">
                <?php  while($author_posts->have_posts()) : $author_posts->the_post(); ?>
                <div class="col-6">
                    <div class="card"><?php $featured_img_url = get_the_post_thumbnail_url( get_the_ID(),'full');  ?>
                        <?php if($featured_img_url) : ?>
                        <img class="card-img" src="<?php echo $featured_img_url; ?>" alt="Bologna">
                        <?php else: ?>
                        <img class="card-img" src="<?php echo Cawoy_Frontend_DIR.'assets/images/post_snippet.png' ?>" alt="Bologna">
                        <?php endif; ?>
                        <div class="card-img-overlay">
                            <?php $categories = get_the_category(); ?>
                            <?php if ($categories): ?>
                            <?php foreach ($categories as $category){ ?>
                            <a href="#" class="btn btn-light btn-sm"><?php echo esc_html( $category->name ) ?></a>
                            <?php } endif ?>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php the_title();?></h4>
                            <small class="text-muted cat">
                                <?php if ( get_post_status () == 'publish' ): ?>
                                <i class="fa fa-eye text-info"></i> Published
                                <?php else: ?>
                                <i class="fa fa-eye"></i> Pending
                                <?php endif; ?>
                                <i class="fa fa-user text-info"></i> <?php echo esc_html( $current_user->display_name ) ?>
                            </small>
                            <br>
                            <a href="<?php the_permalink(); ?>" class="btn btn-info">Read More</a>
                        </div>
                        <div class="card-fooer ca-card-footer-post  text-muted d-flex justify-content-between bg-transparent border-top-0">
                            <div class="views"><?php  the_date("d/m/Y");    ?>
                            </div>
                            <div class="stats">
                                <i class="far fa-comment"></i> <?php echo get_comments_number(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="post-nav-container">
                <?php previous_posts_link( __('&rarr; Older Posts')); ?>
                <?php next_posts_link( __('Newer Posts &larr; ')); ?>
            </div>
            <?php wp_reset_query(); ?>
            <?php else : ?>
            <div class="card">
                <div class="card-header">
                    No Post found!
                </div>
                <div class="card-body">
                    <h5 class="card-title">No saved posts</h5>
                    <p class="card-text">You have not saved any post yet</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
