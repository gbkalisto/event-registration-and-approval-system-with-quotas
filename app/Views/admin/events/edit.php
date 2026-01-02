<?php
include_once APPPATH . 'Views/layouts/header.php';
?>

<!-- Main Content -->
<div class="container mt-4">
    <h4>
        Edit Event
    </h4>

    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary btn-sm mb-3">
        ← Back to Dashboard
    </a>
    <!-- Dashboard Cards -->
    <div class="row g-3">

        <!-- Create Event -->
        <div class="col-md-8 mx-auto">
            <form method="post" action="<?= base_url('admin/events/' . $event['id'] . '/edit') ?>">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Event Name</label>
                    <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder" value="<?= esc($event['name']) ?>">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Event Description</label>
                    <textarea name="description" id="description" class="form-control"><?= esc($event['description']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Start date</label>
                    <input type="date" class="form-control" name="start_date" id="formGroupExampleInput2" value="<?= esc($event['start_date']) ?>">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">End date</label>
                    <input type="date" class="form-control" name="end_date" id="formGroupExampleInput2" value="<?= esc($event['end_date']) ?>">
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>



    </div>

</div>

<?php
include_once APPPATH . 'Views/layouts/footer.php';
?>