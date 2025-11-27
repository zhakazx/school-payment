<?php ob_start(); ?>

<div class="card">
    <div class="card-header flex justify-between align-center">
        <h2 class="card-title">Profil Siswa</h2>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; padding: var(--spacing-lg);">
        <div>
            <p style="color: var(--text-secondary); margin-bottom: 0.5rem;">NIS</p>
            <p style="font-size: 1.125rem; font-weight: 600;"><?= e($siswa['nis']) ?></p>
        </div>
        
        <div>
            <p style="color: var(--text-secondary); margin-bottom: 0.5rem;">Nama Lengkap</p>
            <p style="font-size: 1.125rem; font-weight: 600;"><?= e($siswa['nama_lengkap']) ?></p>
        </div>
        
        <div>
            <p style="color: var(--text-secondary); margin-bottom: 0.5rem;">Kelas</p>
            <p style="font-size: 1.125rem; font-weight: 600;"><?= e($siswa['nama_kelas']) ?></p>
        </div>
        
        <div>
            <p style="color: var(--text-secondary); margin-bottom: 0.5rem;">Kompetensi Keahlian</p>
            <p style="font-size: 1.125rem; font-weight: 600;"><?= e($siswa['kompetensi_keahlian']) ?></p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informasi</h3>
    </div>
    <p style="color: var(--text-secondary); padding: var(--spacing-lg);">
        Selamat datang di Sistem Pembayaran SPP. Anda dapat melihat dan mengelola data akademik Anda di sini.
    </p>
</div>

<?php
$content = ob_get_clean();
$title = 'Profil Siswa';
include __DIR__ . '/../layouts/main.php';
?>
