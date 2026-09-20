class Film:
    # constructor, dipanggil otomatis saat objek Film dibuat
    def __init__(self, id_film: str, judul_film: str, sutradara: str, stok_tiket: int, harga_tiket: float):

        self.__id_film = str(id_film)         #inisialisasi atribut id_film (private, encapsulation)
        self.__judul_film = str(judul_film)   #inisialisasi atribut judul_film
        self.__sutradara = str(sutradara)     #inisialisasi atribut sutradara
        self.__stok_tiket = int(stok_tiket)   #inisialisasi atribut stok_tiket
        self.__harga_tiket = float(harga_tiket) #inisialisasi atribut harga_tiket

    # Getter untuk mengambil data
    def getId(self):
        return self.__id_film #mengembalikan nilai id_film

    def getJudul(self):
        return self.__judul_film #mengembalikan nilai judul_film

    def getSutradara(self):
        return self.__sutradara #mengembalikan nilai sutradara

    def getStok(self):
        return self.__stok_tiket #mengembalikan nilai stok_tiket

    def getHarga(self):
        return self.__harga_tiket #mengembalikan nilai harga_tiket

    # Setter untuk merubah value
    def setId(self, id_film):
        self.__id_film = id_film #mengubah value atribut dengan value baru

    def setJudul(self, judul_film):
        self.__judul_film = judul_film #mengubah value atribut dengan value baru

    def setSutradara(self, sutradara):
        self.__sutradara = sutradara #mengubah value atribut dengan value baru

    def setStok(self, stok_tiket):
        if stok_tiket >= 0: #tidak boleh angka negatif
            self.__stok_tiket = stok_tiket #mengubah value atribut dengan value baru
        else:
            print("Stok tiket tidak boleh negatif.") #pesan jika angka negatif

    def setHarga(self, harga_tiket):
        if harga_tiket > 0: #tidak boleh angka negatif/nol
            self.__harga_tiket = harga_tiket #mengubah value atribut dengan value baru
        else:
            print("Harga tiket harus lebih dari 0.") #pesan jika angka tidak valid

    #prosedur untuk menampilkan seluruh data film
    def tampilkanData(self):
        #print seluruh atribut ke layar
        print("ID           :", self.getId())
        print("Judul Film   :", self.getJudul())
        print("Sutradara    :", self.getSutradara())
        print("Stok Tiket   :", self.getStok())
        print("Harga Tiket  : Rp", self.getHarga())
