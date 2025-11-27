<aside class="sidebar">
    <div class="sidebar-header">
        <a href="<?= baseUrl('siswa/profile') ?>" class="sidebar-brand">
            <span class="brand-icon"><i class="fa-solid fa-graduation-cap"></i></span>
            <span class="brand-text"><?= APP_NAME ?></span>
        </a>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-category">Menu Utama</li>
            <li>
                <a href="<?= baseUrl('siswa/profile') ?>" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'siswa/profile') !== false ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="fa-solid fa-user"></i></span>
                    <span class="nav-text">Profil</span>
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('tahunajaran/index') ?>" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'tahunajaran') !== false ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="fa-solid fa-calendar"></i></span>
                    <span class="nav-text">Tahun Ajaran</span>
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('kelas/index') ?>" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'kelas') !== false ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="fa-solid fa-school"></i></span>
                    <span class="nav-text">Kelas</span>
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('siswa/index') ?>" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'siswa/') !== false && strpos($_SERVER['REQUEST_URI'], 'siswa/profile') === false) ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                    <span class="nav-text">Siswa</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">
                <?= strtoupper(substr($_SESSION['user_nama'] ?? 'U', 0, 1)) ?>
            </div>
            <div class="user-info">
                <span class="user-name"><?= e($_SESSION['user_nama'] ?? 'User') ?></span>
                <span class="user-role">Administrator</span>
            </div>
        </div>
        <a href="<?= baseUrl('auth/logout') ?>" class="btn-logout" title="Logout">
            <i class="fa-solid fa-right-from-bracket"></i>
        </a>
    </div>
</aside>
