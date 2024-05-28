<?php
if (isset($_GET['hal'])){
    $hal = (int)$_GET['hal'];
    $total_load = $hal * 2;

    if ($total_load > count($fileTable)) {
        $total_load = count($fileTable);
    }
} else {
    $hal = 1;
    $total_load = 2;
}

$thumbDir = "thumbnails/";

for ($i = 0; $i < $total_load; $i++) {
    echo "Iterasi ke-$i <br>";
    echo $fileTable[$i]. "<br>";
    $imageURL = $thumbDir . $fileTable[$i];
?>
    <div class="conten">
        <a href="">
            <img src="<?= $imageURL ?>" alt="gambar ke-<?= $i ?>" data-url="<?= $imageURL ?>" id="img-<?= $i ?>">
        </a>
    </div>
<?php
}
?>

<div class="next">
    <a href="view.php?hal=<?= $hal + 1; ?>"><span>Next</span></a>
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
