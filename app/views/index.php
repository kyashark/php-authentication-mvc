
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/home.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Authentication</h1>
        <p>We're glad to have you here. Explore our features, check your profile, and more.</p>
        <div class="btn-tab">
        <form method="POST" action="<?= BASE_URL ?>/Auth/loginPage" style="margin-top: 20px;">
            <button type="submit" class="home-btn">Login</button>
        </form>
        <form method="POST" action="<?= BASE_URL ?>/Auth/registerPage" style="margin-top: 20px;">
            <button type="submit" class="home-btn">Register</button>
        </form>
    </div>
    </div>
</body>
</html>