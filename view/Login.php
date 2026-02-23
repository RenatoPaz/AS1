<?php
// view/Login.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

  <div class="container">
    <h1>Login</h1>

    <?php if (!empty($_SESSION["error"])): ?>
      <p class="msg error"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
    <?php endif; ?>

    <?php if (!empty($_SESSION["success"])): ?>
      <p class="msg success"><?php echo $_SESSION["success"]; unset($_SESSION["success"]); ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php">
      <label>Email</label>
      <input type="email" name="email" required />

      <label>Password</label>
      <input type="password" name="password" required />

      <button type="submit">Login</button>
    </form>

    <p>
      Don’t have an account?
      <a href="index.php?action=register">Register</a>
    </p>
  </div>

</body>
</html>