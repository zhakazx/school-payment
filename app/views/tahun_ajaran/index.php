<?php ob_start(); ?>

<div class="card">
    <div class="card-header flex justify-between align-center">
        <h2 class="card-title">Daftar Tahun Ajaran</h2>
        <a href="<?= baseUrl('tahunajaran/create') ?>" class="btn btn-primary">Tambah Tahun Ajaran</a>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tahunAjaranList)): ?>
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data tahun ajaran</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tahunAjaranList as $tahun): ?>
                        <tr>
                            <td><?= e($tahun['periode']) ?></td>
                            <td>
                                <?php if ($tahun['status'] === 'aktif'): ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Non-Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <?php if ($tahun['status'] !== 'aktif'): ?>
                                        <a href="<?= baseUrl('tahunajaran/setActive/' . $tahun['id_tahun_ajaran']) ?>" 
                                           class="btn btn-sm btn-success"
                                           onclick="return confirm('Aktifkan tahun ajaran ini?')">Aktifkan</a>
                                    <?php endif; ?>
                                    <a href="<?= baseUrl('tahunajaran/edit/' . $tahun['id_tahun_ajaran']) ?>" class="btn btn-sm btn-secondary">Edit</a>
                                    <a href="<?= baseUrl('tahunajaran/delete/' . $tahun['id_tahun_ajaran']) ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus tahun ajaran ini?')">Hapus</a>
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
$title = 'Daftar Tahun Ajaran';
include __DIR__ . '/../layouts/main.php';
?>
