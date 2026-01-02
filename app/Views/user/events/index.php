<?php
include_once APPPATH . 'Views/layouts/header.php';
?>

<!-- Main Content -->
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col">
            <h4>Welcome, <?= esc(session()->get('name') ?? 'User') ?></h4>
            <p class="text-muted">You are logged as <b class="text-capitalize"><?= esc(session()->get('role') ?? 'User') ?></b> successfully. </p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3">

        <h4>Available Events</h4>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-responsive" >
            <tr>
                <th>Name</th>
                <th>Dates</th>
                <th>Action</th>
            </tr>

            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= esc($event['name']) ?></td>
                    <td><?= $event['start_date'] ?> → <?= $event['end_date'] ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="<?= base_url('user/events/' . $event['id'] . '/register') ?>">
                            Register
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>




    </div>

</div>

<?php
include_once APPPATH . 'Views/layouts/footer.php';
?>