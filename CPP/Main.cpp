#include "Film.cpp" //import class Film yang sudah dibuat
#include <vector>    //librari untuk menggunakan array dinamis 
#include <limits>    //librari untuk numeric_limits 

using namespace std;

vector<Film> daftarFilm; //deklarasi array/list of object untuk menyimpan seluruh data film

// Fungsi untuk memeriksa apakah ID sudah ada di daftarFilm
bool isIdExists(const string& id)
{
    for (const auto& film : daftarFilm) //looping untuk seluruh elemen dalam array
    {
        if (film.getId() == id) //jika ada id yang sama persis
        {
            return true; //mengembalikan nilai true (id sudah dipakai)
        }
    }
    return false; //jika tidak ditemukan id yang sama, berarti id unik
}

// Fungsi untuk mengisi beberapa data dummy film di awal program 
void isiDataDummy()
{
    daftarFilm.push_back(Film("1", "Ghost in the Cell", "Joko Anwar", 50, 35000));
    daftarFilm.push_back(Film("2", "Jatuh Cinta Seperti Di Film-Film", "Yandy Laurens", 30, 40000));
    daftarFilm.push_back(Film("3", "Tunggu Aku Sukses", "Imanuel Kristo", 40, 35000));
    daftarFilm.push_back(Film("4", "KKN di Desa Penari", "Awi Suryadi", 15, 45000));
    daftarFilm.push_back(Film("5", "Agak Laen", "Muhadkly Acho", 60, 40000));
    daftarFilm.push_back(Film("6", "Jumbo", "Ryan Adriandhy", 100, 38000));
}

//prosedur untuk menampilkan menu yang bisa diakses
void tampilkanMenu()
{
    //print pilihan menu ke layar
    cout << "\n<======== Menu LK21 Movie Indonesia ========>" << endl
        << "1. Tambah Data Film" << endl
        << "2. Tampilkan Semua Data Film" << endl
        << "3. Update Data Film" << endl
        << "4. Hapus Data Film" << endl
        << "5. Cari Data Film" << endl
        << "6. Keluar" << endl
        << "Masukkan pilihan: ";
}

//prosedur untuk menambah data film baru
void tambahData()
{
    //deklarasi variabel sementara untuk menampung input
    string id, judul, sutradara;
    int stok;
    double harga;

    cout << "\n--- Tambahkan Data Film ---" << endl;
    //do while untuk error handling jika id yang dimasukkan sudah ada
    do {
        cout << "\nId Film: ";
        cin >> id; //input id
        if (isIdExists(id))
        {
            //jika id sudah ada
            cout << "ID ini sudah ada. Silakan masukkan ID lain." << endl;
        }
    } while (isIdExists(id)); //selama id yang dimasukkan masih ada, maka akan meminta input yang valid

    cin.ignore(numeric_limits<streamsize>::max(), '\n'); //membersihkan sisa newline di buffer
    cout << "\nJudul Film: ";
    getline(cin, judul); //input judul film (bisa mengandung spasi)

    cout << "\nSutradara: ";
    getline(cin, sutradara); //input nama sutradara (bisa mengandung spasi)

    // Error handling untuk input stok yang berisikan non number dan angka negatif
    while (true) {
        cout << "\nStok Tiket: ";
        cin >> stok; //input stok
        if (cin.fail() || stok < 0)
        {
            //jika input tidak valid dan negatif
            cout << "Input tidak valid. Silakan masukkan angka positif." << endl;
            cin.clear(); //membersihkan status error input
            cin.ignore(numeric_limits<streamsize>::max(), '\n'); //membuang input yang salah
        }
        else
        {
            cin.ignore(numeric_limits<streamsize>::max(), '\n'); // membersihkan buffer setelah input valid
            break; //keluar dari loop karena input sudah valid
        }
    }

    // Error handling untuk input harga
    while (true) {
        cout << "\nHarga Tiket: ";
        cin >> harga; //input harga
        if (cin.fail() || harga <= 0)
        {
            //jika input tidak valid dan negatif/nol
            cout << "Input tidak valid. Silakan masukkan harga positif." << endl;
            cin.clear(); //membersihkan status error input
            cin.ignore(numeric_limits<streamsize>::max(), '\n'); // membersihkan buffer setelah input tidak valid
        }
        else
        {
            cin.ignore(numeric_limits<streamsize>::max(), '\n'); // membersihkan buffer setelah input valid
            break; //keluar dari loop karena input sudah valid
        }
    }

    // Tambahkan objek Film baru ke dalam vector
    daftarFilm.push_back(Film(id, judul, sutradara, stok, harga)); //menambahkan data kedalam array
    cout << "\nData berhasil ditambahkan" << endl; //pesan berhasil
}

//prosedur untuk menampilkan seluruh data film
void tampilkanData()
{
    cout << "\n--- Daftar Film ---" << endl;
    if (daftarFilm.empty())
    {
        //jika array film kosong
        cout << "\nData film kosong" << endl;
    }
    //looping untuk menampilkan seluruh data
    for (const auto& film : daftarFilm)
    {
        film.tampilkanData(); //memanggil method tampilkanData milik objek film
        cout << "\n"; //print newline sebagai pemisah antar data
    }
}

