<?php

/**
 * Auth Controller
 * Handles user authentication (login/logout)
 */

class AuthController extends Controller {
    
    /**
     * Show login form
     */
    public function index() {
        // Redirect to dashboard if already logged in
        if (isLoggedIn()) {
            $this->redirect('siswa/profile');
        }
        
        $this->view('auth/login');
    }
    
    /**
     * Process login
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('auth/index');
            return;
        }
        
        // Get and sanitize input
        $nis = sanitize($_POST['nis'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validate input
        if (empty($nis) || empty($password)) {
            setFlash('login_error', 'NIS dan password harus diisi', 'error');
            $this->redirect('auth/index');
            return;
        }
        
        // Authenticate
        $userModel = $this->model('User');
        $user = $userModel->authenticate($nis, $password);
        
        if ($user) {
            // Set session
            $_SESSION['user_id'] = $user['id_siswa'];
            $_SESSION['user_nis'] = $user['nis'];
            $_SESSION['user_nama'] = $user['nama_lengkap'];
            $_SESSION['user_kelas'] = $user['nama_kelas'];
            
            // Regenerate session ID for security
            session_regenerate_id(true);
            
            setFlash('login_success', 'Login berhasil! Selamat datang, ' . $user['nama_lengkap'], 'success');
            $this->redirect('siswa/profile');
        } else {
            setFlash('login_error', 'NIS atau password salah', 'error');
            $this->redirect('auth/index');
        }
    }
    
    /**
     * Logout
     */
    public function logout() {
        // Destroy session
        session_unset();
        session_destroy();
        
        setFlash('logout_success', 'Anda telah logout', 'info');
        $this->redirect('auth/index');
    }
}
