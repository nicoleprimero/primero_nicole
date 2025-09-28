<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>✨ Register</title>
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="<?=base_url();?>public/css/main.css" rel="stylesheet">
    <link href="<?=base_url();?>public/css/style.css" rel="stylesheet">
    <link href="<?=base_url();?>public/css/style2.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    

    <!-- Main Content -->
    <div class="main-content">
        <div class="center-box">
            <h1>🌟 Register</h1>

            <?php flash_alert(); ?>
            <form id="regForm" method="POST" action="<?=site_url('auth/register');?>">

                <?php csrf_field(); ?>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input id="username" type="text" class="form-control" 
                           name="username" required minlength="5" maxlength="20">
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input id="email" type="email" class="form-control" 
                           name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" class="form-control" 
                           name="password" minlength="8" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input id="password_confirmation" type="password" class="form-control" 
                           name="password_confirmation" minlength="8" required>
                </div>

                <input type="submit" value="Register" class="submit-btn">

                <!-- Navigation between register/login -->
                <div class="form-links">
                    <p>Already have an account? 
                        <a href="<?=site_url('auth/login');?>">Login here</a>
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
            var regForm = $("#regForm");
            if(regForm.length) {
                regForm.validate({
                    rules: {
                        email: { required: true },
                        password: { required: true, minlength: 8 },
                        password_confirmation: { required: true, minlength: 8 },
                        username: { required: true, minlength: 5, maxlength: 20 }
                    },
                    messages: {
                        email: { required: "Please input your email address." },
                        password: { 
                            required: "Please input your password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        },
                        password_confirmation: { 
                            required: "Please confirm your password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        },
                        username: { required: "Please input your username." }
                    }
                })
            }
        })
    </script>
</body>
</html>
