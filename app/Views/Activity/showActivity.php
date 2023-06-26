<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">My Activities</h1>

<h4><a href="<?= site_url("Activity/add")?>">Add Activity<i class="fa-solid fa-plus ms-1"></i></a></h4>
<div class="list-group">
    <?php
        foreach($activity as $k=>$a){
            $bg = $k%2==0 ? "bg-dark" : "bg-secondary";
            echo "<div class='list-group-item text-light border-5 {$bg}'>
                    <a class='text-light text-decoration-none' href='".site_url('Activity/edit/'.$a['id'])."'>
                        <span><span style='width:1rem;height:1rem;background:{$a["color"]}' class='rounded-circle d-inline-block me-1'></span>{$a["name"]}<span class='text-white-50'> ({$a["priority"]})</span></span>
                    </a>
                    <a class='ms-1 mt-1 float-end text-danger' href='".site_url("Activity/delete/{$a["id"]}")."'>
                        <i class='fa-solid fa-trash'></i>
                    </a>
                </div>";
        }
    ?>
</div>
<?= $this->endSection() ?>