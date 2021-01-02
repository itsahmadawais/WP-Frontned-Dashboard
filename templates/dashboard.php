<?php 
$current_user = wp_get_current_user();
?>
<?php get_header(); ?>
<div class="container">
    <div class="row ca-user-dashboard">
        <!--Side Bar-->
        <?php include("partials/sidebar.php"); ?>
        <!--./Side Bar-->
        <div class="col-md-9 col-12 ca-main-content">
            <div id="ca-profile-edit-card" class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>Accuont Information</h2>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="<?php echo home_url().'/user/edit-profile/'?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="ca-user-profile-photo">
                                <?php 
                                    /*
                                    *  Note: Image Comes from wp_kljt_user_avatar Plugin.
                                    */
                                ?>
                                <?php if(isset($current_user->wp_kljt_user_avatar)): ?>
                                <img src="<?php echo wp_get_attachment_url($current_user->wp_kljt_user_avatar) ?>" id="userPhoto">
                                <?php else: ?>
                                <img src="<?php echo Cawoy_Frontend_DIR.'assets/images/post_snippet.png' ?>" id="userPhoto">
                                <?php endif ?>
                                <div class="ca-profilpic-overlay" id="userPhotoOverlay">
                                    <i class="fas fa-camera"></i>
                                    <span>Change Photo</span>
                                </div>
                            </div>
                            <script>
                                var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>"

                            </script>
                            <form id="profilePhotoForm" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">
                                <input type="file" id="newUserPhotoFile" name="newUserPhotoFile" style="display:none;">
                                <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
                                <!-- <input class="save-support" name="save_userPhoto" type="button" value="Save"> -->
                            </form>
                        </div>
                        <div class="col-md-9">
                            <h3><?php echo esc_html( $current_user->user_firstname )." ".esc_html( $current_user->user_lastname )?></h3>
                            <div class="ca-user-meta-info">
                                <div class="ca-meta-company">
                                    <p><span>Company:</span> <?php echo esc_html( $current_user->company_title) ?></p>
                                </div>
                                <div class="ca-meta-job">
                                    <p><span>Job Title:</span> <?php echo esc_html( $current_user->job_title) ?></p>
                                </div>
                            </div>
                            <div class="ca-user-follow-meta-info">
                                <div class="ca-user-following text-center">
                                    <h2><?php echo cawoy_following_count(); ?></h2>
                                    <p>Following</p>
                                </div>
                                <div class="text-center">
                                    <h2><?php echo cawoy_follow_count(); ?></h2>
                                    <p>Follower</p>
                                </div>
                            </div>
                            <ul class="ca-social-links-list">
                                
                                <?php if($current_user->facebook):?>
                                <li class="ca-facebook-icon"><a href="<?php echo $current_user->facebook; ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <?php endif; ?>
                                
                                <?php if($current_user->twitter):?>
                                <li class="ca-twitter-icon"><a href="<?php echo $current_user->twitter; ?>"><i class="fab fa-twitter"></i></a></li>
                                <?php endif; ?>
                                
                                <?php if($current_user->linkedin):?>
                                <li class="ca-linkedin-icon"><a href="<?php echo $current_user->linkedin; ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                <?php endif; ?>
                                
                                <?php if($current_user->instagram):?>
                                <li class="ca-instagram-icon"><a href="<?php echo $current_user->instagram; ?>"><i class="fab fa-instagram"></i></a></li>
                                <?php endif; ?>
                                
                                <?php if($current_user->googleplus):?>
                                <li class="ca-googleplus-icon"><a href="<?php echo $current_user->googleplus; ?>"><i class="fab fa-google-plus-g"></i></a></li>
                                <?php endif; ?>
                                
                                <?php if($current_user->youtube):?>
                                <li class="ca-youtube-icon"><a href="<?php echo $current_user->youtube; ?>"><i class="fab fa-youtube"></i></a></li>
                                <?php endif; ?>
                                
                            </ul>
                            <div class="ca-user-about">
                                <h2>About</h2>
                                <p><?php echo esc_html( $current_user->description ) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    (function($) {
        $(document).ready(function() {
            $('#userPhotoOverlay').click(function() {
                $("#newUserPhotoFile").click();
            });
            $('#newUserPhotoFile').change(function() {
                $('#profilePhotoForm').submit();
            });
        });
    }(jQuery));

</script>
<?php get_footer(); ?>
