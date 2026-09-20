from Film import Film #import class Film yang sudah dibuat

daftarFilm = [] #deklarasi array/list of object untuk menyimpan seluruh data film

#fungsi untuk menentukan apakah id sudah dipakai atau belum
def isIdExists(id_film):
    for film in daftarFilm: #looping ke semua elemen
        if film.getId() == id_film: #jika ada elemen dengan id yang sama
            return True #mengembalikan nilai true
    return False #jika tidak ada yang sama, id dianggap unik

#prosedur untuk mengisi data dummy film di awal program
def isiDataDummy():
    #menambahkan 6 objek Film contoh ke dalam list
    daftarFilm.append(Film("1", "Ghost in the Cell", "Joko Anwar", 50, 35000))
    daftarFilm.append(Film("2", "Jatuh Cinta Seperti Di Film-Film", "Yandy Laurens", 30, 40000))
    daftarFilm.append(Film("3", "Tunggu Aku Sukses", "Imanuel Kristo", 40, 35000))
    daftarFilm.append(Film("4", "KKN di Desa Penari", "Awi Suryadi", 15, 45000))
    daftarFilm.append(Film("5", "Agak Laen", "Muhadkly Acho", 60, 40000))
    daftarFilm.append(Film("6", "Jumbo", "Ryan Adriandhy", 100, 38000))

#prosedur menampilkan menu
def tampilkanMenu():
    #print pilihan menu ke layar
    print("\n<======== Menu LK21 Movie Indonesia  ========>")
    print("1. Tambah Data Film")
    print("2. Tampilkan Semua Data Film")
    print("3. Update Data Film")
    print("4. Hapus Data Film")
    print("5. Cari Data Film")
    print("6. Keluar")

#prosedur menambahkan data film baru
def tambahData():
    print("\n--- Tambahkan Data Film ---")
    # Validasi ID unik
    while True:
        id_film = input("Id Film: ") #input id
        if not isIdExists(id_film): #jika id belum dipakai
            break #keluar dari loop karena id valid
        print("ID ini sudah ada. Silakan masukkan ID lain.") #jika id sudah dipakai

    judul_film = input("Judul Film: ") #input judul film
    sutradara = input("Sutradara: ") #input nama sutradara

    # Validasi input numerik untuk stok
    while True:
        try:
            stok_tiket = int(input("Stok Tiket: ")) #input stok, dikonversi ke int
            if stok_tiket < 0: #jika input negatif
                print("Input tidak valid. Stok tidak boleh negatif.")
                continue #kembali ke awal loop
            break #keluar dari loop karena input valid
        except ValueError: #jika input bukan angka
            print("Input tidak valid. Masukkan angka.")

    # Validasi input numerik untuk harga
    while True:
        try:
            harga_tiket = float(input("Harga Tiket: ")) #input harga, dikonversi ke float
            if harga_tiket < 0: #jika input negatif
                print("Input tidak valid. Harga tidak boleh negatif.")
                continue #kembali ke awal loop
            break #keluar dari loop karena input valid
        except ValueError: #jika input bukan angka
            print("Input tidak valid. Masukkan angka.")

    film_baru = Film(id_film, judul_film, sutradara, stok_tiket, harga_tiket) #membuat objek baru
    daftarFilm.append(film_baru) #memasukkan objek ke dalam list
    print("\nData berhasil ditambahkan")

#prosedur menampilkan seluruh data film
def tampilkanData():
    print("\n--- Daftar Film ---")
    if not daftarFilm: #jika daftar film kosong
        print("\nData film kosong")
    else:
        #jika daftar film ada isinya
        for film in daftarFilm: #looping ke semua elemen list
            film.tampilkanData() #menampilkan data film
            print() #newline sebagai pemisah

