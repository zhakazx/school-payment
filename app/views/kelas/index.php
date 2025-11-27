<?php ob_start(); ?>

<div class="card">
    <div class="card-header flex justify-between align-center">
        <h2 class="card-title">Daftar Kelas</h2>
        <a href="<?= baseUrl('kelas/create') ?>" class="btn btn-primary">Tambah Kelas</a>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Kelas</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Jumlah Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kelasList)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data kelas</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($kelasList as $kelas): ?>
                        <tr>
                            <td><?= e($kelas['nama_kelas']) ?></td>
                            <td><?= e($kelas['kompetensi_keahlian']) ?></td>
                            <td><?= $kelas['student_count'] ?? 0 ?> siswa</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= baseUrl('kelas/edit/' . $kelas['id_kelas']) ?>" class="btn btn-sm btn-secondary">Edit</a>
                                    <a href="<?= baseUrl('kelas/delete/' . $kelas['id_kelas']) ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</a>
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
$title = 'Daftar Kelas';
include __DIR__ . '/../layouts/main.php';
?>
