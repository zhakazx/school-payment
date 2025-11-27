<?php

/**
 * TahunAjaran Controller
 * Handles academic year management
 */

class TahunAjaranController extends Controller {
    
    /**
     * List all academic years
     */
    public function index() {
        requireAuth();
        
        $model = $this->model('TahunAjaran');
        $tahunAjaranList = $model->getAll();
        
        $this->view('tahun_ajaran/index', [
            'tahunAjaranList' => $tahunAjaranList
        ]);
    }
    
    /**
     * Show create form or process creation
     */
    public function create() {
        requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process form
            $data = [
                'periode' => sanitize($_POST['periode'] ?? ''),
                'status' => sanitize($_POST['status'] ?? 'non-aktif')
            ];
            
            // Validate
            if (empty($data['periode'])) {
                setFlash('error', 'Periode harus diisi', 'error');
                $this->view('tahun_ajaran/form', ['data' => $data]);
                return;
            }
            
            $model = $this->model('TahunAjaran');
            
            if ($model->createTahunAjaran($data)) {
                setFlash('success', 'Tahun ajaran berhasil ditambahkan', 'success');
                $this->redirect('tahunajaran/index');
            } else {
                setFlash('error', 'Gagal menambahkan tahun ajaran', 'error');
                $this->view('tahun_ajaran/form', ['data' => $data]);
            }
        } else {
            // Show form
            $this->view('tahun_ajaran/form');
        }
    }
    
    /**
     * Show edit form or process update
     */
    public function edit($id = null) {
        requireAuth();
        
        if (!$id) {
            $this->redirect('tahunajaran/index');
            return;
        }
        
        $model = $this->model('TahunAjaran');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process form
            $data = [
                'periode' => sanitize($_POST['periode'] ?? ''),
                'status' => sanitize($_POST['status'] ?? 'non-aktif')
            ];
            
            // Validate
            if (empty($data['periode'])) {
                setFlash('error', 'Periode harus diisi', 'error');
                $tahunAjaran = $model->getById($id);
                $this->view('tahun_ajaran/form', ['data' => $tahunAjaran, 'isEdit' => true]);
                return;
            }
            
            if ($model->updateTahunAjaran($id, $data)) {
                setFlash('success', 'Tahun ajaran berhasil diupdate', 'success');
                $this->redirect('tahunajaran/index');
            } else {
                setFlash('error', 'Gagal mengupdate tahun ajaran', 'error');
                $tahunAjaran = $model->getById($id);
                $this->view('tahun_ajaran/form', ['data' => $tahunAjaran, 'isEdit' => true]);
            }
        } else {
            // Show form
            $tahunAjaran = $model->getById($id);
            if (!$tahunAjaran) {
                setFlash('error', 'Tahun ajaran tidak ditemukan', 'error');
                $this->redirect('tahunajaran/index');
                return;
            }
            $this->view('tahun_ajaran/form', ['data' => $tahunAjaran, 'isEdit' => true]);
        }
    }
    
    /**
     * Delete academic year
     */
    public function delete($id = null) {
        requireAuth();
        
        if (!$id) {
            $this->redirect('tahunajaran/index');
            return;
        }
        
        $model = $this->model('TahunAjaran');
        
        if ($model->deleteTahunAjaran($id)) {
            setFlash('success', 'Tahun ajaran berhasil dihapus', 'success');
        } else {
            setFlash('error', 'Gagal menghapus tahun ajaran', 'error');
        }
        
        $this->redirect('tahunajaran/index');
    }
    
    /**
     * Set academic year as active
     */
    public function setActive($id = null) {
        requireAuth();
        
        if (!$id) {
            $this->redirect('tahunajaran/index');
            return;
        }
        
        $model = $this->model('TahunAjaran');
        
        if ($model->setActive($id)) {
            setFlash('success', 'Tahun ajaran berhasil diaktifkan', 'success');
        } else {
            setFlash('error', 'Gagal mengaktifkan tahun ajaran', 'error');
        }
        
        $this->redirect('tahunajaran/index');
    }
}
