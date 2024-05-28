<?php
if (isset($_GET['hal'])){
    $hal = $_GET['hal'];
    $total_load = $hal * 2;

    if ($total_load > $fileTable) {
        $total_load = $fileTable;
    }
} else {
    $hal = 1;
    $total_load = 1;
}

$dir = "img/";

// Mencari semua file dengan ekstensi tertentu (misalnya .jpg)
$files = glob($dir . "*.jpg");

// Membuat tabel virtual dalam memori
$fileTable = [];

// Memasukkan setiap nama file ke dalam tabel virtual
foreach ($files as $file) {
    $fileTable[] = basename($file);
}

// Menampilkan jumlah file yang telah dimuat
echo "Jumlah file yang dimuat: " . count($fileTable);

// Untuk melihat isi tabel virtual, Anda bisa menggunakan var_dump
echo "<pre>";
var_dump($fileTable);
echo "</pre>";



for ($i = 0; $i < $total_load; $i++) {
    echo "Iterasi ke-$i <br>";
    echo $fileTable[$i]. "<br>";
}

?>

<div class="conten">
    
</div>