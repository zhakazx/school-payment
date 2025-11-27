<header class="header">
    <nav class="navbar">
        <a href="<?= baseUrl('siswa/profile') ?>" class="navbar-brand">
            <?= APP_NAME ?>
        </a>
        
        <ul class="navbar-menu">
            <li><a href="<?= baseUrl('siswa/profile') ?>">Profil</a></li>
            <li><a href="<?= baseUrl('tahunajaran/index') ?>">Tahun Ajaran</a></li>
            <li><a href="<?= baseUrl('kelas/index') ?>">Kelas</a></li>
            <li><a href="<?= baseUrl('siswa/index') ?>">Siswa</a></li>
            
            <li class="user-info">
                <span>Halo, <strong><?= e($_SESSION['user_nama'] ?? 'User') ?></strong></span>
                <a href="<?= baseUrl('auth/logout') ?>" class="btn btn-sm btn-danger">Logout</a>
            </li>
        </ul>
    </nav>
</header>
