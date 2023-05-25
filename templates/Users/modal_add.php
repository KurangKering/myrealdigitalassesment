<div class="card">
    <div class="card-body">
        <form action="<?= $this->Url->build('users/add') ?>" method="POST">
            <div id="form-message">

            </div>

            <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="address">address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
            </div>
            <div class="form-group">
                <label for="telephone">telephone</label>
                <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Enter telephone">
            </div>

            <div class="form-group">
                <label for="email">email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                    <?php foreach (USER_STATUS::all() as $k => $v) : ?>
                        <option value="<?= $v ?>"><?= $v ?></option>
                    <?php endforeach ?>
                </select>
            </div>

        </form>
    </div>
</div>