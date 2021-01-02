<?php
/**
 * Template Name: Name of your template
 */
    global $current_user;
    wp_get_current_user();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $author_query = array('posts_per_page' => '6',
                          'author' => $current_user->ID,
                          'post_status' => array('draft'),
                          'paged' => $paged,
                          'order_by'=> 'date',
                          'order' => 'DESC' 
                         );

    $author_posts = new WP_Query($author_query);
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
                <h2>Draft</h2>
            </div>
            <?php if ( $author_posts->have_posts()) : ?>
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
                            <a href="<?php echo home_url().'/user/edit-post/'.get_the_ID(); ?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i> Edit Post</a>
                            <?php
                                if ( get_post_status () == 'publish' ): ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-info">Read More</a>
                            <?php endif; ?>
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
                <?php endwhile;?>
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
                    <h5 class="card-title">Create Your First Post</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="<?php echo home_url().'/user/add-new-post/'?>" class="btn btn-primary">Add Your First Post</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
