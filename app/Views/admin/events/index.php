<?php
include_once APPPATH . 'Views/layouts/header.php';
?>

<!-- Main Content -->
<div class="container mt-4">
    <h4>
        Event List
    </h4>

    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary btn-sm mb-3">
        ← Back to Dashboard
    </a>

    <!-- Dashboard Cards -->
    <div class="row g-3">

        <!-- Create Event -->
        <div class="col-md-12">
            <table class="table table-border table-responsive" border="1" cellpadding="5">
                <tr>
                    <th>Name</th>
                    <th>Dates</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= esc($event['name']) ?></td>
                        <td><?= $event['start_date'] ?> → <?= $event['end_date'] ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="<?= base_url('admin/events/' . $event['id'] . '/edit') ?>">Edit</a> 
                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/events/' . $event['id'] . '/quotas') ?>">Quotas</a> 
                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/events/' . $event['id'] . '/approval-bands') ?>">Approval Bands</a> 
                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/events/' . $event['id'] . '/form-fields') ?>">Form Fields</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>



    </div>

</div>

<?php
include_once APPPATH . 'Views/layouts/footer.php';
?>