#prosedur untuk memperbarui data film berdasarkan id
def updateData():
    print("\n--- Update Data Film ---")
    id_update = input("Masukkan ID Film yang akan diupdate: ") #input id yang ingin diupdate

    found = False #flag untuk menandai apakah data ditemukan
    for film in daftarFilm: #looping ke semua elemen film
        if film.getId() == id_update: #jika film ditemukan
            found = True #set flag menjadi true

            # update id film
            id_baru = input(f"ID baru ({film.getId()}): ")
            if id_baru: #kalau user mengisi input
                if id_baru != film.getId() and isIdExists(id_baru): #jika beda dari id awal dan tidak unik
                    print("ID baru sudah digunakan, ID tidak diubah.")
                else:
                    film.setId(id_baru) #jika input valid, update id

            # update judul film
            judul_baru = input(f"Judul Film baru ({film.getJudul()}): ")
            if judul_baru: #jika input diisi
                film.setJudul(judul_baru) #update judul

            # update sutradara
            sutradara_baru = input(f"Sutradara baru ({film.getSutradara()}): ")
            if sutradara_baru: #jika input diisi
                film.setSutradara(sutradara_baru) #update sutradara

            # update stok tiket
            stok_baru = input(f"Stok Tiket baru ({film.getStok()}): ")
            if stok_baru: #jika input diisi
                try:
                    stok_baru_int = int(stok_baru) #konversi ke int
                    if stok_baru_int < 0: #jika input negatif
                        print("Input stok tidak valid. Stok tidak boleh negatif.")
                    else:
                        film.setStok(stok_baru_int) #masukkan value baru
                except ValueError: #jika input bukan angka
                    print("Input stok tidak valid. Data tidak diubah.")

            # update harga tiket
            harga_baru = input(f"Harga Tiket baru ({film.getHarga()}): ")
            if harga_baru: #jika input diisi
                try:
                    harga_baru_float = float(harga_baru) #konversi ke float
                    if harga_baru_float < 0: #jika input negatif
                        print("Input harga tidak valid. Harga tidak boleh negatif.")
                    else:
                        film.setHarga(harga_baru_float) #masukkan value baru
                except ValueError: #jika input tidak valid
                    print("Input harga tidak valid. Data tidak diubah.")

            print("\nData film berhasil diupdate")
            break #keluar dari loop karena sudah ditemukan dan diupdate

    if not found: #jika id tidak ditemukan
        print(f"Film dengan ID {id_update} tidak ditemukan")

#prosedur menghapus data film berdasarkan id
def hapusData():
    print("\n--- Hapus Data Film ---")
    id_hapus = input("Masukkan ID Film yang akan dihapus: ") #input id yang ingin dihapus

    found = False #flag untuk menandai apakah data ditemukan
    for film in daftarFilm: #looping ke semua elemen
        if film.getId() == id_hapus: #jika ditemukan id yang dicari
            daftarFilm.remove(film) #hapus data dari list
            found = True #set flag menjadi true
            print("\nData film berhasil dihapus")
            break #keluar dari loop karena sudah ditemukan

    if not found: #jika id tidak ditemukan
        print(f"Film dengan ID {id_hapus} tidak ditemukan")

#prosedur mencari data film berdasarkan id
def cariData():
    print("\n--- Cari Data Film ---")
    id_cari = input("Masukkan ID Film yang akan dicari: ") #input id yang ingin dicari

    found = False #flag untuk menandai apakah data ditemukan
    for film in daftarFilm: #looping ke semua elemen
        if film.getId() == id_cari: #jika ditemukan id yang dicari
            print("\nData film ditemukan")
            film.tampilkanData() #menampilkan data film
            found = True #set flag menjadi true
            break #keluar dari loop karena sudah ketemu

    if not found: #jika id tidak ditemukan
        print(f"Film dengan ID {id_cari} tidak ditemukan")

#fungsi utama program
def main():
    isiDataDummy() #mengisi data dummy di awal program

    while True:
        tampilkanMenu() #menampilkan menu
        pilihan = input("Pilihan: ") #input pilihan menu

        if pilihan == '1': #opsi 1
            tambahData() #menambah data
        elif pilihan == '2': #opsi 2
            tampilkanData() #menampilkan data
        elif pilihan == '3': #opsi 3
            updateData() #memperbarui data
        elif pilihan == '4': #opsi 4
            hapusData() #menghapus data
        elif pilihan == '5': #opsi 5
            cariData() #mencari data
        elif pilihan == '6': #opsi 6
            print("Terima kasih telah menggunakan program ini")
            break #keluar dari loop, program selesai
        else:
            print("Pilihan tidak valid. Coba lagi") #jika opsi tidak dikenali

if __name__ == "__main__":
    main() #menjalankan fungsi utama
