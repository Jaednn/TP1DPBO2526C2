<?php
require_once 'Film.php'; //mengambil class Film yang sudah dibuat
session_start(); //mengaktifkan session PHP untuk menyimpan data selama browser masih terbuka

// Reset SESSION jika tombol reset ditekan
if (isset($_POST['reset_data'])) {
    session_unset();      //menghapus semua variabel session
    session_destroy();    //menghancurkan session yang aktif
    header("Location: Main.php"); //redirect kembali ke halaman utama
    exit(); //biar exit langsung page nya
}

// Inisialisasi session dengan data dummy jika belum pernah diisi sebelumnya
if (!isset($_SESSION['daftarFilm'])) {
    //data tidak disimpan di database, cukup disimpan sementara di $_SESSION sesuai spesifikasi tugas
    $_SESSION['daftarFilm'] = [
        new Film("1", "Ghost in the Cell", "Joko Anwar", 50, 35000, ""),
        new Film("2", "Jatuh Cinta Seperti Di Film-Film", "Yandy Laurens", 30, 40000, ""),
        new Film("3", "Tunggu Aku Sukses", "Imanuel Kristo", 40, 35000, ""),
        new Film("4", "KKN di Desa Penari", "Awi Suryadi", 15, 45000, ""),
        new Film("5", "Agak Laen", "Muhadkly Acho", 60, 40000, ""),
        new Film("6", "Jumbo", "Ryan Adriandhy", 100, 38000, ""),
    ]; //array of object berisi data dummy film
}

$message = '';      //variabel untuk menampung pesan notifikasi ke user
$message_type = ''; //variabel untuk menyimpan jenis pesan (success/error/warning), dipakai untuk styling

//helper untuk mengecek apakah ID sudah ada di dalam list film
function isIdExists($id, $list) {
    foreach ($list as $item) //looping ke semua elemen list
    {
        if ($item->getId() === $id) //jika id ditemukan sama / tidak unik
        {
            return true; //mengembalikan nilai true
        }
    }
    return false; //jika id unik, mengembalikan nilai false
}

// Proses tambah film baru
if (isset($_POST['tambah'])) {
    $id_film = trim($_POST['id_film']);           //input id, trim untuk membersihkan spasi
    $judul_film = trim($_POST['judul_film']);     //input judul film
    $sutradara = trim($_POST['sutradara']);       //input nama sutradara
    $stok = $_POST['stok'];                       //input stok tiket
    $harga = $_POST['harga'];                     //input harga tiket

    // Validasi input
    if (empty($id_film) || empty($judul_film) || empty($sutradara) || !is_numeric($stok) || !is_numeric($harga) || $stok < 0 || $harga < 0) {
        $message = "❌ Input tidak valid. Pastikan semua field terisi, serta Stok dan Harga berupa angka positif.";
        $message_type = 'error';
    } elseif (isIdExists($id_film, $_SESSION['daftarFilm'])) //mengecek apakah id sudah dipakai atau belum
    {
        //jika id sudah dipakai film lain
        $message = "❌ ID sudah ada. Gagal menambahkan film.";
        $message_type = 'error';
    } else {
        //jika seluruh input valid
        // Upload gambar poster film
        $gambar = ''; //default kosong jika tidak upload gambar
        if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] == 0) //jika ada file yang diupload dan tidak error
        {
            $target_dir = "./images/"; //folder tujuan penyimpanan gambar (lokal, bukan url)
            if (!is_dir($target_dir)) mkdir($target_dir); //jika folder belum ada, buat foldernya
            $target_file = $target_dir . time() . "_" . basename($_FILES["gambar"]["name"]); //nama file unik pakai timestamp
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) //pindahkan file upload ke folder tujuan
            {
                $gambar = $target_file; //simpan path lokal gambar ke variabel
            }
        }

        $film_baru = new Film($id_film, $judul_film, $sutradara, (int)$stok, (float)$harga, $gambar); //buat objek Film baru
        $_SESSION['daftarFilm'][] = $film_baru; //masukkan objek baru ke dalam array session

        $message = "✅ Film berhasil ditambahkan!"; //pesan sukses
        $message_type = 'success';
    }
}

