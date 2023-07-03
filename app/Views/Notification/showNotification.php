<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">Missed Notifications</h1>

<a class="text-light btn btn-primary" href="<?= site_url("Notification/add")?>">Add Notification<i class="fa-solid fa-plus ms-1"></i></a>

<?= $notifications;?>

<?= $this->endSection() ?>