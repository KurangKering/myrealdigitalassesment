    <div class="card">
        <div class="card-body">
            <form action="<?= $this->Url->build('users/delete/' . $user->id) ?>" method="POST">
                <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
            </form>
            <div class="row">

                <div class="col-md-6">
                    <strong><i class="fas fa-address-card mr-1"></i> Name</strong>

                    <p class="text-muted">
                        <?= $user->name ?>
                    </p>

                    <hr>
                </div>

                <div class="col-md-6">
                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                    <p class="text-muted">
                        <?= $user->email ?>
                    </p>

                    <hr>
                </div>

                <div class="col-md-12">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                    <p class="text-muted"><?= $user->address ?></p>

                    <hr>
                </div>

                <div class="col-md-6">
                    <strong><i class="fas fa-phone mr-1"></i> Telephone</strong>

                    <p class="text-muted">
                        <?= $user->telephone ?>
                    </p>

                    <hr>
                </div>

                <div class="col-md-6">
                    <strong><i class="fas fa-modal-delete mr-1"></i> Status</strong>

                    <p class="text-muted">
                        <?= $user->status ?>
                    </p>

                    <hr>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->