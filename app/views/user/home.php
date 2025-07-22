<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/home.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= $username ?>!</h1>
        <p>We're glad to have you here. Explore our features, check your profile, and more.</p>

        <div class="btn-tab">
    <?php if (Session::hasRole('editor')): ?>
        <button class="home-btn edit-btn">Editor Action</button>
    <?php else: ?>
        <button class="home-btn edit-btn" disabled title="Editor only">Editor Action (Disabled)</button>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/Auth/logout">
        <button type="submit" class="home-btn">Logout</button>
    </form>
</div>


    </div>
</body>
</html>
