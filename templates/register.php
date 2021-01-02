<?php get_header(); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-12">
            <div class="card shadow-lg border-0 rounded-lg mt-5 ca-login-card">
                <div class="card-header bg-dark ">
                    <h3 class="text-center font-weight-light my-4">Register</h3>
                </div>
                <div class="card-body">
                    <?php global $reg_errors;
                    if ( is_wp_error( $reg_errors ) ):
                       foreach ( $reg_errors->get_error_messages() as $error ){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                        <strong>Warning!</strong> <?php echo $error ?>
                    </div>
                    <?php } endif; ?>
                    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" name="cawoy-custom-registration">
                        <div class="form-group">
                            <label class="small mb-1" for="username">Username</label>
                            <input class="form-control" id="username" type="text" name="username" placeholder="Enter Username" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" placeholder="Enter email address" />
                        </div>
                        <div class="form-group">
                            <label for="role">I want to be a </label>
                            <select class="form-control" id="role" name="role">
                                <option value="subscriber">Subscriber</option>
                                <option value="contributor">Contributor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="password">Password</label>
                            <input class="form-control" id="password" type="password" name="password" placeholder="Enter password" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="cpassword">Confirm Password</label>
                            <input class="form-control" id="cpassword" type="password" name="cpassword" placeholder="Confirm password" />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn ca-login-btn" name="register_account">Sign up</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-dark">
                    <div class="small"><a href="?pg=login">Already have an account?</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
