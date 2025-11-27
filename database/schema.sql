-- SPP Payment Application Database Schema
-- Created: 2025-11-26

-- Create database
CREATE DATABASE IF NOT EXISTS spp_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE spp_app;

-- Table: tahun_ajaran (Academic Year)
CREATE TABLE IF NOT EXISTS tahun_ajaran (
    id_tahun_ajaran INT AUTO_INCREMENT PRIMARY KEY,
    periode VARCHAR(9) NOT NULL UNIQUE COMMENT 'Format: 2024/2025',
    status ENUM('aktif', 'non-aktif') DEFAULT 'non-aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: kelas (Class)
CREATE TABLE IF NOT EXISTS kelas (
    id_kelas INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(50) NOT NULL COMMENT 'Example: XII RPL 1, X TKR 2',
    kompetensi_keahlian VARCHAR(50) NOT NULL COMMENT 'Example: RPL, TKR, TKJ',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_kompetensi (kompetensi_keahlian)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: siswa (Student)
CREATE TABLE IF NOT EXISTS siswa (
    id_siswa INT AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(20) NOT NULL UNIQUE COMMENT 'Student ID Number - used for login',
    password VARCHAR(255) NOT NULL COMMENT 'Hashed password using bcrypt',
    nama_lengkap VARCHAR(100) NOT NULL,
    id_kelas INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas) ON DELETE RESTRICT ON UPDATE CASCADE,
    INDEX idx_nis (nis),
    INDEX idx_kelas (id_kelas)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: tagihan_spp (Tuition Bills)
CREATE TABLE IF NOT EXISTS tagihan_spp (
    id_tagihan INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT NOT NULL,
    id_tahun_ajaran INT NOT NULL,
    bulan INT NOT NULL COMMENT 'Month: 1-12 (July to June)',
    nominal DECIMAL(10,2) NOT NULL COMMENT 'Bill amount - can vary per student',
    status_bayar ENUM('lunas', 'belum_bayar') DEFAULT 'belum_bayar',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tahun_ajaran) REFERENCES tahun_ajaran(id_tahun_ajaran) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY unique_tagihan (id_siswa, id_tahun_ajaran, bulan),
    INDEX idx_siswa_tahun (id_siswa, id_tahun_ajaran),
    INDEX idx_status (status_bayar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: pembayaran_spp (Payment Records)
CREATE TABLE IF NOT EXISTS pembayaran_spp (
    id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT NOT NULL,
    id_tagihan INT NOT NULL,
    tgl_bayar DATETIME NOT NULL,
    metode_pembayaran VARCHAR(50) DEFAULT 'Midtrans',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tagihan) REFERENCES tagihan_spp(id_tagihan) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_siswa (id_siswa),
    INDEX idx_tagihan (id_tagihan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: midtrans_transaksi (Midtrans Transaction Log)
CREATE TABLE IF NOT EXISTS midtrans_transaksi (
    order_id VARCHAR(50) PRIMARY KEY,
    id_siswa INT NOT NULL,
    id_tagihan INT NOT NULL,
    gross_amount DECIMAL(10,2) NOT NULL,
    payment_type VARCHAR(50) DEFAULT NULL COMMENT 'gopay, bank_transfer, etc',
    transaction_status VARCHAR(20) DEFAULT 'pending' COMMENT 'pending, settlement, expire, cancel, deny',
    transaction_time DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tagihan) REFERENCES tagihan_spp(id_tagihan) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_siswa (id_siswa),
    INDEX idx_status (transaction_status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data

-- Academic Years
INSERT INTO tahun_ajaran (periode, status) VALUES
('2023/2024', 'non-aktif'),
('2024/2025', 'aktif'),
('2025/2026', 'non-aktif');

-- Classes
INSERT INTO kelas (nama_kelas, kompetensi_keahlian) VALUES
('X RPL 1', 'RPL'),
('X RPL 2', 'RPL'),
('XI RPL 1', 'RPL'),
('XII RPL 1', 'RPL'),
('X TKJ 1', 'TKJ'),
('XI TKJ 1', 'TKJ'),
('X TKR 1', 'TKR');

-- Students (password: password123 - hashed with bcrypt)
-- Hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
INSERT INTO siswa (nis, password, nama_lengkap, id_kelas) VALUES
('2024001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ahmad Fauzi', 1),
('2024002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Siti Nurhaliza', 1),
('2024003', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', 2),
('2023001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dewi Lestari', 3),
('2022001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rudi Hartono', 4);

-- Sample bills for student 2024001 (Ahmad Fauzi) for academic year 2024/2025
-- Monthly fee: Rp 500,000
INSERT INTO tagihan_spp (id_siswa, id_tahun_ajaran, bulan, nominal, status_bayar) VALUES
(1, 2, 7, 500000.00, 'belum_bayar'),  -- July
(1, 2, 8, 500000.00, 'belum_bayar'),  -- August
(1, 2, 9, 500000.00, 'belum_bayar'),  -- September
(1, 2, 10, 500000.00, 'belum_bayar'), -- October
(1, 2, 11, 500000.00, 'belum_bayar'), -- November
(1, 2, 12, 500000.00, 'belum_bayar'); -- December
