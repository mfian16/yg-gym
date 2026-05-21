# 🏋️‍♂️ YG Gym — Member & Attendance System

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple?style=for-the-badge)
![jQuery](https://img.shields.io/badge/jQuery-3.7-blue?style=for-the-badge)
![Vite](https://img.shields.io/badge/Vite-Bundler-yellow?style=for-the-badge)
![License](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)

Aplikasi manajemen gym berbasis Laravel yang memungkinkan pengelolaan member, absensi otomatis menggunakan QR Code, serta monitoring status membership secara real-time.

---

# 🚀 Fitur Utama

✅ Manajemen Member Gym
✅ Upload foto member
✅ Generate QR Code otomatis untuk setiap member
✅ Scan QR Code untuk absensi member
✅ Validasi status membership (Aktif / Expired)
✅ Riwayat absensi member
✅ Notifikasi setelah absensi
✅ Print kartu member

---

# ✨ Highlights

- Sistem absensi otomatis berbasis QR Code
- UI modern menggunakan Bootstrap 5
- Interaksi cepat dengan jQuery
- Struktur project clean & scalable

---

# 🧰 Teknologi yang Digunakan

* PHP 8.2
* Laravel 12
* MySQL (XAMPP)
* Bootstrap 5
* jQuery
* Vite
* HTML5 QR Code Scanner
* Bacon QR Code

---

# ⚙️ Cara Menjalankan Project

## 1️⃣ Clone Repository

```bash
git clone https://github.com/mfian16/yg-gym.git
cd yg-gym
```

---

## 2️⃣ Install Dependency

```bash
composer install
npm install
```

---

## 3️⃣ Copy File Environment

```bash
cp .env.example .env
```

---

## 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

## 5️⃣ Setup Database MySQL

Buat database di **phpMyAdmin**

```
yg-gym
```

Edit file `.env`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yg-gym
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6️⃣ Migrasi Database

```bash
php artisan migrate
```

---

## 7️⃣ Jalankan Server

```bash
npm run dev
php artisan serve
```

Buka browser

👉 http://127.0.0.1:8000/

---

# 🌐 Fitur Sistem

| Fitur                 | Deskripsi                       |
| --------------------- | ------------------------------- |
| Member Management     | Tambah, edit, hapus member      |
| QR Code Generator     | QR otomatis untuk setiap member |
| Attendance Scanner    | Scan QR untuk absensi           |
| Membership Validation | Cek masa aktif member           |
| Attendance History    | Riwayat absensi member          |

---

# 📂 Struktur Project

```
yg-gym/
│
├── app/
│   ├── Http/Controllers
│   │   ├── MemberController.php
│   │   └── AttendanceController.php
│   ├── Models
│   │   ├── Member.php
│   │   └── Attendance.php
│
├── database/
│   ├── migrations
│   └── seeders
│
├── resources/
│   ├── views
│   │   ├── member
│   │   ├── attendance
│   │   └── layouts
│
├── routes
│   └── web.php
│
├── public
│   └── css
├── screenshots
│   ├── member-list.png
│   ├── add-member.png
│   ├── member-detail.png
│   ├── scan-qr.png
│   ├── attendance-list.png
│   └── success-scan.png
└── README.md
```

---

# 🧠 Cara Kerja Sistem

1️⃣ Admin menambahkan member gym
2️⃣ Sistem membuat **QR Code otomatis**
3️⃣ Member datang ke gym
4️⃣ Admin melakukan **scan QR Code**
5️⃣ Sistem mencatat absensi secara otomatis

---

# 📸 Screenshots

### Member List
![Member List](screenshots/member-list.png)

### Scan QR Code
![Scan QR](screenshots/scan-qr.png)

### Attendance
![Attendance](screenshots/attendance-list.png)

---

# 👤 Author

Nama: **Muhammad Fiqih Irfiansyah**

Junior Web Developer Enthusiast

---
