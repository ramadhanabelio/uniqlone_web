<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'uniqlone';

$mysqli = new mysqli($hostname, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Koneksi ke database gagal: " . $mysqli->connect_error);
}

function createProduk($nama, $kategori, $deskripsi, $gambar)
{
    global $mysqli;

    $query = "INSERT INTO produk (nama, kategori, deskripsi, gambar) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssss", $nama, $kategori, $deskripsi, $gambar);

    $target_dir = "img/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

    $stmt->execute();
    $stmt->close();
}

function readProduk()
{
    global $mysqli;

    $query = "SELECT * FROM produk";
    $product = $mysqli->query($query);

    return $product;
}

function updateProduk($id, $nama, $kategori, $deskripsi, $gambar)
{
    global $mysqli;

    if (!empty($gambar)) {
        $query = "UPDATE produk SET nama=?, kategori=?, deskripsi=?, gambar=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssi", $nama, $kategori, $deskripsi, $gambar, $id);

        $target_dir = "img/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES["edit_gambar"]["tmp_name"], $target_file);

        $stmt->execute();
        $stmt->close();
    } else {
        $query = "UPDATE produk SET nama=?, kategori=?, deskripsi=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssi", $nama, $kategori, $deskripsi, $id);

        $stmt->execute();
        $stmt->close();
    }
}

function deleteProduk($id)
{
    global $mysqli;

    $query = "DELETE FROM produk WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
