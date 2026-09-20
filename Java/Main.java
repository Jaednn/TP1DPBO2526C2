import java.util.Scanner;             //import untuk membaca input dari user
import java.util.ArrayList;           //import untuk menggunakan array dinamis (list of object)
import java.util.InputMismatchException; //import untuk menangkap error saat input tidak sesuai tipe data

public class Main
{
    // arraylist untuk menyimpan daftar film bioskop
    private static ArrayList<Film> daftarFilm = new ArrayList<>();
    // scanner untuk input dari user
    private static Scanner scanner = new Scanner(System.in);

    // fungsi untuk cek apakah id sudah ada di daftarFilm
    private static boolean isIdExists(String id)
    {
        for (Film film : daftarFilm) //looping ke semua elemen
        {
            if (film.getId().equals(id)) //jika id ditemukan ada yang sama
            {
                return true; //mengembalikan nilai true
            }
        }
        return false; //jika id tidak ada yang sama maka mengembalikan nilai false
    }

    // fungsi untuk mengisi data dummy film di awal program
    private static void isiDataDummy()
    {
        //menambahkan 6 objek Film contoh ke dalam arraylist
        daftarFilm.add(new Film("1", "Ghost in the Cell", "Joko Anwar", 50, 35000));
        daftarFilm.add(new Film("2", "Jatuh Cinta Seperti Di Film-Film", "Yandy Laurens", 30, 40000));
        daftarFilm.add(new Film("3", "Tunggu Aku Sukses", "Imanuel Kristo", 40, 35000));
        daftarFilm.add(new Film("4", "KKN di Desa Penari", "Awi Suryadi", 15, 45000));
        daftarFilm.add(new Film("5", "Agak Laen", "Muhadkly Acho", 60, 40000));
        daftarFilm.add(new Film("6", "Jumbo", "Ryan Adriandhy", 100, 38000));
    }

    // fungsi untuk menampilkan menu utama
    private static void tampilkanMenu()
    {
        //print pilihan menu
        System.out.println("\n<======== Menu LK21 Movie Indonesia ========>");
        System.out.println("1. Tambah Data Film");
        System.out.println("2. Tampilkan Semua Data Film");
        System.out.println("3. Update Data Film");
        System.out.println("4. Hapus Data Film");
        System.out.println("5. Cari Data Film");
        System.out.println("6. Keluar");
        System.out.print("Masukkan pilihan: ");
    }

    // Fungsi untuk menambahkan data film baru
    private static void tambahData()
    {
        System.out.println("\n--- Tambahkan Data Film ---");
        String id;
        // loop untuk memastikan id film unik
        do
        {
            System.out.print("\nId Film: ");
            id = scanner.nextLine(); //input id
            if (isIdExists(id))
            {
                System.out.println("ID ini sudah ada. Silakan masukkan ID lain."); //pesan error karena id sudah ada
            }
        } while (isIdExists(id)); //selama belum ada input valid maka akan terus looping

        System.out.print("\nJudul Film: ");
        String judul = scanner.nextLine(); //input judul film

        System.out.print("\nSutradara: ");
        String sutradara = scanner.nextLine(); //input nama sutradara

        int stok;
        // Validasi input numerik dan non-negatif untuk stok
        while (true)
        {
            try
            {
                System.out.print("\nStok Tiket: ");
                stok = scanner.nextInt(); //input stok
                if (stok < 0)
                {
                    System.out.println("Input tidak valid. Stok tidak boleh negatif.");
                }
                else //jika input valid
                {
                    break; //keluar dari loop
                }
            }
            catch (InputMismatchException e)
            {
                System.out.println("Input tidak valid. Silakan masukkan angka.");
                scanner.next(); // Buang input yang salah
            }
        }
        scanner.nextLine(); // Menghapus newline setelah nextInt()

        double harga;
        // Validasi input numerik dan non-negatif untuk harga
        while (true)
        {
            try
            {
                System.out.print("\nHarga Tiket: ");
                harga = scanner.nextDouble(); //input harga
                if (harga < 0) //jika input negatif
                {
                    System.out.println("Input tidak valid. Harga tidak boleh negatif.");
                }
                else //jika input valid
                {
                    break; //keluar dari loop
                }
            }
            catch (InputMismatchException e)
            {
                System.out.println("Input tidak valid. Silakan masukkan angka.");
                scanner.next(); // Buang input yang salah
            }
        }
        scanner.nextLine(); // Menghapus newline setelah nextDouble()

        // membuat objek baru Film dan menambahkannya ke arraylist
        Film filmBaru = new Film(id, judul, sutradara, stok, harga);
        daftarFilm.add(filmBaru); //memasukkan objek ke array
        System.out.println("\nData berhasil ditambahkan");
    }

    // fungsi untuk menampilkan semua data film
    private static void tampilkanData()
    {
        System.out.println("\n--- Daftar Film ---");
        if (daftarFilm.isEmpty()) //jika array kosong
        {
            System.out.println("\nData film kosong"); //pesan untuk array kosong
        }
        else
        {
            //jika array tidak kosong
            for (Film film : daftarFilm) //looping ke semua elemen array
            {
                film.tampilkanData(); //menampilkan data film
                System.out.println(); //newline sebagai pemisah
            }
        }
    }

