<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SPP Payment System' ?></title>
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d3075a2270.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php if (isLoggedIn()): ?>
        <div class="app-container">
            <?php include __DIR__ . '/sidebar.php'; ?>
            
            <div class="main-wrapper">
                <main class="main-content">
                    <div class="container">
                        <?php
                        // Display flash messages
                        $flash = getFlash('success') ?? getFlash('error') ?? getFlash('info') ?? getFlash('warning') ?? 
                                 getFlash('login_success') ?? getFlash('login_error') ?? getFlash('logout_success');
                        
                        if ($flash):
                        ?>
                            <div class="alert alert-<?= $flash['type'] ?>">
                                <?= e($flash['message']) ?>
                            </div>
                        <?php endif; ?>
                        
                        <?= $content ?? '' ?>
                    </div>
                </main>
            </div>
        </div>
    <?php else: ?>
        <main class="login-page">
            <?php
            // Display flash messages for login page
            $flash = getFlash('success') ?? getFlash('error') ?? getFlash('info') ?? getFlash('warning') ?? 
                     getFlash('login_success') ?? getFlash('login_error') ?? getFlash('logout_success');
            
            if ($flash):
            ?>
                <div style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 1000; width: 90%; max-width: 400px;">
                    <div class="alert alert-<?= $flash['type'] ?>">
                        <?= e($flash['message']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <?= $content ?? '' ?>
        </main>
    <?php endif; ?>
</body>
</html>
