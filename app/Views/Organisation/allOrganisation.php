<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2"><?= $title ?? ""?></h1>
<a class="text-light btn btn-primary" href="<?= site_url("Organisation/add")?>">Add Organisation<i class="fa-solid fa-plus ms-1"></i></a>

<div class="w-100">
<?php foreach($organisations as $o){?>
    <div class="card bg-dark border-3 border-primary my-3">
        <div class="card-header">
            <span class="d-flex justify-content-between">
                <span><a href="<?= base_url("Organisation/detail/".$o["url"])?>"><?=$o["name"]?></a> </span>
                <span><?=count($o["user_ids"])?><i class="ms-1 fa-solid fa-users"></i></span>
            </span>
            <div class="text-muted">
                <?= $o["description"]?>
            </div>
        </div>
        <div class="card-body">
            <?= $o["description"]?>
        </div>
    </div>
<?php }?>
</div>

<?= $this->endSection() ?>