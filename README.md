# Janji
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


