<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">tracker view</h1>

<script>
    function toast(){
        $.ajax({
            type: 'POST',
            url: "<?=site_url("ajax");?>",
            data: {
                action: "testToast"
            },
            // async:false,
            success: function (response) {
               $("#toastWrpapper").append(response);
            }
        });
    };
</script>
<?= $this->endSection() ?>