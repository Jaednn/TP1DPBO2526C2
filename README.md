Janji
Saya Afzaal Zaidan Febryanto dengan NIM 2508692 mengerjakan Tugas Praktikum 1 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Penjelasan Desain

## Fitur
- Menambahkan Data Baru
- Menampilkan Semua Data Objek Yang Tersimpan
- Mengubah Data Objek Yang Tersimpan
- Mencari Data Objek Bedasarkan ID

## Desain Objek

### Atribut 
- ID unik tiap film (dipakai sebagai identifier untuk update/hapus/cari)
- Judul film 
- Nama sutradara film 
- Jumlah tiket/kursi yang masih tersedia 
- Harga tiket untuk menonton film tersebut 
- gambar *(khusus versi PHP/Web)*

Setiap atribut memiliki **getter** dan **setter**. Setter untuk stok_tiket dan harga_tiket diberi validasi (stok tidak boleh negatif, harga harus lebih dari 0) sebagai contoh penerapan encapsulation yang melindungi data dari nilai yang tidak valid.

Class Film juga memiliki method tampilkanData() untuk menampilkan seluruh atributnya.

### Struktur data 
Seluruh objek Film disimpan dalam satu variabel array/list:
- C++ : vector<Film> daftarFilm
- Java : ArrayList<Film> daftarFilm
- Python : list daftarFilm 
- PHP : $_SESSION['daftarFilm'] 

### Data Dummy
Setiap program diisi otomatis dengan 6 data film contoh saat pertama kali dijalankan 
1. Ghost in the Cell - Joko Anwar
2. Jatuh Cinta Seperti Di Film-Film - Yandy Laurens
3. Tunggu Aku Sukses - Imanuel Kristo
4. KKN di Desa Penari - Awi Suryadi
5. Agak Laen - Muhadkly Acho
6. Jumbo - Ryan Adriandhy

# Screenshoot
## C++
### Menambahkan Data
<img width="422" height="501" alt="Tambah Data Cpp" src="https://github.com/user-attachments/assets/c2c18955-9afc-468f-a04a-8dbe2df04842" />

### Menampilkan semua Data
<img width="437" height="860" alt="Tampil Data Cpp" src="https://github.com/user-attachments/assets/b59c1aaa-1fd3-4ca8-99d3-c2b00964e04c" />
<br>
<img width="353" height="257" alt="Tampil Data 2 Cpp" src="https://github.com/user-attachments/assets/627caa70-ba68-4462-bc56-e745ed628669" />

### Mengubah Data
<img width="417" height="412" alt="Update Data Cpp" src="https://github.com/user-attachments/assets/d11f28b5-0892-44a0-83c7-9ce79bbb43c9" />
<br>
Hasil <br>
<img width="373" height="142" alt="Hasil Update" src="https://github.com/user-attachments/assets/bf21309d-8ce6-4f42-97bf-55b0efe62132" />

### Mencari Data
<img width="425" height="610" alt="Cari Data Cpp" src="https://github.com/user-attachments/assets/1f76b988-d171-465e-b077-0358b80a5f88" />

### Mengahpus Data
<img width="412" height="293" alt="Hapus Data Cpp" src="https://github.com/user-attachments/assets/3b0f1f9a-072c-4f6f-bd9f-5edb195e4c5b" />
<br>
Hasil <br>
<img width="493" height="470" alt="Hasil Hapus" src="https://github.com/user-attachments/assets/b220cfd0-09ac-4a36-ba46-4c30241cb2fa" />

## Python
### Menambahkan Data
<img width="425" height="420" alt="Tambah Data Py" src="https://github.com/user-attachments/assets/4d8fbca0-18ad-412a-a600-fb779ba8104a" />

### Menampilkan semua Data
<img width="447" height="575" alt="Tampil Data Py" src="https://github.com/user-attachments/assets/e5be57da-dd54-4b68-bb23-c79a72f21c9c" />
<br>
<img width="317" height="523" alt="Tampil Data 2 Py" src="https://github.com/user-attachments/assets/28f51734-8818-406c-8ff4-32f944a8d669" />

