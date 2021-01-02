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
            <div class="card">
                <div class="card-header">
                    <h2>Change Password</h2>
                </div>
                <div class="card-body">
                    <?php global $reg_errors;
                    if ( is_wp_error( $reg_errors )):
                       foreach ( $reg_errors->get_error_messages() as $error ){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Warning!</strong> <?php echo $error ?>
                    </div>
                    <?php } ?>
                    <?php endif; ?>
                    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" name="cawoy_update_password">
                        <div class="form-group row">
                            <label for="currpassword" class="col-sm-3 col-form-label">Current Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="currpassword" name="currpassword" placeholder="Current Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cpassword" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary" name="ca-update_password">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php get_footer(); ?>
