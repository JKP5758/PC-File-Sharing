<?php
if (isset($_GET['hal'])){
    // end
    $hal = (int)$_GET['hal'];
    $akhir_load = $hal * $load;

    //mulai
    $hal_mulai = $hal - 1;
    $mulai_load = $hal_mulai * $load;

    $all = false;

    if ($akhir_load > count($fileTable)) {
        $akhir_load = count($fileTable);
        $mulai_load = count($fileTable) - 15;
        $all = true;
    }
} else {
    $hal = 1;
    $akhir_load = $load;
    $mulai_load = 0;
    $all = false;
}

$thumbDir = "thumbnails/";

for ($i = $mulai_load; $i < $akhir_load; $i++) {
    // echo "Iterasi ke-$i <br>";
    // echo $fileTable[$i]. "<br>";
    $imageURL = $thumbDir . $fileTable[$i];
?>
    <div class="conten">
        <a href="http://192.168.43.2:8080/share/Wallpaper/<?= $fileTable[$i]; ?>" target="_blank">
            <img src="<?= $imageURL ?>" alt="gambar ke-<?= $i ?>" data-url="<?= $imageURL ?>" id="img-<?= $i ?>">
        </a>
    </div>
<?php
}
?>

<div class="next">
    <?php
        if (isset($_GET['hal']) && $_GET['hal'] > 1){
            echo '<a href="view.php?hal=' . ($hal - 1) . '"><span class="next_button">Previous</span></a>';
        }

        if($all == false){
            echo '<a href="view.php?hal=' . ($hal + 1) . '"><span class="next_buton">Next</span></a>';
        }
    ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const images = document.querySelectorAll('img[data-url]');
    images.forEach(img => {
        const url = img.getAttribute('data-url');
        if (!localStorage.getItem(url)) {
            localStorage.setItem(url, url);
        }
    });

    images.forEach(img => {
        const url = img.getAttribute('data-url');
        if (localStorage.getItem(url)) {
            img.src = localStorage.getItem(url);
        }
    });
});
</script>