// Proses hapus film
if (isset($_GET['action']) && $_GET['action'] === 'hapus' && isset($_GET['id'])) {
    $id_hapus = $_GET['id']; //ambil id film yang ingin dihapus dari url
    //menyimpan ulang array tanpa film yang id-nya cocok dengan id_hapus
    $_SESSION['daftarFilm'] = array_values(array_filter($_SESSION['daftarFilm'], fn($f) => $f->getId() !== $id_hapus));
    $message = "🗑️ Film berhasil dihapus!"; //pesan sukses
    $message_type = 'success';
    header("Location: Main.php"); //redirect kembali ke halaman utama agar url bersih
    exit();
}

//function untuk memproses update film berdasarkan id
function updateFilm($id_update) {
    global $message, $message_type; //mengambil variabel global agar bisa diubah dari dalam fungsi
    foreach ($_SESSION['daftarFilm'] as $film) //looping ke semua elemen film
    {
        if ($film->getId() === $id_update) //jika id ditemukan
        {
            $id_baru = trim($_POST['id_baru']);          //input id baru
            $judul_baru = trim($_POST['judul_film']);    //input judul baru
            $sutradara_baru = trim($_POST['sutradara']); //input sutradara baru
            $stok_baru = $_POST['stok'];                 //input stok baru
            $harga_baru = $_POST['harga'];                //input harga baru

            // Validasi input
            if (empty($judul_baru) || empty($sutradara_baru) || !is_numeric($stok_baru) || !is_numeric($harga_baru) || $stok_baru < 0 || $harga_baru < 0) {
                $message = "❌ Input tidak valid. Pastikan semua field terisi, serta Stok dan Harga berupa angka positif.";
                $message_type = 'error';
                return [$message, $message_type];
            }

            // update ID film jika diubah
            if (!empty($id_baru) && $id_baru !== $film->getId())
            {
                if (isIdExists($id_baru, $_SESSION['daftarFilm'])) //jika id baru sudah dipakai film lain
                {
                    //error
                    $message = "⚠️ ID baru sudah digunakan, ID tidak diubah.";
                    $message_type = 'warning';
                } else {
                    $film->setId($id_baru); //jika valid, update id
                }
            }

            // update judul
            $film->setJudul($judul_baru);

            // update sutradara
            $film->setSutradara($sutradara_baru);

            // update stok
            $film->setStok((int)$stok_baru);

            // update harga
            $film->setHarga((float)$harga_baru);

            // update gambar jika ada upload baru
            if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] == 0) {
                $target_dir = "./images/"; //folder tujuan
                if (!is_dir($target_dir)) mkdir($target_dir); //cek dan buat folder jika belum ada
                $target_file = $target_dir . time() . "_" . basename($_FILES["gambar"]["name"]);
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file))
                {
                    $film->setGambar($target_file); //update path gambar
                }
            }

            // hanya tampilkan pesan sukses kalau tidak ada warning sebelumnya
            if ($message_type !== 'warning') {
                $message = "✏️ Film berhasil diupdate!";
                $message_type = 'success';
            }

            return [$message, $message_type]; //langsung keluar dari fungsi setelah film ditemukan
        }
    }
    $message = "Film tidak ditemukan.";
    $message_type = 'error';
    return [$message, $message_type]; //kalau film dengan id tersebut tidak ada
}

//eksekusi proses update jika tombol update ditekan
if (isset($_POST['update'])) {
    [$message, $message_type] = updateFilm($_POST['id_film']); //panggil fungsi update
}

