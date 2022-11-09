<?php
include "../koneksi.php";

if (isset($_POST['tambah_siswa'])) {

    $nama = $_POST['nama_lengkap'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['notelp'];

    $sqlTambah = "INSERT INTO siswa (nama_lengkap, kelas, alamat, no_telp) VALUES ('$nama', '$kelas', '$alamat', '$no_telp')";
    $excsql = mysqli_query($koneksi, $sqlTambah);

    if ($excsql) {
        header("location: ../index.php?Tambah-Siswa-Berhasil");
    } else {
        header("location: ../index.php?Tambah-Siswa-Gagal");
    }
} elseif (isset($_POST['edit_siswa'])) {

    $id = $_POST['id_siswa'];
    $nama = $_POST['nama_lengkap'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['notelp'];

    $sqlEdit = "UPDATE siswa SET nama_lengkap='$nama', kelas='$kelas', alamat='$alamat', no_telp='$no_telp' WHERE id_siswa=$id";
    $excsql = mysqli_query($koneksi, $sqlEdit);

    if ($excsql) {
        header("location: ../index.php?Edit-Siswa-Berhasil");
    } else {
        header("location: ../index.php?Edit-Siswa-Gagal");
    }
} elseif (isset($_POST['hapus_siswa'])) {

    $id = $_POST['id_siswa'];

    $sqlHapus = "DELETE FROM siswa WHERE id_siswa=$id";
    $excsql = mysqli_query($koneksi, $sqlHapus);

    if ($excsql) {
        header("location: ../index.php?Hapus-Siswa-Berhasil");
    } else {
        header("location: ../index.php?Hapus-Siswa-Gagal");
    }
} else {
    echo "Anda Mencurigakan";
}
