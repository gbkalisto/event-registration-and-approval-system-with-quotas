<?php
include_once APPPATH . 'Views/layouts/header.php';
?>

<!-- Main Content -->
<div class="container mt-4">

    <h4>
        Quotas for Event:
        <strong><?= esc($event['name']) ?></strong>
    </h4>

    <a href="<?= base_url('admin/events') ?>" class="btn btn-secondary btn-sm mb-3">
        ← Back to Events
    </a>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Existing Quotas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role</th>
                <th>Max Participants</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($quotas): ?>
                <?php foreach ($quotas as $quota): ?>
                    <tr>
                        <td><?= ucfirst($quota['role']) ?></td>
                        <td><?= $quota['max_participants'] ?></td>
                        <!-- <td><a class="btn btn-sm btn-danger" href="<?= base_url('admin/quotas/' . $quota['id'] . '/delete') ?>">Delete</a></td> -->
                        <td>
                            <a class="btn btn-sm btn-danger"
                                href="<?= base_url('admin/quotas/' . $quota['id'] . '/delete') ?>"
                                onclick="return confirm('Are you sure you want to delete this quota? This action cannot be undone.');">
                                Delete
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center text-muted">
                        No quotas defined yet
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <!-- Add New Quota -->
    <h5>Add New Quota</h5>

    <form method="post" action="">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-4">
                <label>Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Select Role</option>
                    <option value="employee">Employee</option>
                    <option value="manager">Manager</option>
                    <option value="director">Director</option>
                    <option value="external">External</option>
                </select>
            </div>

            <div class="col-md-4">
                <label>Max Participants</label>
                <input type="number" name="max_participants"
                    class="form-control" min="1" required>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary">
                    Save Quota
                </button>
            </div>
        </div>
    </form>

</div>



<?php
include_once APPPATH . 'Views/layouts/footer.php';
?>