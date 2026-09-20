//deklarasi class Film untuk merepresentasikan data film di Bioskop
public class Film
{
    //private atribut, hanya bisa diakses dari dalam class ini sendiri (encapsulation)
    private String id_film;     //ID unik untuk tiap film
    private String judul_film;  //judul film yang tayang
    private String sutradara;   //nama sutradara film
    private int stok_tiket;     //jumlah tiket/kursi yang masih tersedia
    private double harga_tiket; //harga tiket untuk menonton film ini

    // Constructor, dipanggil otomatis saat objek Film dibuat
    public Film(String id_baru, String judul_baru, String sutradara_baru, int stok_baru, double harga_baru)
    {
        this.id_film = id_baru;         //inisialisasi atribut id_film
        this.judul_film = judul_baru;   //inisialisasi atribut judul_film
        this.sutradara = sutradara_baru;//inisialisasi atribut sutradara
        this.stok_tiket = stok_baru;    //inisialisasi atribut stok_tiket
        this.harga_tiket = harga_baru;  //inisialisasi atribut harga_tiket
    }

    // Getter (untuk mendapatkan nilai atribut)
    public String getId()
    {
        return id_film; //mengembalikan nilai atribut id_film
    }

    public String getJudul()
    {
        return judul_film; //mengembalikan nilai atribut judul_film
    }

    public String getSutradara()
    {
        return sutradara; //mengembalikan nilai atribut sutradara
    }

    public int getStok()
    {
        return stok_tiket; //mengembalikan nilai atribut stok_tiket
    }

    public double getHarga()
    {
        return harga_tiket; //mengembalikan nilai atribut harga_tiket
    }

    // Setter (untuk mengubah nilai atribut)
    public void setId(String id_film)
    {
        this.id_film = id_film; //menginisialisasi atribut dengan value baru
    }

    public void setJudul(String judul_film)
    {
        this.judul_film = judul_film; //menginisialisasi atribut dengan value baru
    }

    public void setSutradara(String sutradara)
    {
        this.sutradara = sutradara; //menginisialisasi atribut dengan value baru
    }

    public void setStok(int stok)
    {
        if (stok >= 0) //stok tidak boleh negatif
        {
            this.stok_tiket = stok; //menginisialisasi atribut dengan value baru
        }
        else
        {
            //jika stok negatif
            System.out.println("Stok tiket tidak boleh negatif.");
        }
    }

    public void setHarga(double harga)
    {
        if (harga > 0) //harga harus lebih dari 0
        {
            this.harga_tiket = harga; //menginisialisasi value baru
        }
        else
        {
            //jika harga tidak valid
            System.out.println("Harga tiket harus lebih dari 0.");
        }
    }

    //prosedur untuk menampilkan seluruh data film
    void tampilkanData()
    {
        //print seluruh atribut ke layar
        System.out.println("ID           : " + getId());
        System.out.println("Judul Film   : " + getJudul());
        System.out.println("Sutradara    : " + getSutradara());
        System.out.println("Stok Tiket   : " + getStok());
        System.out.printf("Harga Tiket  : Rp%.0f\n", getHarga());
    }
}
