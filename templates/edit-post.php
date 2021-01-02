<?php
$currentPost = get_query_var('postID');
$nPost = get_post($currentPost); 
?>
<?php get_header(); ?>
<div class="container">
    <div class="row ca-user-dashboard">
        <!--Side Bar-->
        <?php include("partials/sidebar.php"); ?>
        <!--./Side Bar-->
        <div class="col-md-9 col-12 ca-main-content">
            <div id="ca-new-post-card" class="card ca-new-post-card">
                <div class="card-header">
                    <h2>Update Post</h2>
                </div>
                <div class="card-body">
                    <form id="postForm" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="postTitle">Title</label>
                            <input type="text" class="form-control" id="postTitle" name="postTitle" placeholder="Add Title" value="<?php echo $nPost->post_title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="postCategory">Select Category</label>
                            <select class="form-control" id="postCategory" name="postCategory">
                                <option value=""> -- Select Category -- </option>
                                <?php
                                   $categories = get_the_category();
                                    $catList = get_categories();
                                    foreach($catList as $listval)
                                    {
                                        $selected="";
                                        if(in_array($listval,$categories))
                                        {
                                            $selected="selected";
                                        }
                                        echo '<option value="'.$listval->term_id.'"'.$selected.'>'.$listval->name.'</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="featuredimgfile" name="featuredimgfile" onchange="preview_image(event)" accept="image/*">
                                    <label class="custom-file-label" for="featuredimgfile">Choose Featured Image</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <?php $featured_img_url = get_the_post_thumbnail_url( $nPost->ID,'full');  ?>
                                    <?php if($featured_img_url ): ?>
                                    <img id="cafeaturedimg" class="card-img-top" src="<?php echo $featured_img_url  ?>" alt="Card image">
                                    <?php else: ?>
                                    <img id="cafeaturedimg" class="card-img-top" src="<?php echo Cawoy_Frontend_DIR.'assets/images/post_snippet.png' ?>" alt="Card image cap">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div><?php
                        $content   = $nPost->post_content;
                        $editor_id = 'postContent';
                        wp_editor( $content, $editor_id );
                        ?>
                        <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
                        <input type="hidden" value="<?php echo $nPost->ID; ?>" id="postID" name="postID">
                        <?php
                        $nPost_tags = wp_get_post_tags($nPost->ID);
                        $tags=array();
                        if ( $nPost_tags ) {
                            foreach( $nPost_tags as $tag ) {
                                $tags[] = $tag->name; 
                            }
                        }
                        $tagStr=implode(",",$tags);
                        ?>
                        <div class="form-group">
                            <label for="postTags">Tags</label>
                            <input type="text" class="form-control" id="postTags" name="postTags" placeholder="Add tags each seperated by comma  e.g tag 1, tag 2" value="<?php echo $tagStr; ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <a class="btn btn-danger" href="<?php echo get_preview_post_link($nPost->ID); ?>" target="_blank">Preview</a>
                                <button type="submit" class="btn btn-success" name="ca_update_saved_draft" id="ca_update_saved_draft">Save as Draft</button>
                                <button type="submit" class="btn btn-primary" name="ca-update-post" id="ca-update-post">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                function preview_image(event) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        var output = document.getElementById('cafeaturedimg');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }

            </script>
        </div>
    </div>
</div>
<?php get_footer(); ?>
