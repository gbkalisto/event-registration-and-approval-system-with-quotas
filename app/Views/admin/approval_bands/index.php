<?php
include_once APPPATH . 'Views/layouts/header.php';
?>


<div class="container mt-4">

    <h4>
        Approval Bands for Event:
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

    <!-- Existing Approval Bands -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($bands): ?>
                <?php foreach ($bands as $band): ?>
                    <tr>
                        <td><?= $band['band_order'] ?></td>
                        <td><?= ucfirst($band['role']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center text-muted">
                        No approval bands defined
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <!-- Add New Approval Band -->
    <h5>Add Approval Band</h5>

    <form method="post" action="">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-3">
                <label>Order</label>
                <input type="number" name="band_order"
                    class="form-control" min="1" required>
            </div>

            <div class="col-md-5">
                <label>Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Select Role</option>
                    <option value="manager">Manager</option>
                    <option value="director">Director</option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary">
                    Save Band
                </button>
            </div>
        </div>
    </form>

</div>

<?php
include_once APPPATH . 'Views/layouts/footer.php';
?>