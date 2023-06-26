<?= $this->extend('Global/layout') ?>
<?= $this->section('content') ?>

<h1>Setup</h1>

<div wind="pill-menu">
   <div class="pill-menu-container">
        <div class="pill-menu" wind="pill-migrations">
            <div class="flex justify-between">
                <h3>Database migrations</h3>
                <a id="client-runmigrations" class="btn btn-primary">Run all migrations</a>
            </div>
            <div class=" mt-2">
                <?php foreach ($migrations as $migration) { ?>
                    <div class="my-2">
                        <span>
                            <?php if (!$migration['isInstalled']) { ?>
                                <button class="btn btn-danger"><i class="fas fa-circle-xmark rounded-circle"></i></button>
                            <?php } else { ?>
                                <button class="btn btn-success"><i class="fas fa-circle-check rounded-circle"></i></button>
                            <?php } ?>
                        </span>
                        <span>
                            Branch <?= $migration['migration'] ?> - Revision <?= $migration['revision_formatted'] ?>
                        </span>
                    </div>
                <?php } ?>
            </div>

            <script>
                $("#client-runmigrations").on('click', (ev) => {
                    // modals.generateModal('loadingModal', {
                    //     'title': 'Running...',
                    //     'description': 'This may take a while...'
                    // })
                    $.ajax({
                        url: "<?= base_url('/ajax/setup/runDatabase') ?>",
                        type: "POST",
                        success: function(data) {
                            let response = JSON.parse(data);
                            if (response.code == 200) {
                                $("#client-migration-log").html(response.log);
                                // modals.showModal($("#migrations-modal"));
                                // $(document).on('modalClosing', (ev) => {
                                //     if (ev.detail.modal.attr('id') == $('#migrations-modal').attr('id')) {
                                //         window.location.reload();
                                //     }
                                // });
                            } else {
                                // modals.generateModal('errorModal', {
                                //     'title': 'Error ' + response.code,
                                //     'description': response.message,
                                // })
                            }
                        },
                        error: function(data) {
                            // modals.generateModal('errorModal', {
                            //     'title': 'Error',
                            //     'description': 'Something went wrong, please try again later.',
                            // })
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>

<div id="client-migration-log"></div>

<?= $this->endSection() ?>