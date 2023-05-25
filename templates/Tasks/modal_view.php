<div class="card">
    <div class="card-body">
        <strong><i class="fas fa-bars mr-1"></i> Task Name</strong>
        <p class="text-muted">
            <?= $task->task_name ?>
        </p>
        <hr>
        <strong><i class="fas fa-info mr-1"></i> Description</strong>
        <p class="text-muted">
            <?= $task->description ?>
        </p>
        <strong><i class="fas fa-dot-circle mr-1"></i> Status</strong>
        <p class="text-muted">
            <?= $task->status ?>
        </p>
        <hr>
    </div>
</div>