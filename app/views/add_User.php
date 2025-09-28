<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Magic User</title>
    <link rel="stylesheet" href="<?=base_url();?>/public/css/style.css">
   
       
</head>
<body>
   
    <!-- Main Content -->
    <div class="main-content">
        <div class="center-box">
            <h1>✨ Add User</h1>
            <form action="<?=site_url('users/add_User');?>" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Email:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="" disabled selected>Choose role</option>
                        <option value="Admin">Admin</option>
                        <option value="Fairy Godmother">Fairy Godmother</option>
                        <option value="Fairy">Fairy</option>
                    </select>
                </div>
                <input type="submit" value="Add" class="submit-btn">
            </form>
            <a href="<?=site_url('users/account');?>" class="back-btn">← Go Back</a>
        </div>
    </div>
</body>
</html>
