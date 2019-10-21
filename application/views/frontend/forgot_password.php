<body>
    <div class="home-topbar">
        <div class="brand-logo">
            <a href="<?php echo base_url();?>"><img src="<?php echo FRONTEND_THEME_URL; ?>img/logo.png"></a>
        </div>
        <div class="auth-btn-wrap">
            <ul>
                <li><a href="<?php echo base_url('signup')?>">Signup</a></li>
            </ul>
        </div>
    </div>
    <div class="login-page-wrap">
        <section class="banner">
            <div class="home-bg"></div>
            <div class="home-banner-content">
                <div class="left-img-wrap">
                    <img src="<?php echo FRONTEND_THEME_URL;?>img/baneer-left-img.png">
                </div>
                <div class="login-form">
                    <form action="" method="post">
                        <h2 class="text-center">Forgot Password!</h2>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                            <img src="<?php echo FRONTEND_THEME_URL;?>img/man-user.svg" width="22px">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                            <img src="<?php echo FRONTEND_THEME_URL;?>img/input-lock.svg" width="22px">
                        </div>
                        <p class="text-right"><a href="#">Lost your Password?</a></p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary white-btn">Log in</button>
                        </div>
                        <p class="text-center signup-link">Don't have an account? <a href="<?php echo base_url('signup');?>">Sign up here!</a></p>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>