//prosedur untuk memperbarui data film berdasarkan ID
void updateData()
{
    string id_update; //atribut untuk menyimpan id tujuan
    cout << "\n--- Update Data Film ---" << endl;
    cout << "Masukkan ID Film yang akan diupdate: ";
    cin >> id_update; //input id yang dicari
    cin.ignore(numeric_limits<streamsize>::max(), '\n'); //membersihkan sisa newline di buffer

    //looping untuk mencari film dengan id yang sesuai
    for (auto& film : daftarFilm)
    {
        //jika id yang dicari cocok
        if (film.getId() == id_update)
        {
            string id_baru;
            cout << "ID baru (" << film.getId() << "): ";
            getline(cin, id_baru); //input id baru
            if (!id_baru.empty())
            {
                // cek apakah id baru dipakai film lain
                if (id_baru != film.getId() && isIdExists(id_baru))
                {
                    cout << "ID baru sudah digunakan, ID tidak diubah." << endl;
                }
                else
                {
                    film.setId(id_baru); //update id jika valid
                }
            }

            string judul_baru;
            cout << "Judul Film baru (" << film.getJudul() << "): ";
            getline(cin, judul_baru); //input judul baru
            if (!judul_baru.empty())
            {
                //jika input diisi
                film.setJudul(judul_baru); //update judul film
            }

            string sutradara_baru;
            cout << "Sutradara baru (" << film.getSutradara() << "): ";
            getline(cin, sutradara_baru); //input sutradara baru
            if (!sutradara_baru.empty())
            {
                //jika input diisi
                film.setSutradara(sutradara_baru); //update sutradara
            }

            string stok_baru;
            cout << "Stok Tiket baru (" << film.getStok() << "): ";
            getline(cin, stok_baru); //input stok baru dalam bentuk string dulu
            if (!stok_baru.empty())
            {
                //jika input diisi
                film.setStok(stoi(stok_baru)); //ubah ke int lalu masukkan ke dalam atribut
            }

            string harga_baru;
            cout << "Harga Tiket baru (" << film.getHarga() << "): ";
            getline(cin, harga_baru); //input harga baru dalam bentuk string dulu
            if (!harga_baru.empty())
            {
                //jika input diisi
                film.setHarga(stod(harga_baru)); //ubah ke double lalu masukkan ke dalam atribut
            }

            cout << "\nData film berhasil diupdate" << endl;
            return; //keluar dari fungsi karena sudah ketemu dan diupdate
        }
    }
    //jika looping selesai tapi id tidak ditemukan
    cout << "Film dengan ID " << id_update << " tidak ditemukan" << endl;
}

//prosedur untuk menghapus data film berdasarkan ID
void hapusData()
{
    string id_hapus; //atribut untuk id yang ingin dihapus
    cout << "\n--- Hapus Data Film ---" << endl;
    cout << "Masukkan ID Film yang akan dihapus: ";
    cin >> id_hapus; //input id yang ingin dihapus

    //looping untuk mencari posisi film yang ingin dihapus
    for (auto iterator = daftarFilm.begin(); iterator != daftarFilm.end(); ++iterator)
    {
        if (iterator->getId() == id_hapus) //jika id ditemukan
        {
            daftarFilm.erase(iterator); //hapus data dari vector
            cout << "\nData film berhasil dihapus" << endl;
            return; //keluar dari fungsi karena sudah selesai
        }
    }
    //jika looping selesai tapi id tidak ditemukan
    cout << "Film dengan ID " << id_hapus << " tidak ditemukan" << endl;
}

//prosedur untuk mencari data film berdasarkan ID
void cariData()
{
    string id_cari; //atribut untuk id yang dicari
    bool found = false; //flag untuk menandai apakah data ditemukan
    cout << "\n--- Cari Data Film ---" << endl;
    cout << "Masukkan ID Film yang akan dicari: ";
    cin >> id_cari; //input id yang dicari

    //looping untuk semua elemen dalam array
    for (const auto& film : daftarFilm)
    {
        if (film.getId() == id_cari) //jika id ditemukan
        {
            cout << "\nData film ditemukan" << endl;
            film.tampilkanData(); //menampilkan data film yang ditemukan
            found = true; //set flag menjadi true
            return; //keluar dari fungsi karena sudah ketemu
        }
    }
    if (!found) {
        cout << "\nData film tidak ditemukan" << endl; //pesan jika tidak ditemukan
    }
}

int main()
{
    int pilihan; //variabel untuk menyimpan pilihan menu user

    isiDataDummy(); //mengisi data dummy di awal supaya program langsung ada isinya

    //selama belum input opsi keluar, maka proses akan terus berlanjut
    do
    {
        tampilkanMenu(); //menampilkan menu
        cin >> pilihan; //input opsi menu
        switch (pilihan)
        {
            case 1: tambahData(); break;    //opsi 1 menambah data
            case 2: tampilkanData(); break; //opsi 2 menampilkan data
            case 3: updateData(); break;    //opsi 3 memperbarui data
            case 4: hapusData(); break;     //opsi 4 menghapus data
            case 5: cariData(); break;      //opsi 5 mencari data
            case 6: cout << "Terima kasih telah menggunakan program ini" << endl; break; //opsi 6 keluar
            default: cout << "Pilihan tidak valid. Coba lagi" << endl; //jika opsi tidak dikenali
        }
    } while (pilihan != 6); //selama belum input opsi keluar
    return 0; //program selesai dengan status sukses
}
