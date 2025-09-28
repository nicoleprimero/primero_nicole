<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sofia’s Magic Users</title>
  <link rel="stylesheet" href="<?= base_url(); ?>/public/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>


<div class="top-actions">
  <!-- 🔮 Server-side search (stays on view_page) -->
	<form action="<?=site_url('users/account');?>" method="get" class="col-sm-4 float-end d-flex">
		<?php
		$q = '';
		if(isset($_GET['q'])) {
			$q = $_GET['q'];
		}
		?>
        <input class="form-control me-2" name="q" type="text" 
            placeholder="🔮 Search..." id="searchInput" value="<?=html_escape($q);?>">
        <button type="submit" class="btn btn-primary" type="button">Search</button>
	</form>





  <a href="<?= site_url('users/add_User'); ?>" class="btn btn-add">+ Add User</a>
</div>

<div class="table-container">
  <table class="magic-table" id="magic-table">
    <thead>
      <tr>
        <th><img class="wand" src="<?= base_url(); ?>/public/images/wand.png"> ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach (html_escape($all) as $user): ?>
          <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['username']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['role']; ?></td>
            <td><?= $user['created_at']; ?></td>
            <td><?= $user['updated_at']; ?></td>
            <td>
              <a href="<?= site_url('users/update_User/'.$user['id']); ?>" class="btn btn-edit">Edit</a> | 
              <a href="<?= site_url('users/delete/'.$user['id']); ?>" 
                 onclick="return confirm('Are you sure you want to delete this user?');" 
                 class="btn btn-delete">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      
    </tbody>
  </table>
  	<?php
	echo $page;?>
</div>


</body>
</html>  