### Mengubah Data
<img width="425" height="397" alt="Update Data Py" src="https://github.com/user-attachments/assets/579453da-9fbe-43d6-b133-ab15ca33c258" />
<br>
Hasi l<br>
<img width="325" height="148" alt="Hasil Update Py" src="https://github.com/user-attachments/assets/578ed41a-275b-4c5b-bfef-95148c6cc2a1" />

### Mencari Data
<img width="425" height="402" alt="Cari Data Py" src="https://github.com/user-attachments/assets/077a99b1-5021-4ff9-988b-0e9cefb92b06" />

### Mengahpus Data
<img width="438" height="297" alt="Hapus Data Py" src="https://github.com/user-attachments/assets/eb36b3cd-83cb-452f-9d3b-b66f1f703078" />
<br>
Hasil <br>
<img width="376" height="410" alt="Hasil Hapus Py" src="https://github.com/user-attachments/assets/bd070af8-0663-44a6-8e05-4d44f76b5beb" />

## Java
### Menambahkan Data
<img width="440" height="495" alt="Tambah Data Java" src="https://github.com/user-attachments/assets/891fe708-7aa4-40f4-a9eb-89b9c046bffc" />

### Menampilkan semua Data
<img width="447" height="581" alt="Tampil Data Java" src="https://github.com/user-attachments/assets/783880df-03ae-4917-90e3-4b21ce965fc4" />
<br>
<img width="333" height="522" alt="Tampil Data 2 Java" src="https://github.com/user-attachments/assets/356cbe1a-4975-4d72-a665-60f45a68061d" />

### Mengubah Data
<img width="576" height="410" alt="Update Data Java" src="https://github.com/user-attachments/assets/6c1707b1-790a-43ad-b233-dabdabfcb2e1" />
<br>
hasil <br>
<img width="401" height="387" alt="Hasil Update Java" src="https://github.com/user-attachments/assets/783402e8-c1e1-46de-b36d-6efe65484908" />

### Mencari Data
<img width="426" height="402" alt="Cari Data Java" src="https://github.com/user-attachments/assets/bc136fb4-ee0c-490f-9ecd-5e5dad37ff25" />

### Mengahpus Data
<img width="462" height="292" alt="Hapus Data Java" src="https://github.com/user-attachments/assets/800eddf6-7539-4064-a639-ec919b05508d" />
<br>
Hasil <br>
<img width="302" height="388" alt="Hasil Hapus Java" src="https://github.com/user-attachments/assets/38a8a896-e82f-476f-8a8d-e61281d5034b" />

## PHP
### Menambahkan Data
<img width="1500" height="671" alt="tambah data php" src="https://github.com/user-attachments/assets/a7962970-c630-43e9-92af-14c91d1f0bb8" />

### Menampilkan semua Data
<img width="912" height="902" alt="tampil data php" src="https://github.com/user-attachments/assets/b6880dfe-1521-40fa-bf6b-a47bb83022b2" />

### Mengubah Data
<img width="913" height="391" alt="update data" src="https://github.com/user-attachments/assets/2fcbef7c-de5f-4dab-81fb-e45a5d2b1b96" />
<br>
hasil<br>
<img width="897" height="106" alt="hasil update" src="https://github.com/user-attachments/assets/ea652936-33c5-4a11-9627-0c249c729893" />

### Mencari Data
<img width="911" height="323" alt="Screenshot 2026-09-20 221701" src="https://github.com/user-attachments/assets/9147af8f-777c-4ed1-8f10-e0fcea5810a5" />


### Mengahpus Data
<img width="911" height="365" alt="hapus data" src="https://github.com/user-attachments/assets/8555272b-48ab-44a9-9100-f598962034d9" />
<br>
<img width="916" height="120" alt="hasil reset data" src="https://github.com/user-attachments/assets/c51387c1-3d65-4cd8-aed0-426571dd9166" />
hapus bisa menggunakan tombol hapus disamping data atau menghapus semua data dengan tombol reset





