#include <iostream>
#include <string>
#include <iomanip> 

using namespace std;

//deklarasi class Film untuk merepresentasikan data film di Bioskop
class Film
{
    private:
        //private atribut, hanya bisa diakses dari dalam class ini sendiri 
        string id_film;      //ID unik untuk tiap film
        string judul_film;   //judul film yang tayang
        string sutradara;    //nama sutradara film
        int stok_tiket;      //jumlah tiket/kursi yang masih tersedia
        double harga_tiket;  //harga tiket untuk menonton film ini

    public:
    // constructor, dipanggil otomatis saat objek Film dibuat
    Film(string id, string judul, string sutradara, int stok, double harga)
    {
        setId(id);           //inisialisasi id lewat setter
        setJudul(judul);     //inisialisasi judul lewat setter
        setSutradara(sutradara); //inisialisasi sutradara lewat setter
        setStok(stok);       //inisialisasi stok lewat setter 
        setHarga(harga);     //inisialisasi harga lewat setter 
    }

    //setter untuk merubah value id
    void setId(const string& id)
    {
        this->id_film = id; //inisialisasi/ubah atribut id_film
    }

    //setter untuk merubah value judul
    void setJudul(const string& judul)
    {
        this->judul_film = judul; //inisialisasi/ubah atribut judul_film
    }

    //setter untuk merubah value sutradara
    void setSutradara(const string& sutradara)
    {
        this->sutradara = sutradara; //inisialisasi/ubah atribut sutradara
    }

    //setter untuk merubah value stok, dengan validasi
    void setStok(const int& stok)
    {
        if (stok >= 0) //stok tidak boleh negatif
        {
            this->stok_tiket = stok; //inisialisasi/ubah atribut stok_tiket
        }
        else
        {
            cout << "Stok tiket tidak boleh negatif." << endl; //pesan jika input tidak valid
        }
    }

    //setter untuk merubah value harga, dengan validasi
    void setHarga(const double& harga)
    {
        if (harga > 0) //harga harus lebih dari 0
        {
            this->harga_tiket = harga; //inisialisasi/ubah atribut harga_tiket
        }
        else
        {
            cout << "Harga tiket harus lebih dari 0." << endl; //pesan jika input tidak valid
        }
    }

    // getter untuk mengambil value id
    string getId() const
    {
        return id_film; //mengembalikan nilai id_film
    }

    // getter untuk mengambil value judul
    string getJudul() const
    {
        return judul_film; //mengembalikan nilai judul_film
    }

    // getter untuk mengambil value sutradara
    string getSutradara() const
    {
        return sutradara; //mengembalikan nilai sutradara
    }

    // getter untuk mengambil value stok
    int getStok() const
    {
        return stok_tiket; //mengembalikan nilai stok_tiket
    }

    // getter untuk mengambil value harga
    double getHarga() const
    {
        return harga_tiket; //mengembalikan nilai harga_tiket
    }

    //prosedur untuk menampilkan seluruh data film
    void tampilkanData() const
    {
        //print seluruh atribut film ke layar
        cout << "ID           : " << getId() << endl
            << "Judul Film   : " << getJudul() << endl
            << "Sutradara    : " << getSutradara() << endl
            << "Stok Tiket   : " << getStok() << endl
            << "Harga Tiket  : Rp" << fixed << setprecision(0) << getHarga() << endl;
    }

    //destructor, dipanggil otomatis saat objek dihapus/keluar dari scope
    ~Film()
    {
    }
};
