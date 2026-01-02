<?php
include_once APPPATH . 'Views/layouts/header.php';
?>

<div class="container mt-4">

    <h4>
        Form Fields for Event:
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

    <!-- Existing Fields -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Label</th>
                <th>Field Name</th>
                <th>Type</th>
                <th>Required</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($nodes): ?>
                <?php foreach ($nodes as $node): ?>
                    <tr>
                        <td><?= esc($node['label']) ?></td>
                        <td><?= esc($node['field_name']) ?></td>
                        <td><?= esc($node['field_type']) ?></td>
                        <td><?= $node['required'] ? 'Yes' : 'No' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        No form fields defined
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <!-- Add New Field -->
    <h5>Add Form Field</h5>

    <form method="post" action="">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-3">
                <label>Label</label>
                <input name="label" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label>Field Name</label>
                <input name="field_name" class="form-control"
                    placeholder="e.g. department" required>
            </div>

            <div class="col-md-3">
                <label>Type</label>
                <select name="field_type" class="form-select" required>
                    <option value="text">Text</option>
                    <option value="email">Email</option>
                    <option value="number">Number</option>
                    <option value="dropdown">Dropdown</option>
                </select>
            </div>

            <div class="col-md-2">
                <label>Required</label><br>
                <input type="checkbox" name="required" value="1" checked>
            </div>

            <div class="col-md-12 mt-2">
                <label>Field Options (comma separated for dropdown)</label>
                <input name="field_options" class="form-control"
                    placeholder="e.g. HR,IT,Sales">
            </div>

            <div class="col-md-12 mt-3">
                <button class="btn btn-primary">
                    Save Field
                </button>
            </div>
        </div>
    </form>

</div>

<?php
include_once APPPATH . 'Views/layouts/footer.php';
?>