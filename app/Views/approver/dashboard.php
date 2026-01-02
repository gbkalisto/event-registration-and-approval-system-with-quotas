<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard | Event Approval System</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">

        <h4>Approver Dashboard</h4>

        <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm mb-3">
            Logout
        </a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php if ($registrations): ?>
                    <?php foreach ($registrations as $reg): ?>
                        <tr>
                            <td><?= esc($reg['event_name']) ?></td>
                            <td><?= esc($reg['user_name']) ?></td>
                            <td><?= ucfirst($reg['status']) ?></td>
                            <td>
                                <!-- <form method="post" action="<?= base_url('approver/registrations/' . $reg['id'] . '/approve') ?>" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form> -->

                                <!-- <form method="post" action="<?= base_url('approver/registrations/' . $reg['id'] . '/reject') ?>" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form> -->
                                <form method="post" action="<?= base_url('approver/registrations/' . $reg['id'] . '/approve') ?>" class="mb-1">
                                    <?= csrf_field() ?>
                                    <input type="text" name="remarks" class="form-control mb-1"
                                        placeholder="Approval remarks (optional)">
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>

                                <form method="post" action="<?= base_url('approver/registrations/' . $reg['id'] . '/reject') ?>">
                                    <?= csrf_field() ?>
                                    <input type="text" name="remarks" class="form-control mb-1"
                                        placeholder="Rejection reason" required>
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No pending approvals
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>