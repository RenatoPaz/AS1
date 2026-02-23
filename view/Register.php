<?php
// view/Register.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

  <div class="container">
    <h1>Register</h1>

    <?php if (!empty($_SESSION["error"])): ?>
      <p class="msg error"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?action=register">
      <label>Username</label>
      <input type="text" name="username" required />

      <label>Email</label>
      <input type="email" name="email" required />

      <label>Password</label>
      <input type="password" name="password" required />

      <button type="submit">Create Account</button>
    </form>

    <p>
      Already have an account?
      <a href="index.php">Back to Login</a>
    </p>
  </div>

</body>
</html>