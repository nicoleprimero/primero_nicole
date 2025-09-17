<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sofia’s Magic Users</title>
  <link rel="stylesheet" href="<?= base_url(); ?>/public/css/style.css">
</head>

<body>

<div class="top-actions">
  <!-- 🔮 Server-side search (stays on view_page) -->
  <form method="get" action="<?= site_url('users/view'); ?>">
  <input type="text" name="q" id="searchInput"
         value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
         placeholder="🔮 Search...">
  <button type="submit" >Search</button>
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
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= $user['id']; ?></td>
            <td><?= htmlspecialchars($user['username']); ?></td>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td><?= htmlspecialchars($user['role']); ?></td>
            <td>
              <a href="<?= site_url('users/update_User/'.$user['id']); ?>" class="btn btn-edit">Edit</a> | 
              <a href="<?= site_url('users/delete/'.$user['id']); ?>" 
                 onclick="return confirm('Are you sure you want to delete this user?');" 
                 class="btn btn-delete">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="no-users">No users found ✨</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<div class="pagination">
  <!-- ✅ Ensure pagination keeps ?q=... -->
  <?php if (isset($pagination_links)) : ?>
    <?= $pagination_links ?>
  <?php endif; ?>
</div>

<script>
const inputEl = document.getElementById("searchInput");
const table = document.querySelector(".magic-table tbody");
const searchBtn = document.getElementById("searchBtn"); // your search button

// Use 'input' event instead of 'keyup' to detect all changes
inputEl.addEventListener("input", filterTable);
searchBtn.addEventListener("click", filterTable);

function filterTable() {
    const filter = inputEl.value.toLowerCase();
    const rows = table.querySelectorAll("tr:not(.no-users)"); // ignore "no users" row
    let hasResults = false;

    // Filter rows
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(filter) && filter.length >= 3) {
            row.style.display = "";
            hasResults = true;
        } else {
            row.style.display = "none";
        }
    });

    // Remove old "no users found" row
    const oldNoUsers = table.querySelector(".no-users");
    if (oldNoUsers) oldNoUsers.remove();

    // Show "No users found" only if no match and filter >= 3 chars
    if (!hasResults && filter.length >= 3) {
        const tr = document.createElement("tr");
        tr.classList.add("no-users");
        const td = document.createElement("td");
        td.colSpan = table.rows[0].cells.length;
        td.textContent = "No users found ✨";
        td.style.textAlign = "center";
        tr.appendChild(td);
        table.appendChild(tr);
    }

    // If input < 3 chars, show all rows
    if (filter.length < 3) {
        rows.forEach(row => row.style.display = "");
    }
}
</script>






</body>
</html>
