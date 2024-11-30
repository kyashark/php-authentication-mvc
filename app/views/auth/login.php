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
        <form method="POST" action="<?= BASE_URL ?>/Auth/login">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" >

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <span class="error-text">
            <?php 
                if (!empty($errors)) {
                        foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                }
            ?>
            </span>

            <button type="submit">Login</button>
        </form>
        <h5>You didn't have an account ? <a href="<?= BASE_URL ?>/Auth/registerPage">Register<a></h5>
    </div>
</body>
</html>