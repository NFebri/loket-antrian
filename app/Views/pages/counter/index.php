<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<h1 class="mb-3">Loket</h1>
<a href="<?= route_to('counters_create') ?>" class="btn btn-primary my-3">Create</a>

<?= $this->include('components/flash-message'); ?>

<table class="table table-sm" id="counters-table">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Penanggung Jawab</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($counters as $counter): ?>
            <tr>
                <td><?= htmlspecialchars($counter->name) ?></td>
                <td><?= htmlspecialchars($counter->username) ?></td>
                <td>
                    <a href="<?= route_to('counters_edit', $counter->id) ?>" class="btn btn-info btn-sm">
                        Edit
                    </a>
                    <form class="d-inline" action="<?= route_to('counters_destroy', $counter->id) ?>" method="POST" onsubmit="return confirm('Are you sure?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection(); ?>
