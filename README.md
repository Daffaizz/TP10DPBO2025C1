# Janji
Saya Daffa Faiz Restu Oktavian dengan NIM 2309013 mengerjakan Tugas Praktikum 10 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# SuperField - Sistem Manajemen Lapangan Olahraga

SuperField adalah aplikasi web untuk mengelola pemesanan lapangan olahraga. Aplikasi ini memungkinkan pengguna untuk mengelola data lapangan, pelanggan, dan pemesanan (booking) lapangan olahraga.

# Struktur Folder

```
TP 10/
│
├── config/                  # Konfigurasi aplikasi
│   └── Database.php         # Kelas koneksi database
│
├── database/                # File basis data
│   └── SuperFields.sql      # SQL untuk pembuatan dan pengisian database awal
│
├── model/                   # Model data (representasi tabel database)
│   ├── Booking.php          # Model untuk tabel bookings
│   ├── Customer.php         # Model untuk tabel customers
│   └── Field.php            # Model untuk tabel fields
│
├── viewmodel/               # Lapisan logika bisnis
│   ├── BookingViewModel.php # ViewModel untuk operasi booking
│   ├── CustomerViewModel.php# ViewModel untuk operasi customer
│   └── FieldViewModel.php   # ViewModel untuk operasi field
│
├── views/                   # Tampilan antarmuka pengguna
│   ├── bookings_form.php    # Form untuk tambah/edit booking
│   ├── bookings_list.php    # Halaman daftar booking
│   ├── customers_form.php   # Form untuk tambah/edit pelanggan
│   ├── customers_list.php   # Halaman daftar pelanggan
│   ├── fields_form.php      # Form untuk tambah/edit lapangan
│   ├── fields_list.php      # Halaman daftar lapangan
│   └── template/            # Template dasar untuk semua halaman
│       ├── footer.php       # Footer halaman
│       └── header.php       # Header halaman
│
└── index.php                # File utama yang menangani routing dan kontroler
```

# Desain Program

### Arsitektur MVVM (Model-View-ViewModel)

Aplikasi ini menggunakan arsitektur MVVM (Model-View-ViewModel) yang membagi komponen menjadi tiga lapisan:

1. **Model**: Representasi langsung dari tabel database dan berisi logika akses data.
   - `Field.php` - Model untuk tabel fields
   - `Customer.php` - Model untuk tabel customers
   - `Booking.php` - Model untuk tabel bookings

2. **View**: Bertanggung jawab untuk menampilkan data kepada pengguna.
   - File-file dalam folder `/views`
   - Template dasar dalam folder `/views/template`

3. **ViewModel**: Lapisan penengah antara Model dan View, menangani logika bisnis.
   - `FieldViewModel.php` - Menangani operasi terkait lapangan
   - `CustomerViewModel.php` - Menangani operasi terkait pelanggan
   - `BookingViewModel.php` - Menangani operasi terkait booking

### Database

Aplikasi ini menggunakan database MySQL dengan tiga tabel utama:
- `fields` - Menyimpan data lapangan olahraga
- `customers` - Menyimpan data pelanggan
- `bookings` - Menyimpan data pemesanan lapangan

### Teknologi

- **Backend**: PHP
- **Frontend**: HTML, TailwindCSS
- **Database**: MySQL
- **Server**: XAMPP

# Alur Kerja Aplikasi

### Inisialisasi

1. Pengguna mengakses `index.php`
2. File `index.php` menginisialisasi koneksi database dan ViewModel
3. Berdasarkan parameter URL, sistem menentukan tab dan aksi yang akan dilakukan

### Alur CRUD (Create, Read, Update, Delete)

#### Daftar Lapangan / Pelanggan / Booking
1. Pengguna mengakses tab melalui navigasi (`field`, `customer`, atau `booking`)
2. Sistem menampilkan halaman list yang sesuai (`fields_list.php`, `customers_list.php`, atau `bookings_list.php`)
3. Data ditampilkan dalam bentuk tabel

#### Tambah Data Baru
1. Pengguna mengklik tombol "+ Tambah" pada halaman list
2. Sistem menampilkan form kosong sesuai dengan entitas yang dipilih
3. Pengguna mengisi formulir dan menekan tombol "Simpan"
4. Sistem memvalidasi input dan menyimpan data ke database
5. Sistem mengarahkan kembali ke halaman list

#### Edit Data
1. Pengguna mengklik tombol "Edit" pada item di halaman list
2. Sistem menampilkan form yang sudah terisi dengan data yang ada
3. Pengguna mengubah data dan menekan tombol "Update"
4. Sistem memvalidasi input dan memperbarui data di database
5. Sistem mengarahkan kembali ke halaman list

#### Hapus Data
1. Pengguna mengklik tombol "Hapus" pada item di halaman list
2. Sistem menampilkan konfirmasi penghapusan
3. Jika dikonfirmasi, sistem menghapus data dari database
4. Sistem mengarahkan kembali ke halaman list

### Fitur Spesial

#### Pemesanan Lapangan (Booking)
- Sistem secara otomatis menghitung total harga berdasarkan durasi pemesanan dan harga per jam lapangan
- Pengguna dapat memilih pelanggan dan lapangan dari data yang sudah ada
- Sistem mencegah konflik jadwal pemesanan pada lapangan yang sama

# Dokumentasi


### Struktur Repo tidak sesuai karena sudah terlanjur dibuat :)