<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <title>Register Form</title>
</head>
<body>
    <div class="login-container">
        <h3>Register Form</h3>
        <form method="POST" action="<?= BASE_URL ?>/Auth/register">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
            <span class="error-msg">
                <?php echo $errors['username'] ?? ''; ?>
            </span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
            <span class="error-msg">
                <?php echo $errors['email'] ?? ''; ?>
            </span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <span class="error-msg">
                <?php echo $errors['password'] ?? ''; ?>
            </span>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <span class="error-msg">
                <?php echo $errors['confirm-password'] ?? ''; ?>
            </span>

            <p class="error-msg">
                <?php echo $errors['credentials'] ?? ''; ?>
            </p>

            <button type="submit">Register</button>
        </form>
        <h5>You already have an account ? <a href="<?= BASE_URL ?>/Auth/loginPage">Login<a></h5>
    </div>

    <script src="<?= BASE_URL ?>/js/script.js"></script>
</body>
</html>