<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">My Activities</h1>

<h4><a href="<?= site_url("addActivity")?>">Add Activity<i class="fa-solid fa-plus ms-1"></i></a></h4>
<div class="list-group">
    <?php
        foreach($activity as $a){
            echo "<div class='list-group-item border-5 mb-1' style='border-bottom:solid {$a["color"]}'>
                
                {$a["name"]} 
                <a class='ms-1 float-end' href='deleteActivity/{$a["id"]}'>
                    <i class='fa-solid fa-trash'></i>
                </a>
                <a class='ms-1 float-end' href='editActivity/{$a["id"]}'>
                    <i class='fa-regular fa-pen-to-square'></i>
                </a>
            </div>";
        }
    ?>
</div>
<?= $this->endSection() ?>