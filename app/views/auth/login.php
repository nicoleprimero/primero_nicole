<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>✨ Login</title>  
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="<?=base_url();?>public/css/main.css" rel="stylesheet">
    <link href="<?=base_url();?>public/css/style.css" rel="stylesheet">
    <link href="<?=base_url();?>public/css/style2.css" rel="stylesheet">
</head>
<body>
    

    <!-- Main Content -->
    <div class="main-content">
        <div class="center-box">
            <h1>🔮 Login</h1>

            <?php flash_alert(); ?>
            <form id="logForm" method="POST" action="<?=site_url('auth/login');?>">

                <?php csrf_field(); ?>
                <?php $LAVA =& lava_instance(); ?>

                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input id="email" type="email" 
                           class="form-control <?=$LAVA->session->flashdata('is_invalid');?>"
                           name="email" value="" required autocomplete="email" autofocus>
                    <span class="invalid-feedback" role="alert">
                        <strong><?= $LAVA->session->flashdata('err_message'); ?></strong>
                    </span>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" class="form-control" 
                           name="password" minlength="8" required autocomplete="current-password">
                </div>

                <input type="submit" value="Login" class="submit-btn">

                <div class="form-links">
                    <a href="<?=site_url('auth/password-reset');?>">Forgot Your Password?</a>
                </div>

                <!-- Navigation between login/register -->
                <div class="form-links">
                    <p>Don’t have an account? 
                        <a href="<?=site_url('auth/register');?>">Register here</a>
                    </p>
                </div>
            </form>

            <a href="<?=site_url('/');?>" class="back-btn">← Go Back</a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var logForm = $("#logForm");
            if(logForm.length) {
                logForm.validate({
                    rules: {
                        email: { required: true },
                        password: { required: true }
                    },
                    messages: {
                        email: { required: "Please input your email address." },
                        password: { required: "Please input your password." }
                    }
                })
            }
        })
    </script>
</body>
</html>
