<?php get_header(); ?>

<?php
    global $current_user;
    wp_get_current_user();
?>
<div class="container">
    <div class="row ca-user-dashboard">
        <!--Side Bar-->
        <?php include("partials/sidebar.php"); ?>
        <!--./Side Bar-->
        <div class="col-md-9 col-12 ca-main-content">
            <div id="ca-profile-edit-card" class="card">
                <div class="card-header">
                    <h2>Profile Info</h2>
                </div>
                <div class="card-body">
                    <form id="postForm" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $current_user->first_name; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $current_user->last_name; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="job_title">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title" value="<?php echo $current_user->job_title; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?php echo $current_user->company_title; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="website_url">Website URL</label>
                                <input type="text" class="form-control" id="website_url" name="website_url" placeholder="Website URL" value="<?php echo $current_user->user_url; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $current_user->user_email; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea class="form-control" id="about" name="about" rows="5"><?php echo esc_html($current_user->description); ?></textarea>
                        </div>
                        <div class="mb-4">
                            <h6 class=" text-uppercase">Social Media <i class="fas fa-hashtag"></i></h6>
                            <!-- Dashed divider -->
                            <hr class="dashed">
                        </div>
                        <div class="form-row ca-social-links">
                            <div class="form-group col-md-6 ca-facebook-icon">
                                <label for="facebook"><i class="fab fa-facebook-f"></i> Facebook URL</label>
                                <input type="url" class="form-control" id="facebook" name="facebook" placeholder="e.g. http://facebook.com/" value="<?php echo $current_user->facebook; ?>">
                            </div>
                            <div class="form-group col-md-6 ca-twitter-icon">
                                <label for="twitter"><i class="fab fa-twitter"></i> Twitter URL</label>
                                <input type="url" class="form-control" id="twitter" name="twitter" placeholder="e.g. http://twitter.com/" value="<?php echo $current_user->twitter; ?>">
                            </div>
                        </div>
                        <div class="form-row ca-social-links">
                            <div class="form-group col-md-6 ca-linkedin-icon">
                                <label for="linkedin"><i class="fab fa-linkedin-in"></i> LinkedIn URL</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="e.g. http://linkedin.com/" value="<?php echo $current_user->linkedin; ?>">
                            </div>
                            <div class="form-group col-md-6 ca-youtube-icon ">
                                <label for="youtube"><i class="fab fa-youtube"></i> Youtube URL</label>
                                <input type="url" class="form-control" id="youtube" name="youtube" placeholder="e.g. http://youtube.com/" value="<?php echo $current_user->youtube; ?>">
                            </div>
                        </div>
                        <div class="form-row ca-social-links">
                            <div class="form-group col-md-6 ca-instagram-icon ">
                                <label for="instagram"><i class="fab fa-instagram"></i> Instagram URL</label>
                                <input type="url" class="form-control" id="instagram" name="instagram" placeholder="e.g. http://instagram.com/" value="<?php echo $current_user->instagram; ?>" >
                            </div>
                            <div class="form-group col-md-6 ca-googleplus-icon">
                                <label for="googleplus"><i class="fab fa-google-plus-g"></i> GooglePlus URL</label>
                                <input type="url" class="form-control" id="googleplus" name="googleplus" placeholder="e.g. http://googleplus.com/" value="<?php echo $current_user->googleplus; ?>" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary" name="ca-update-info" id="ca-update-info">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<?php get_footer(); ?>
