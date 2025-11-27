<?php

/**
 * Siswa Controller
 * Handles student management and profile
 */

class SiswaController extends Controller {
    
    /**
     * Show student profile (for logged-in student)
     */
    public function profile() {
        requireAuth();
        
        $userId = getUserId();
        $model = $this->model('Siswa');
        $siswa = $model->getById($userId);
        
        if (!$siswa) {
            setFlash('error', 'Data siswa tidak ditemukan', 'error');
            $this->redirect('auth/logout');
            return;
        }
        
        $this->view('siswa/profile', [
            'siswa' => $siswa
        ]);
    }
    
    /**
     * List all students (admin view)
     */
    public function index() {
        requireAuth();
        
        $model = $this->model('Siswa');
        $siswaList = $model->getAll();
        
        $this->view('siswa/index', [
            'siswaList' => $siswaList
        ]);
    }
    
    /**
     * Show create form or process creation
     */
    public function create() {
        requireAuth();
        
        $kelasModel = $this->model('Kelas');
        $kelasList = $kelasModel->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process form
            $data = [
                'nis' => sanitize($_POST['nis'] ?? ''),
                'nama_lengkap' => sanitize($_POST['nama_lengkap'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'id_kelas' => sanitize($_POST['id_kelas'] ?? '')
            ];
            
            // Validate
            if (empty($data['nis']) || empty($data['nama_lengkap']) || empty($data['password']) || empty($data['id_kelas'])) {
                setFlash('error', 'Semua field harus diisi', 'error');
                $this->view('siswa/form', ['data' => $data, 'kelasList' => $kelasList]);
                return;
            }
            
            $model = $this->model('Siswa');
            
            // Check if NIS already exists
            if ($model->nisExists($data['nis'])) {
                setFlash('error', 'NIS sudah terdaftar', 'error');
                $this->view('siswa/form', ['data' => $data, 'kelasList' => $kelasList]);
                return;
            }
            
            if ($model->createSiswa($data)) {
                setFlash('success', 'Siswa berhasil ditambahkan', 'success');
                $this->redirect('siswa/index');
            } else {
                setFlash('error', 'Gagal menambahkan siswa', 'error');
                $this->view('siswa/form', ['data' => $data, 'kelasList' => $kelasList]);
            }
        } else {
            // Show form
            $this->view('siswa/form', ['kelasList' => $kelasList]);
        }
    }
    
    /**
     * Show edit form or process update
     */
    public function edit($id = null) {
        requireAuth();
        
        if (!$id) {
            $this->redirect('siswa/index');
            return;
        }
        
        $model = $this->model('Siswa');
        $kelasModel = $this->model('Kelas');
        $kelasList = $kelasModel->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process form
            $data = [
                'nis' => sanitize($_POST['nis'] ?? ''),
                'nama_lengkap' => sanitize($_POST['nama_lengkap'] ?? ''),
                'id_kelas' => sanitize($_POST['id_kelas'] ?? '')
            ];
            
            // Add password only if provided
            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }
            
            // Validate
            if (empty($data['nis']) || empty($data['nama_lengkap']) || empty($data['id_kelas'])) {
                setFlash('error', 'NIS, Nama, dan Kelas harus diisi', 'error');
                $siswa = $model->getById($id);
                $this->view('siswa/form', ['data' => $siswa, 'kelasList' => $kelasList, 'isEdit' => true]);
                return;
            }
            
            // Check if NIS already exists (excluding current student)
            if ($model->nisExists($data['nis'], $id)) {
                setFlash('error', 'NIS sudah terdaftar', 'error');
                $siswa = $model->getById($id);
                $this->view('siswa/form', ['data' => $siswa, 'kelasList' => $kelasList, 'isEdit' => true]);
                return;
            }
            
            if ($model->updateSiswa($id, $data)) {
                setFlash('success', 'Siswa berhasil diupdate', 'success');
                $this->redirect('siswa/index');
            } else {
                setFlash('error', 'Gagal mengupdate siswa', 'error');
                $siswa = $model->getById($id);
                $this->view('siswa/form', ['data' => $siswa, 'kelasList' => $kelasList, 'isEdit' => true]);
            }
        } else {
            // Show form
            $siswa = $model->getById($id);
            if (!$siswa) {
                setFlash('error', 'Siswa tidak ditemukan', 'error');
                $this->redirect('siswa/index');
                return;
            }
            $this->view('siswa/form', ['data' => $siswa, 'kelasList' => $kelasList, 'isEdit' => true]);
        }
    }
    
    /**
     * Delete student
     */
    public function delete($id = null) {
        requireAuth();
        
        if (!$id) {
            $this->redirect('siswa/index');
            return;
        }
        
        $model = $this->model('Siswa');
        
        if ($model->deleteSiswa($id)) {
            setFlash('success', 'Siswa berhasil dihapus', 'success');
        } else {
            setFlash('error', 'Gagal menghapus siswa', 'error');
        }
        
        $this->redirect('siswa/index');
    }
}
