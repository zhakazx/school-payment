<?php 
$isEdit = isset($isEdit) && $isEdit;
$pageTitle = $isEdit ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran';
ob_start(); 
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><?= $pageTitle ?></h2>
    </div>
    
    <form action="<?= $isEdit ? baseUrl('tahunajaran/edit/' . $data['id_tahun_ajaran']) : baseUrl('tahunajaran/create') ?>" method="POST" class="form-card">
        <div class="form-group">
            <label for="periode" class="form-label">Periode</label>
            <input 
                type="text" 
                id="periode" 
                name="periode" 
                class="form-control" 
                placeholder="Contoh: 2024/2025"
                value="<?= e($data['periode'] ?? '') ?>"
                required
            >
            <small style="color: var(--text-secondary);">Format: YYYY/YYYY (contoh: 2024/2025)</small>
        </div>
        
        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="non-aktif" <?= (isset($data['status']) && $data['status'] === 'non-aktif') ? 'selected' : '' ?>>Non-Aktif</option>
                <option value="aktif" <?= (isset($data['status']) && $data['status'] === 'aktif') ? 'selected' : '' ?>>Aktif</option>
            </select>
        </div>
        
        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= baseUrl('tahunajaran/index') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
$title = $pageTitle;
include __DIR__ . '/../layouts/main.php';
?>
