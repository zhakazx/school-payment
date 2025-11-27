<?php 
$isEdit = isset($isEdit) && $isEdit;
$pageTitle = $isEdit ? 'Edit Kelas' : 'Tambah Kelas';
ob_start(); 
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><?= $pageTitle ?></h2>
    </div>
    
    <form action="<?= $isEdit ? baseUrl('kelas/edit/' . $data['id_kelas']) : baseUrl('kelas/create') ?>" method="POST" class="form-card">
        <div class="form-group">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input 
                type="text" 
                id="nama_kelas" 
                name="nama_kelas" 
                class="form-control" 
                placeholder="Contoh: XII RPL 1"
                value="<?= e($data['nama_kelas'] ?? '') ?>"
                required
            >
        </div>
        
        <div class="form-group">
            <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
            <input 
                type="text" 
                id="kompetensi_keahlian" 
                name="kompetensi_keahlian" 
                class="form-control" 
                placeholder="Contoh: RPL, TKJ, TKR"
                value="<?= e($data['kompetensi_keahlian'] ?? '') ?>"
                required
            >
        </div>
        
        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= baseUrl('kelas/index') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
$title = $pageTitle;
include __DIR__ . '/../layouts/main.php';
?>
