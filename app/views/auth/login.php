<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <title>Login Form</title>
</head>
<body>
    <div class="login-container">
        <h3>Login Form</h3>
        <form method="POST" action="<?= BASE_URL ?>/Auth/login" id="login-form">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" >
            <span class="error-msg" id="username-error">
                <?php echo $errors['username'] ?? ''; ?>
            </span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <span class="error-msg" id="password-error">
                <?php echo $errors['password'] ?? ''; ?>
            </span>

            <span class="error-msg" id="credentials-error">
                <?php echo $errors['credentials'] ?? ''; ?>
            </span>

            <button type="submit" id="">Login</button>
        </form>
        <h5>You didn't have an account ? <a href="<?= BASE_URL ?>/Auth/registerPage">Register<a></h5>
    </div>

    <script src="<?= BASE_URL ?>/js/script.js"></script>
</body>
</html>