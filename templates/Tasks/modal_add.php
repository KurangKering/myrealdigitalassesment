<div class="card">
    <div class="card-body">
        <form action="<?= $this->Url->build('tasks/add') ?>" method="POST">
            <div id="form-message">

            </div>
            <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
            <div class="form-group">
                <label for="task_name">Task Name</label>
                <input type="text" class="form-control" name="task_name" id="task_name" placeholder="Enter Task Name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description"></textarea>
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