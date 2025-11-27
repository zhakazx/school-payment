<?php ob_start(); ?>

<div class="card">
    <div class="card-header flex justify-between align-center">
        <h2 class="card-title">Daftar Siswa</h2>
        <a href="<?= baseUrl('siswa/create') ?>" class="btn btn-primary">Tambah Siswa</a>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Kompetensi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($siswaList)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data siswa</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($siswaList as $siswa): ?>
                        <tr>
                            <td><?= e($siswa['nis']) ?></td>
                            <td><?= e($siswa['nama_lengkap']) ?></td>
                            <td><?= e($siswa['nama_kelas']) ?></td>
                            <td><?= e($siswa['kompetensi_keahlian']) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= baseUrl('siswa/edit/' . $siswa['id_siswa']) ?>" class="btn btn-sm btn-secondary">Edit</a>
                                    <a href="<?= baseUrl('siswa/delete/' . $siswa['id_siswa']) ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Daftar Siswa';
include __DIR__ . '/../layouts/main.php';
?>
