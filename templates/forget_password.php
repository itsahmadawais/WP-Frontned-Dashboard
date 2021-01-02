<?php get_header(); ?>
<?php
        global $wpdb;
        
        $error = '';
        $success = '';
        $msg = '';
        
        // check if we're in reset form
        if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] ) 
        {
            $email = trim($_POST['user_login']);
            
            if( empty( $email ) ) {
                $error = 'Enter a username or e-mail address..';
            } else if( ! is_email( $email )) {
                $error = 'Invalid username or e-mail address.';
            } else if( ! email_exists( $email ) ) {
                $error = 'There is no user registered with that email address.';
            } else {
                
                $random_password = wp_generate_password( 12, false );
                $user = get_user_by( 'email', $email );
                
                $update_user = wp_update_user( array (
                        'ID' => $user->ID, 
                        'user_pass' => $random_password
                    )
                );
                
                // if  update user return true then lets send user an email containing the new password
                if( $update_user ) {
                    $to = $email;
                    $subject = 'Your new password';
                    $sender = get_option('name');
                    
                    $message = 'Your new password is: '.$random_password;
                    
                    $headers[] = 'MIME-Version: 1.0' . "\r\n";
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers[] = "X-Mailer: PHP \r\n";
                    $headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";
                    
                    $mail = wp_mail( $to, $subject, $message, $headers );
                    if( $mail )
                        $success = 'Check your email address for you new password.';
                        
                } else {
                    $error = 'Oops something went wrong updaing your account.';
                }
                
            }
            
            if( ! empty( $error ) )
                $msg = '<div class="message"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';
            
            if( ! empty( $success ) )
                $msg = '<div class="error_login"><p class="success">'. $success .'</p></div>';
        }
    ?>

<div class="container-fluid bg-primary">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg mt-5 ca-login-card">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Forget Password</h3>
                </div>
                <div class="card-body">
                    <p>If you forgot your password, no worries. Enter your email address and we will send you a linnk to pick a new password.</p>
                    <?php 
                    if($msg)
                        echo $msg;
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <?php $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : ''; ?>
                            <label class="small mb-1" for="email">Enter Your Email</label>
                            <input class="form-control" type="email" name="user_login" id="user_login" value="<?php echo $user_login; ?>" />
                        </div>
                        <input type="hidden" name="action" value="reset" />
                        <div class="form-group text-right">
                            <button type="submit" class="btn ca-login-btn" id="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