// Proses cari film berdasarkan id
$hasil_cari = $_SESSION['daftarFilm']; //default: tampilkan semua film
if (isset($_GET['cari'])) //cek apakah tombol cari ditekan
{
    $id_cari = trim($_GET['cari_id']); //input id yang dicari
    //cari film dengan id yang sesuai di dalam array session
    $hasil_cari = array_values(array_filter($_SESSION['daftarFilm'], fn($f) => $f->getId() === $id_cari));
    if (empty($hasil_cari)) {
        $message = "Film dengan ID '$id_cari' tidak ditemukan.";
        $message_type = 'warning';
    }
}

// Fungsi untuk mengambil satu objek Film berdasarkan ID
function getFilmById($id) {
    foreach ($_SESSION['daftarFilm'] as $film) //looping ke semua elemen
    {
        if ($film->getId() === $id) //jika id film ditemukan
        {
            return $film; //langsung kembalikan objek film tersebut
        }
    }
    return null; //kalau tidak ketemu, kembalikan null
}

//variabel default untuk mengisi form saat mode edit
$edit_id = $edit_judul = $edit_sutradara = $edit_stok = $edit_harga = $edit_gambar = '';
if (isset($_GET['edit_id'])) //jika ada parameter edit_id di url
{
    $film = getFilmById($_GET['edit_id']); //cari objek film yang ingin diedit
    if ($film !== null) {
        $edit_id        = $film->getId();        //ambil value id untuk ditaruh di form
        $edit_judul     = $film->getJudul();      //ambil value judul untuk ditaruh di form
        $edit_sutradara = $film->getSutradara();  //ambil value sutradara untuk ditaruh di form
        $edit_stok      = $film->getStok();       //ambil value stok untuk ditaruh di form
        $edit_harga     = $film->getHarga();      //ambil value harga untuk ditaruh di form
        $edit_gambar    = $film->getGambar();     //ambil value path gambar untuk ditaruh di form
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Film Bioskop</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
    min-height: 100vh;
    background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.container {
    width: 100%;
    max-width: 1200px;
    background: rgba(255, 255, 255, 0.92);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 2.2rem;
    letter-spacing: 1px;
}

.message {
    padding: 14px;
    margin-bottom: 18px;
    border-radius: 8px;
    font-weight: bold;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.success { background: #d4edda; color: #155724; }
.error { background: #f8d7da; color: #721c24; }
.warning { background: #fff3cd; color: #856404; }

form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: #fdfdfd;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #eee;
}

form input, form button {
    padding: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: 0.3s ease;
}

form input:focus {
    border-color: #e17055;
    outline: none;
    box-shadow: 0 0 6px rgba(225, 112, 85, 0.3);
}

form button {
    cursor: pointer;
    font-weight: bold;
    border: none;
    transition: transform 0.2s ease, opacity 0.2s ease;
}

form button:hover { transform: translateY(-2px); opacity: 0.9; }

.btn-tambah { background: #2ecc71; color: white; }
.btn-update { background: #3498db; color: white; }
.btn-reset { background: #e74c3c; color: white; }

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

th, td { padding: 14px; border: 1px solid #eee; text-align: left; }

thead { background: linear-gradient(135deg, #fd7e14, #e17055); color: white; }

tbody tr:nth-child(even) { background: #f9f9f9; }
tbody tr:hover { background: #fff3ea; }

.actions a {
    padding: 7px 12px;
    border-radius: 6px;
    color: white;
    text-decoration: none;
    margin-right: 5px;
    font-size: 13px;
    transition: 0.2s ease;
}

.actions a:hover { opacity: 0.85; }
.edit { background: #f39c12; }
.delete { background: #e74c3c; }

.poster-img {
    max-width: 90px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.search-container { display: flex; justify-content: center; margin: 20px 0; }

.search-container form {
    display: flex;
    gap: 10px;
    width: 100%;
    max-width: 500px;
    background: transparent;
    border: none;
    padding: 0;
}

.search-container input { flex: 1; border-radius: 8px; }

.search-container button {
    background: #d63031;
    color: white;
    border: none;
    border-radius: 8px;
}

.reset-container { text-align: center; margin-top: 20px; }

.btn-showall {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 14px;
    background: #7f8c8d;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s;
}

.btn-showall:hover { opacity: 0.9; }
</style>
</head>
<body>
<div class="container">
    <h1>🎬 Manajemen Film Bioskop</h1>

    <?php if ($message): ?>
        <div class="message <?= $message_type; ?>"><?= $message; ?></div>
    <?php endif; ?>

    <form action="Main.php" method="POST" enctype="multipart/form-data">
        <h2><?= $edit_id ? '✏️ Update Film' : '➕ Tambah Film'; ?></h2>
        <?php if ($edit_id): ?>
            <input type="hidden" name="id_film" value="<?= htmlspecialchars($edit_id); ?>"> <input type="text" name="id_baru" value="<?= htmlspecialchars($edit_id); ?>" placeholder="ID Film"> <?php else: ?>
            <input type="text" name="id_film" placeholder="ID Film" required>
        <?php endif; ?>

        <input type="text" name="judul_film" value="<?= htmlspecialchars($edit_judul); ?>" placeholder="Judul Film" required>
        <input type="text" name="sutradara" value="<?= htmlspecialchars($edit_sutradara); ?>" placeholder="Sutradara" required>
        <input type="number" name="stok" value="<?= htmlspecialchars($edit_stok); ?>" placeholder="Stok Tiket" required>
        <input type="number" step="0.01" name="harga" value="<?= htmlspecialchars($edit_harga); ?>" placeholder="Harga Tiket" required>
        <input type="file" name="gambar">
        <?php if ($edit_gambar): ?>
            <p>🖼️ <a href="<?= htmlspecialchars($edit_gambar); ?>" target="_blank">Lihat Poster Saat Ini</a></p>
        <?php endif; ?>
        <button type="submit" name="<?= $edit_id ? 'update' : 'tambah'; ?>" class="<?= $edit_id ? 'btn-update' : 'btn-tambah'; ?>">
            <?= $edit_id ? 'Update' : 'Tambah'; ?>
        </button>
    </form>

    <div class="search-container">
        <form action="Main.php" method="GET" style="display:flex; gap:10px; width:100%; max-width:500px;">
            <input type="text" name="cari_id" placeholder="Cari berdasarkan ID Film" required>
            <button type="submit" name="cari">Cari</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Film</th>
                <th>Sutradara</th>
                <th>Stok Tiket</th>
                <th>Harga Tiket</th>
                <th>Poster</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($hasil_cari)): ?>
                <tr><td colspan="7" style="text-align:center;">🚫 Tidak ada data film.</td></tr>
            <?php else: ?>
                <?php foreach ($hasil_cari as $film): ?>
                    <tr>
                        <td><?= htmlspecialchars($film->getId()); ?></td>
                        <td><?= htmlspecialchars($film->getJudul()); ?></td>
                        <td><?= htmlspecialchars($film->getSutradara()); ?></td>
                        <td><?= htmlspecialchars($film->getStok()); ?></td>
                        <td><?= 'Rp ' . number_format($film->getHarga(), 2, ',', '.'); ?></td>
                        <td>
                            <?php if ($film->getGambar()): ?>
                                <img src="<?= htmlspecialchars($film->getGambar()); ?>" class="poster-img">
                            <?php else: ?>
                                ❌ Tidak ada
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <a href="Main.php?edit_id=<?= urlencode($film->getId()); ?>" class="edit">Update</a>
                            <a href="Main.php?action=hapus&id=<?= urlencode($film->getId()); ?>" class="delete" onclick="return confirm('Yakin hapus film ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (isset($_GET['cari'])): ?>
        <div style="text-align:center;">
            <a href="Main.php" class="btn-showall">🔄 Tampilkan Semua</a>
        </div>
    <?php endif; ?>

    <div class="reset-container">
        <form action="Main.php" method="POST">
            <button type="submit" name="reset_data" class="btn-reset" onclick="return confirm('Hapus semua data?');">🧹 Reset Data</button>
        </form>
    </div>
</div>
</body>
</html>
