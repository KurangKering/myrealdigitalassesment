<div class="card">
    <div class="card-body">
        <form action="<?= $this->Url->build('tasks/edit/' . $task->id) ?>" method="POST">
            <div id="form-message">
            </div>

            <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
            <div class="form-group">
                <label for="task_name">Task Name</label>
                <input type="text" class="form-control" name="task_name" id="task_name" placeholder="Enter Task Name" value="<?= $task->task_name ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description"><?= $task->description ?></textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                    <?php foreach (TASK_STATUS::all() as $k => $v) : ?>
                        <?php
                        $selected = ($task->status == $v) ? 'selected' : '';
                        ?>
                        <option <?= $selected ?> value="<?= $v ?>"><?= $v ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- /.card-body -->
        </form>
    </div>
</div>