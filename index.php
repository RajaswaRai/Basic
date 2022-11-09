<?php
include "koneksi.php";
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="fa/css/all.css">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Tabel Siswa</h1>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Siswa Baru
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        if (empty($hal = $_GET['hal']) || !is_numeric($hal)) {
                            $hal = 1;
                        } else {
                            $hal = $_GET['hal'];
                        }

                        $limit = 5;
                        $start = ceil(($hal * $limit) - $limit);

                        $sqlfilter = "SELECT * FROM siswa LIMIT $start,$limit";
                        $excfilter = mysqli_query($koneksi, $sqlfilter);

                        // $selectSiswa = "SELECT * FROM siswa";
                        // $excsql = mysqli_query($koneksi, $selectSiswa);
                        $no = $start + 1;

                        while ($dataSiswa = mysqli_fetch_array($excfilter)) {
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $dataSiswa['nama_lengkap'] ?></td>
                                <td><?php echo $dataSiswa['kelas'] ?></td>
                                <td><?php echo $dataSiswa['alamat'] ?></td>
                                <td><?php echo $dataSiswa['no_telp'] ?></td>
                                <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $no ?>"><i class="fa-solid fa-pen-to-square"></i></button> <button class="btn  btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo $no ?>"><i class="fa-solid fa-trash"></i></button></td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Siswa</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/crud_modal/crud/crud_siswa.php" method="POST">

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                        <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo $dataSiswa['nama_lengkap'] ?>" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="kelas" class="form-label">Kelas</label>
                                                        <select class="form-select" name="kelas" id="kelas" required>
                                                            <option value="12 RPL 1">12 RPL 1</option>
                                                            <option value="12 RPL 2">12 RPL 2</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3" required><?php echo $dataSiswa['alamat'] ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="nomor" class="form-label">Nomor Telepon</label>
                                                        <input class="form-control" type="number" name="notelp" id="nomor" required value="<?php echo $dataSiswa['no_telp'] ?>">
                                                    </div>
                                                </div>
                                        </div>

                                        <input type="hidden" name="id_siswa" value="<?php echo $dataSiswa['id_siswa'] ?>">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" name="edit_siswa" class="btn btn-primary">Simpan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="modalHapus<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Siswa</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda Yakin ingin menghapus data siswa bernama "<?php echo $dataSiswa['nama_lengkap'] ?>?"
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <form action="/crud_modal/crud/crud_siswa.php" method="POST">
                                                <input type="hidden" name="id_siswa" value="<?php echo $dataSiswa['id_siswa'] ?>">
                                                <button name="hapus_siswa" type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>



                <nav aria-label="...">
                    <ul class="pagination">
                        <?php

                        $sqlpaging = "SELECT * FROM siswa";
                        $excpaging = mysqli_query($koneksi, $sqlpaging);
                        $data = mysqli_num_rows($excpaging);
                        $paging = ceil($data / $limit);

                        for ($i = 1; $i <= $paging; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='index.php?hal=$i'>$i</a></li>";
                        }

                        ?>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>

        <form action="/crud_modal/crud/crud_siswa.php" method="POST">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select class="form-select" name="kelas" id="kelas" required>
                                        <option selected disabled>-PILIH-</option>
                                        <option value="12 RPL 1">12 RPL 1</option>
                                        <option value="12 RPL 2">12 RPL 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="nomor" class="form-label">Nomor Telepon</label>
                                    <input class="form-control" type="number" name="notelp" id="nomor" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button name="tambah_siswa" type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>