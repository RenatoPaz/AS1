<?php
// view/Main.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Students</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

  <div class="container">
    <div class="topbar">
      <h1>Students</h1>
      <div>
        <span class="hello">Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
        <a class="logout" href="index.php?action=logout">Logout</a>
      </div>
    </div>

    <?php if (!empty($_SESSION["error"])): ?>
      <p class="msg error"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
    <?php endif; ?>

    <?php if (!empty($_SESSION["success"])): ?>
      <p class="msg success"><?php echo $_SESSION["success"]; unset($_SESSION["success"]); ?></p>
    <?php endif; ?>

    <h2>Add Student</h2>
    <form method="POST" action="index.php?action=createStudent">
      <label>Student Name</label>
      <input type="text" name="student_name" required />

      <label>Student ID</label>
      <input type="text" name="student_id" required />

      <label>Email</label>
      <input type="email" name="email" required />

      <button type="submit">Add Student</button>
    </form>

    <h2>All Students</h2>

    <?php if (empty($students)): ?>
      <p>No students yet.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($students as $s): ?>
            <tr>
              <td><?php echo htmlspecialchars($s["student_name"]); ?></td>
              <td><?php echo htmlspecialchars($s["student_id"]); ?></td>
              <td><?php echo htmlspecialchars($s["email"]); ?></td>
              <td>
                <a class="danger"
                   href="index.php?action=deleteStudent&id=<?php echo (int)$s["id"]; ?>"
                   onclick="return confirm('Delete this student?');">
                  Delete
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

</body>
</html>