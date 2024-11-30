
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
        <h1>Welcome to Admin Dashboard, <?= $username ?>!</h1>
        <p>We're glad to have you here. Explore our features, check your profile, and more.</p>
        <form method="POST" action="<?= BASE_URL ?>/Auth/logout" style="margin-top: 20px;">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>