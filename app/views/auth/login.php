<?php ob_start(); ?>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title"><?= APP_NAME ?></h1>
            <p class="login-subtitle">Silakan login dengan NIS dan password Anda</p>
        </div>
        
        <form action="<?= baseUrl('auth/login') ?>" method="POST">
            <div class="form-group">
                <label for="nis" class="form-label">NIS</label>
                <input 
                    type="text" 
                    id="nis" 
                    name="nis" 
                    class="form-control" 
                    placeholder="Masukkan NIS"
                    required
                    autofocus
                >
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control" 
                    placeholder="Masukkan password"
                    required
                >
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                Masuk
            </button>
        </form>
        
        <div style="margin-top: 1.5rem; text-align: center; color: var(--text-secondary); font-size: 0.875rem;">
            <p>Demo Login: NIS: <strong>2024001</strong> | Password: <strong>password123</strong></p>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Login - ' . APP_NAME;
include __DIR__ . '/../layouts/main.php';
?>
