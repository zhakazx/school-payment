<?php

/**
 * Kelas Controller
 * Handles class management
 */

class KelasController extends Controller {
    
    /**
     * List all classes
     */
    public function index() {
        requireAuth();
        
        $model = $this->model('Kelas');
        $kelasList = $model->getAll();
        
        // Get student count for each class
        foreach ($kelasList as &$kelas) {
            $kelas['student_count'] = $model->getStudentCount($kelas['id_kelas']);
        }
        
        $this->view('kelas/index', [
            'kelasList' => $kelasList
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
                'nama_kelas' => sanitize($_POST['nama_kelas'] ?? ''),
                'kompetensi_keahlian' => sanitize($_POST['kompetensi_keahlian'] ?? '')
            ];
            
            // Validate
            if (empty($data['nama_kelas']) || empty($data['kompetensi_keahlian'])) {
                setFlash('error', 'Semua field harus diisi', 'error');
                $this->view('kelas/form', ['data' => $data]);
                return;
            }
            
            $model = $this->model('Kelas');
            
            if ($model->createKelas($data)) {
                setFlash('success', 'Kelas berhasil ditambahkan', 'success');
                $this->redirect('kelas/index');
            } else {
                setFlash('error', 'Gagal menambahkan kelas', 'error');
                $this->view('kelas/form', ['data' => $data]);
            }
        } else {
            // Show form
            $this->view('kelas/form');
        }
    }
    
    /**
     * Show edit form or process update
     */
    public function edit($id = null) {
        requireAuth();
        
        if (!$id) {
            $this->redirect('kelas/index');
            return;
        }
        
        $model = $this->model('Kelas');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process form
            $data = [
                'nama_kelas' => sanitize($_POST['nama_kelas'] ?? ''),
                'kompetensi_keahlian' => sanitize($_POST['kompetensi_keahlian'] ?? '')
            ];
            
            // Validate
            if (empty($data['nama_kelas']) || empty($data['kompetensi_keahlian'])) {
                setFlash('error', 'Semua field harus diisi', 'error');
                $kelas = $model->getById($id);
                $this->view('kelas/form', ['data' => $kelas, 'isEdit' => true]);
                return;
            }
            
            if ($model->updateKelas($id, $data)) {
                setFlash('success', 'Kelas berhasil diupdate', 'success');
                $this->redirect('kelas/index');
            } else {
                setFlash('error', 'Gagal mengupdate kelas', 'error');
                $kelas = $model->getById($id);
                $this->view('kelas/form', ['data' => $kelas, 'isEdit' => true]);
            }
        } else {
            // Show form
            $kelas = $model->getById($id);
            if (!$kelas) {
                setFlash('error', 'Kelas tidak ditemukan', 'error');
                $this->redirect('kelas/index');
                return;
            }
            $this->view('kelas/form', ['data' => $kelas, 'isEdit' => true]);
        }
    }
    
    /**
     * Delete class
     */
    public function delete($id = null) {
        requireAuth();
        
        if (!$id) {
            $this->redirect('kelas/index');
            return;
        }
        
        $model = $this->model('Kelas');
        
        if ($model->deleteKelas($id)) {
            setFlash('success', 'Kelas berhasil dihapus', 'success');
        } else {
            setFlash('error', 'Gagal menghapus kelas. Kelas masih memiliki siswa.', 'error');
        }
        
        $this->redirect('kelas/index');
    }
}
