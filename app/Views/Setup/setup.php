<?= $this->extend('Global/layout') ?>
<?= $this->section('content') ?>

<h1>Setup</h1>

<div wind="pill-menu">
    <div class="flex overflow-x-scroll scroll-hide">
        <div class="pill-menu-item" wind="pill-migrations">
            <i class="fas fa-database"></i> Migrations
        </div>
        <div class="pill-menu-item" wind="pill-permissions">
            <i class="fas fa-flag"></i> Permissions
        </div>
    </div>
    <div class="pill-menu-container">
        <div class="pill-menu" wind="pill-migrations">
            <div class="flex justify-between">
                <h3>Database migrations</h3>
                <a id="client-runmigrations" class="btn btn-primary">Run all migrations</a>
            </div>
            <div class=" space-y-2">
                <?php foreach ($migrations as $migration) { ?>
                    <div class="accordion">
                        <div class="accordion-heading !cursor-default">
                            <span>
                                Branch <?= $migration['migration'] ?> - Revision <?= $migration['revision_formatted'] ?>
                            </span>
                            <div>
                                <?php if (!$migration['isInstalled']) { ?>
                                    <button class="btn btn-primary !p-1 w-9 h-9"><i class="fas fa-circle-xmark text-red-500 bg-white rounded-full"></i></button>
                                <?php } else { ?>
                                    <button class="btn btn-primary !p-1 w-9 h-9"><i class="fas fa-circle-check text-green-500 bg-white rounded-full"></i></button>
                                <?php } ?>
                            </div>
                        </div>
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
                                modals.showModal($("#migrations-modal"));
                                $(document).on('modalClosing', (ev) => {
                                    if (ev.detail.modal.attr('id') == $('#migrations-modal').attr('id')) {
                                        window.location.reload();
                                    }
                                });
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
        <div class="pill-menu" wind="pill-permissions">
            <h3>App permissions</h3>
            <button id="client-runpermissions" class="btn btn-primary">Regenerate permissions</button>
            <p class="mt-2">All current permission will be kept, descriptions will be updated and new permissions added.</p>
            <script>
                $("#client-runpermissions").on('click', (ev) => {
                    // modals.generateModal('loadingModal', {
                    //     'title': 'Running...',
                    //     'description': 'This may take a while...'
                    // })
                    $.ajax({
                        url: "<?= base_url('/ajax/setup/runPermissions') ?>",
                        type: "POST",
                        success: function(data) {
                            let response = JSON.parse(data);
                            if (response.code == 200) {
                                // modals.generateModal('successModal', {
                                //     'title': 'Success!',
                                //     'description': response.message,
                                // })
                                $(document).on('modalClosing', (ev) => {
                                    if (ev.detail.modal.attr('id') == $('#success-modal').attr('id')) {
                                        window.location.reload();
                                    }
                                });
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

<!-- MODAL SPACE -->
<div class="hidden">
    <div id="migrations-modal" class="modal-window w-[40rem] h-72">
        <div class="flex h-full mx-2">
            <div class="flex flex-col justify-center items-center h-full">
                <div class="h-full flex justify-center items-center">
                    <i class="fas fa-circle-check fa-3x fa-beat-fade text-clienty-600" style="--fa-animation-duration: 2s; --fa-beat-fade-opacity: 0.9; --fa-beat-fade-scale: 1.075;"></i>
                </div>
                <div class="h-full text-center">
                    <span class=" text-2xl">
                        Success!
                    </span>
                    <p>
                        Migrations have been run.
                    </p>
                    <div>
                        <button class="btn btn-primary mt-2" onclick="modals.hideModal()">Okay</button>
                    </div>
                </div>
            </div>
            <div class=" overflow-y-scroll w-full">
                <p>Migrations log</p>
                <div id="client-migration-log"></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>