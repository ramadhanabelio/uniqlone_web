<?php
include("functions.php");

// Create
if (isset($_POST['tambah_produk'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];

    if (createProduk($nama, $kategori, $deskripsi, $gambar)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan');</script>";
    }

    redirect("index.php");
}

// Read
$products = readProduk();

// Update
if (isset($_POST['edit_produk'])) {
    $edit_id = $_POST['edit_id'];
    $edit_nama = $_POST['edit_nama'];
    $edit_kategori = $_POST['edit_kategori'];
    $edit_deskripsi = $_POST['edit_deskripsi'];
    $edit_gambar = isset($_FILES['edit_gambar']['name']) ? $_FILES['edit_gambar']['name'] : '';

    if (updateProduk($edit_id, $edit_nama, $edit_kategori, $edit_deskripsi, $edit_gambar)) {
        echo "<script>alert('Data berhasil diubah');</script>";
    } else {
        echo "<script>alert('Data gagal diubah');</script>";
    }

    redirect("index.php");
}

// Delete
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (deleteProduk($id)) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
    }

    redirect("index.php");
}

function redirect($location)
{
    header("Location: $location");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIQLONE - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="img/UNIQLO.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-light fixed-top border-bottom">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="img/UNIQLO Logo.png" alt="UNIQLO Logo" width="120px"></a>
            <form class="d-flex" role="tambah">
                <a href="api.php" class="btn btn-outline-danger me-3">API</a>
                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tambahModal">+ Tambah Produk</a>
            </form>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container mt-5 pt-5 mb-3">
        <div class="table-responsive">
            <table id="productTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $i = 1;
                    while ($res = mysqli_fetch_array($products)) :
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $res['nama'] ?></td>
                            <td><?= $res['kategori'] ?></td>
                            <td><?= $res['deskripsi'] ?></td>
                            <td><img src='./uploads/<?= $res['gambar'] ?>' width='200' class='img-thumbnail rounded mx-auto d-block'></td>
                            <td>
                                <a href="#" class='badge text-bg-primary text-decoration-none' data-bs-toggle="modal" data-bs-target="#editModal<?= $res['id'] ?>"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="#" class='badge text-bg-danger text-decoration-none' data-bs-toggle="modal" data-bs-target="#deleteModal<?= $res['id'] ?>"><i class="bi bi-trash"></i> Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit Produk -->
                        <div class="modal fade" id="editModal<?= $res['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="edit_id" value="<?= $res['id'] ?>">

                                            <div class="mb-3">
                                                <label for="current_image" class="form-label">Gambar</label>
                                                <img src='./uploads/<?= $res['gambar'] ?>' width='200' class='img-thumbnail rounded mx-auto d-block'>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit_nama" class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" name="edit_nama" value="<?= $res['nama'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_kategori" class="form-label">Kategori</label>
                                                <input type="text" class="form-control" name="edit_kategori" value="<?= $res['kategori'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="edit_deskripsi" rows="4" required><?= $res['deskripsi'] ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_gambar" class="form-label">Gambar Baru</label>
                                                <input type="file" class="form-control" id="edit_gambar" name="edit_gambar">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary" name="edit_produk">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal Edit Produk -->

                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="deleteModal<?= $res['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <a href='index.php?id=<?= $res['id'] ?>' class='btn btn-danger'>Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Konfirmasi Hapus -->
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah Produk -->
        <div class="modal fade" id="tambahModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan nama produk..." required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control" name="kategori" placeholder="Masukkan kategori..." required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" name="tambah_produk">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal Tambah Produk -->
    </div>

    <footer class="bg-light pt-3 pb-3 text-center border-top text-muted">
        Kelompok 12 - Indah Wahyuni & M. Yaniko Atta
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <!-- My JS -->
    <script src="js/script.js"></script>
</body>

</html>