<?php
include "functions.php";

header("Content-Type: application/json");

$result = readProduk();

$productArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $productArray[] = $row;
}

echo json_encode($productArray);
