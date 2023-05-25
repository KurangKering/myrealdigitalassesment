<div class="card">
    <div class="card-body">
        <form action="<?= $this->Url->build('users/edit/' . $user->id) ?>" method="POST">
            <div id="form-message">
            </div>
            <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="<?= $user->name ?>">
            </div>
            <div class="form-group">
                <label for="address">address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Enter address" value="<?= $user->address ?>">
            </div>
            <div class="form-group">
                <label for="telephone">telephone</label>
                <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Enter telephone" value="<?= $user->telephone ?>">
            </div>

            <div class="form-group">
                <label for="email">email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" value="<?= $user->email ?>">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                    <?php foreach (USER_STATUS::all() as $k => $v) : ?>
                        <?php
                        $selected = ($user->status == $v) ? 'selected' : '';
                        ?>
                        <option <?= $selected ?> value="<?= $v ?>"><?= $v ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- /.card-body -->
        </form>
    </div>
</div>