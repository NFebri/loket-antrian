<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<h1 class="mb-3">Tambah Loket</h1>
<form action="<?= route_to('counters_update', $counter->id) ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= $counter->id ?>">
    <div class="form-group">
        <label for="name">name</label>
        <input type="text" name="name" class="form-control<?= session('errors.name') ? ' is-invalid' : '' ?>" id="name" value="<?= old('name') ?? $counter->name ?>">
        <div class="invalid-feedback">
            <?= session('errors.name'); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="user_id">Penanggung Jawab</label>
        <select name="user_id" class="custom-select<?= session('errors.user_id') ? ' is-invalid' : '' ?>" id="user_id">
            <?php foreach($users as $user): ?>
                <option value="<?= $user->id ?>"<?= $user->id == $counter->user_id ? ' selected' : '' ?>><?= htmlspecialchars($user->username) ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
        <?= session('errors.user_id'); ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
<?= $this->endSection(); ?>
