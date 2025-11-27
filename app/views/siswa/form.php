<?php 
$isEdit = isset($isEdit) && $isEdit;
$pageTitle = $isEdit ? 'Edit Siswa' : 'Tambah Siswa';
ob_start(); 
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><?= $pageTitle ?></h2>
    </div>
    
    <form action="<?= $isEdit ? baseUrl('siswa/edit/' . $data['id_siswa']) : baseUrl('siswa/create') ?>" method="POST" class="form-card">
        <div class="form-group">
            <label for="nis" class="form-label">NIS</label>
            <input 
                type="text" 
                id="nis" 
                name="nis" 
                class="form-control" 
                value="<?= e($data['nis'] ?? '') ?>"
                required
            >
        </div>
        
        <div class="form-group">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input 
                type="text" 
                id="nama_lengkap" 
                name="nama_lengkap" 
                class="form-control" 
                value="<?= e($data['nama_lengkap'] ?? '') ?>"
                required
            >
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">Password <?= $isEdit ? '(Kosongkan jika tidak ingin mengubah)' : '' ?></label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control"
                <?= !$isEdit ? 'required' : '' ?>
            >
        </div>
        
        <div class="form-group">
            <label for="id_kelas" class="form-label">Kelas</label>
            <select id="id_kelas" name="id_kelas" class="form-select" required>
                <option value="">Pilih Kelas</option>
                <?php foreach ($kelasList as $kelas): ?>
                    <option value="<?= $kelas['id_kelas'] ?>" 
                        <?= (isset($data['id_kelas']) && $data['id_kelas'] == $kelas['id_kelas']) ? 'selected' : '' ?>>
                        <?= e($kelas['nama_kelas']) ?> - <?= e($kelas['kompetensi_keahlian']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= baseUrl('siswa/index') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
$title = $pageTitle;
include __DIR__ . '/../layouts/main.php';
?>