    // fungsi untuk mengupdate data film berdasarkan id
    private static void updateData()
    {
        System.out.println("\n--- Update Data Film ---");
        System.out.print("Masukkan ID Film yang akan diupdate: ");
        String id_update = scanner.nextLine(); //input id yang ingin di update

        for (Film film : daftarFilm) //looping ke semua elemen film
        {
            if (film.getId().equals(id_update)) //jika elemen ditemukan
            {
                // update id film
                System.out.print("ID baru (" + film.getId() + "): ");
                String id_baru = scanner.nextLine();
                if (!id_baru.isEmpty())
                {
                    // kalau ID baru berbeda dengan ID lama
                    if (!id_baru.equals(film.getId()) && isIdExists(id_baru))
                    {
                        System.out.println("ID baru sudah digunakan, ID tidak diubah.");
                    }
                    else
                    {
                        film.setId(id_baru); //update id
                    }
                }

                // update judul film
                System.out.print("Judul Film baru (" + film.getJudul() + "): ");
                String judul_baru = scanner.nextLine(); //input
                if (!judul_baru.isEmpty()) //jika input diisi
                {
                    film.setJudul(judul_baru); //masukkan value baru
                }

                // update sutradara
                System.out.print("Sutradara baru (" + film.getSutradara() + "): ");
                String sutradara_baru = scanner.nextLine(); //input
                if (!sutradara_baru.isEmpty()) //jika input diisi
                {
                    film.setSutradara(sutradara_baru); //masukkan value baru
                }

                // update stok tiket
                System.out.print("Stok Tiket baru (" + film.getStok() + "): ");
                String stok_baru_str = scanner.nextLine(); //input
                if (!stok_baru_str.isEmpty()) //jika input diisi
                {
                    try
                    {
                        int stok_baru_int = Integer.parseInt(stok_baru_str);
                        if (stok_baru_int < 0) //jika input negatif
                        {
                            System.out.println("Input stok tidak valid. Stok tidak boleh negatif.");
                        }
                        else //jika input valid
                        {
                            film.setStok(stok_baru_int); //masukkan nilai baru
                        }
                    }
                    catch (NumberFormatException e)
                    {
                        //jika input bukan berupa angka
                        System.out.println("Input stok tidak valid. Data tidak diubah.");
                    }
                }

                // update harga tiket
                System.out.printf("Harga Tiket baru (%.0f): ", film.getHarga());
                String harga_baru_str = scanner.nextLine();
                if (!harga_baru_str.isEmpty()) //jika input diisi
                {
                    try
                    {
                        double harga_baru_double = Double.parseDouble(harga_baru_str);
                        if (harga_baru_double < 0) //jika input negatif
                        {
                            System.out.println("Input harga tidak valid. Harga tidak boleh negatif.");
                        }
                        else //jika input valid
                        {
                            film.setHarga(harga_baru_double); //masukkan nilai baru
                        }
                    }
                    catch (NumberFormatException e)
                    {
                        //jika input bukan berupa angka
                        System.out.println("Input harga tidak valid. Data tidak diubah.");
                    }
                }
                System.out.println("\nData film berhasil diupdate");
                return; //keluar dari fungsi karena sudah ditemukan dan diupdate
            }
        }
        System.out.println("Film dengan ID " + id_update + " tidak ditemukan"); //jika tidak ditemukan
    }

    // fungsi untuk menghapus data film berdasarkan id
    private static void hapusData()
    {
        System.out.println("\n--- Hapus Data Film ---");
        System.out.print("Masukkan ID Film yang akan dihapus: ");
        String id_hapus = scanner.nextLine(); //input

        for (int i = 0; i < daftarFilm.size(); i++) //looping ke semua elemen
        {
            if (daftarFilm.get(i).getId().equals(id_hapus)) //jika ditemukan elemen yang ingin dihapus
            {
                daftarFilm.remove(i); //menghapus elemen dari arraylist
                System.out.println("\nData film berhasil dihapus");
                return; //keluar dari fungsi
            }
        }
        System.out.println("Film dengan ID " + id_hapus + " tidak ditemukan"); //jika tidak ditemukan
    }

    // fungsi untuk mencari data film berdasarkan id
    private static void cariData()
    {
        System.out.println("\n--- Cari Data Film ---");
        System.out.print("Masukkan ID Film yang akan dicari: ");
        String id_cari = scanner.nextLine(); //input

        for (Film film : daftarFilm) //looping ke semua elemen
        {
            if (film.getId().equals(id_cari)) //jika id ditemukan
            {
                System.out.println("\nData film ditemukan");
                film.tampilkanData(); //menampilkan data film
                return; //keluar dari fungsi karena sudah ketemu
            }
        }
        System.out.println("Film dengan ID " + id_cari + " tidak ditemukan"); //jika tidak ditemukan
    }

    // main program
    public static void main(String[] args)
    {
        int pilihan; //variabel untuk menyimpan pilihan menu

        isiDataDummy(); //mengisi data dummy di awal program

        //selama belum input opsi keluar, maka proses akan terus berlanjut
        do
        {
            tampilkanMenu(); //menampilkan menu
            try
            {
                pilihan = scanner.nextInt(); //input opsi
                scanner.nextLine(); // menghapus newline setelah input int
            }
            catch (InputMismatchException e)
            {
                //jika input tidak valid
                System.out.println("Input tidak valid. Silakan masukkan angka.");
                scanner.nextLine(); // membuang input yang salah
                pilihan = 0; // nilai default agar loop berlanjut
            }

            // logika menu
            switch (pilihan)
            {
            case 1: tambahData(); break;    //opsi 1 menambah data
            case 2: tampilkanData(); break; //opsi 2 menampilkan data
            case 3: updateData(); break;    //opsi 3 memperbarui data
            case 4: hapusData(); break;     //opsi 4 menghapus data
            case 5: cariData(); break;      //opsi 5 mencari data
            case 6: System.out.println("Terima kasih telah menggunakan program ini"); break; //opsi 6 keluar
            default: System.out.println("Pilihan tidak valid. Coba lagi"); //opsi tidak dikenali
            }
        } while (pilihan != 6); //selama belum input opsi keluar
    }
}
