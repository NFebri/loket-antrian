<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<h1 class="mb-3">Tambah Loket</h1>
<form action="<?= route_to('counters_store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-group">
        <label for="name">name</label>
        <input type="text" name="name" class="form-control<?= session('errors.name') ? ' is-invalid' : '' ?>" id="name" value="<?= old('name') ?>">
        <div class="invalid-feedback">
            <?= session('errors.name'); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="user_id">Penanggung Jawab</label>
        <select name="user_id" class="custom-select<?= session('errors.user_id') ? ' is-invalid' : '' ?>" id="user_id">
            <?php foreach($users as $user): ?>
                <option value="<?= $user->id ?>"><?= htmlspecialchars($user->username) ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
        <?= session('errors.user_id'); ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
<?= $this->endSection(); ?>
