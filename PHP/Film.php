<?php
    class Film {
        //private atribut, hanya bisa diakses dari dalam class ini sendiri (encapsulation)
        private string $id_film;      //ID unik untuk tiap film
        private string $judul_film;   //judul film yang tayang
        private string $sutradara;    //nama sutradara film
        private int $stok_tiket;      //jumlah tiket/kursi yang masih tersedia
        private float $harga_tiket;   //harga tiket untuk menonton film ini
        private string $gambar;       //path lokal poster film (wajib untuk versi web)

        //constructor, dipanggil otomatis saat objek Film dibuat
        public function __construct(string $id_film, string $judul_film, string $sutradara, int $stok_tiket, float $harga_tiket, string $gambar)
        {
            $this->id_film = $id_film;         //inisialisasi atribut id_film
            $this->judul_film = $judul_film;   //inisialisasi atribut judul_film
            $this->sutradara = $sutradara;     //inisialisasi atribut sutradara
            $this->stok_tiket = $stok_tiket;   //inisialisasi atribut stok_tiket
            $this->harga_tiket = $harga_tiket; //inisialisasi atribut harga_tiket
            $this->gambar = $gambar;           //inisialisasi atribut gambar (path file lokal)
        }

        // Getter (untuk mendapatkan nilai atribut)
        public function getId(): string
        {
            return $this->id_film; //mengembalikan nilai atribut id_film
        }

        public function getJudul(): string
        {
            return $this->judul_film; //mengembalikan nilai atribut judul_film
        }

        public function getSutradara(): string
        {
            return $this->sutradara; //mengembalikan nilai atribut sutradara
        }

        public function getStok(): int
        {
            return $this->stok_tiket; //mengembalikan nilai atribut stok_tiket
        }

        public function getHarga(): float
        {
            return $this->harga_tiket; //mengembalikan nilai atribut harga_tiket
        }

        public function getGambar(): string
        {
            return $this->gambar; //mengembalikan nilai atribut gambar
        }

        // Setter (untuk mengubah nilai atribut)
        public function setId(string $id_film): void
        {
            $this->id_film = $id_film; //menginisialisasi atribut dengan value baru
        }

        public function setJudul(string $judul_film): void
        {
            $this->judul_film = $judul_film; //menginisialisasi atribut dengan value baru
        }

        public function setSutradara(string $sutradara): void
        {
            $this->sutradara = $sutradara; //menginisialisasi atribut dengan value baru
        }

        public function setStok(int $stok_tiket): void
        {
            // Validasi: memastikan stok tidak negatif
            if ($stok_tiket >= 0) {
                $this->stok_tiket = $stok_tiket; //menginisialisasi atribut dengan value baru
            } else {
                echo "Stok tiket tidak boleh negatif."; //jika input tidak valid
            }
        }

        public function setHarga(float $harga_tiket): void
        {
            // Validasi: memastikan harga lebih dari 0
            if ($harga_tiket > 0) {
                $this->harga_tiket = $harga_tiket; //menginisialisasi atribut dengan value baru
            } else {
                echo "Harga tiket harus lebih dari 0."; //jika input tidak valid
            }
        }

        public function setGambar(string $gambar): void
        {
            $this->gambar = $gambar; //menginisialisasi atribut dengan value baru
        }

        //function untuk menampilkan data (dipakai untuk keperluan debug/CLI, versi web pakai tabel HTML)
        public function tampilkanData(): void
        {
            //print seluruh atribut
            echo "ID: " . $this->getId() . "<br>";
            echo "Judul Film: " . $this->getJudul() . "<br>";
            echo "Sutradara: " . $this->getSutradara() . "<br>";
            echo "Stok Tiket: " . $this->getStok() . "<br>";
            echo "Harga Tiket: " . $this->getHarga() . "<br>";
            echo "Gambar: " . $this->getGambar() . "<br>";
        }
    }
