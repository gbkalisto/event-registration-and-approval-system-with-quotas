<?php
include_once APPPATH . 'Views/layouts/header.php';
?>

<!-- Main Content -->
<div class="container mt-4">
    <h4>
        Form Fields for Event:
        <strong><?= esc($event['name']) ?></strong>
    </h4>

    <a href="<?= base_url('user/events') ?>" class="btn btn-secondary btn-sm mb-3">
        ← Back to Events
    </a>

    <!-- Dashboard Cards -->
    <div class="row g-3">

        <!-- Create Event -->
        <div class="col-md-8 mx-auto">
            <h4>Register for <?= esc($event['name']) ?></h4>

            <form method="post">
                <?= csrf_field() ?>

                <?php foreach ($fields as $field): ?>
                    <div class="mb-3">
                        <label class="form-label"><?= esc($field['label']) ?></label>

                        <?php if ($field['field_type'] === 'text'): ?>

                           
                            <input
                                type="text"
                                name="<?= esc($field['field_name']) ?>"
                                class="form-control"
                                <?= $field['required'] ? 'required' : '' ?>>

                        <?php elseif ($field['field_type'] === 'number'): ?>
                            <input
                                type="number"
                                name="<?= esc($field['field_name']) ?>"
                                class="form-control"
                                <?= $field['required'] ? 'required' : '' ?>>

                        <?php elseif ($field['field_type'] === 'email'): ?>
                            <input
                                type="email"
                                name="<?= esc($field['field_name']) ?>"
                                class="form-control"
                                <?= $field['required'] ? 'required' : '' ?>>

                        <?php elseif ($field['field_type'] === 'dropdown'): ?>
                            <select
                                name="<?= esc($field['field_name']) ?>"
                                class="form-control">
                                <?php foreach (explode(',', $field['field_options']) as $opt): ?>
                                    <option value="<?= esc(trim($opt)) ?>">
                                        <?= esc(trim($opt)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-primary">
                    Submit Registration
                </button>
            </form>


        </div>



    </div>

</div>

<?php
include_once APPPATH . 'Views/layouts/footer.php';
?>