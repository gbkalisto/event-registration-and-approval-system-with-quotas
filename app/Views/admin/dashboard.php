<?php
include_once APPPATH . 'Views/layouts/header.php';
?>

<!-- Main Content -->
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col">
            <h4>Welcome, <?= esc(session()->get('name') ?? 'User') ?></h4>
            <p class="text-muted">You are logged in as <?= esc(session()->get('role') ?? 'User') ?> successfully.</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3">

        <!-- Create Event -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Create Event</h5>
                    <p class="card-text">Submit a new event for approval.</p>
                    <a href="<?= base_url('admin/events/create') ?>" class="btn btn-primary btn-sm">
                        Create Event
                    </a>
                </div>
            </div>
        </div>

        <!-- My Events -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">My Events</h5>
                    <p class="card-text">View your submitted events.</p>
                    <a href="<?= base_url('admin/events') ?>" class="btn btn-primary btn-sm">
                        View Events
                    </a>
                </div>
            </div>
        </div>

       

    </div>

</div>

<?php
include_once APPPATH . 'Views/layouts/footer.php';
?>