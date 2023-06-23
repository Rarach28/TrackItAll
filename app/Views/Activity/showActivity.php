<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">showActivity view</h1>

<h4><a href="<?= site_url("addActivity")?>">Create Activity <i class="fa-solid fa-plus"></i></a></h4>

<?php
    foreach($activity as $a){
        echo "<div>{$a["name"]}</div>";
    }
?>

<?= $this->endSection() ?>