
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

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <span class='error-text'>
            <?php 
                if (!empty($errors)) {
                        foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                }
            ?>
            </span>

            <button type="submit">Register</button>
        </form>
        <h5>You already have an account ? <a href="<?= BASE_URL ?>/Auth/loginPage">Login<a></h5>
    </div>
</body>
</html>