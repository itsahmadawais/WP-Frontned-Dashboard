<?php get_header(); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5 ca-login-card">
                <div class="card-header bg-dark">
                    <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                    <?php global $customMessage;
                    if ( $customMessage ):
                       foreach ( $customMessage as $error ){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                        <strong>Warning!</strong> <?php echo $error ?>
                    </div>
                    <?php } endif; ?>
                    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" name="cawoy-custom-login">
                        <div class="form-group">
                            <label class="small mb-1" for="username">Username</label>
                            <input class="form-control" id="username" type="text" name="username" placeholder="Enter email address" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="password">Password</label>
                            <input class="form-control" id="password" type="password" name="password" placeholder="Enter password" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="rememberPasswordCheck" name="rememberPasswordCheck" type="checkbox" />
                                <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                            </div>
                        </div>
                        <input type="hidden" name="ca_login_nonce" value="<?php echo wp_create_nonce('ca-login-nonce'); ?>" />
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="<?php echo home_url().'/user/forget_password/' ?>">Forgot Password?</a>
                            <button type="submit" class="btn ca-login-btn" name="ca-loginuser">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-dark">
                    <div class="small"><a href="<?php echo home_url().'/user/register/' ?>">Need an account? Sign up!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
