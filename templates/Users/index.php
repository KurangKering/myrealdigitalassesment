<?php
$this->assign('pageTitle', 'List of Users');
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"></h3>
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="modalAdd()">New User</a>
                </div>
            </div>
            <div class="card-body">
                <div class="users index content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('id') ?></th>
                                    <th><?= $this->Paginator->sort('name') ?></th>
                                    <th><?= $this->Paginator->sort('telephone') ?></th>
                                    <th><?= $this->Paginator->sort('email') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $this->Number->format($user->id) ?></td>
                                        <td><?= h($user->name) ?></td>
                                        <td><?= h($user->telephone) ?></td>
                                        <td><?= h($user->email) ?></td>
                                        <td><?= h($user->status) ?></td>
                                        <td class="actions" width="1%" style="white-space: nowrap">
                                            <button class="btn btn-sm btn-info" onclick="modalView(<?= $user->id; ?>)"><i class="fas fa-info-circle mr-1"></i> View</button>
                                            <button class="btn btn-sm btn-warning" onclick="modalEdit(<?= $user->id; ?>)"><i class="fas fa-pencil-alt mr-1"></i> Edit</button>
                                            <button class="btn btn-sm btn-danger" data-name="<?= $user->name ?>" onclick="modalDelete(<?= $user->id; ?>)"><i class="fas fa-trash mr-1"></i> Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->first('<< ' . __('first')) ?>
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                            <?= $this->Paginator->last(__('last') . ' >>') ?>
                        </ul>
                        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->start('customScript'); ?>
<script>
    $(function() {

    });

    function modalAdd() {
        showModal({
            size: MODAL_SIZE.LARGE,
            src: '<?= $this->Url->build('users/modal-add') ?>',
            title: 'New User',
            submitButton: 'Save',
            cancelButton: 'Cancel',
            onSubmit: ($modal, response) => {
                if (response.success) {
                    $modal.close();
                    after(TOAST_TIMER, () => {
                        window.location.reload();
                    });
                }
            },
        });
    }

    function modalView(id) {
        showModal({
            size: MODAL_SIZE.LARGE,
            src: '<?= $this->Url->build('users/modal-view/') ?>' + id,
            title: 'View User',
        });
    }

    function modalEdit(id) {
        showModal({
            size: MODAL_SIZE.LARGE,
            src: '<?= $this->Url->build('users/modal-edit/') ?>' + id,
            title: 'Edit User',
            submitButton: 'Update',
            onSubmit: ($modal, response) => {
                if (response.success) {
                    $modal.close();
                    after(TOAST_TIMER, () => {
                        window.location.reload();
                    });
                }
            }
        });
    }

    function modalDelete(id) {
        showModal({
            size: MODAL_SIZE.LARGE,
            src: '<?= $this->Url->build('users/modal-delete/') ?>' + id,
            title: 'Delete User',
            submitButton: 'Delete',
            onSubmit: ($modal, response) => {
                if (response.success) {
                    $modal.close();
                    after(TOAST_TIMER, () => {
                        window.location.reload();
                    });
                }
            }
        });
    }
</script>
<?php $this->end() ?>