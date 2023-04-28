<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<h1 class="mb-3">Loket</h1>

<div class="row justify-content-center">
    <?php foreach($data as $item): ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center"><?= htmlspecialchars($item['name']) ?></div>
                <div class="card-body text-center my-5">
                    <h1 id="<?= 'current_queue_' . $item['id'] ?>"><?= htmlspecialchars($item['current_queue']) ?></h1>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    const counterQueue = () => {
        $.ajax({
            url: "<?= route_to('counter_queue') ?>",
            success:function(data){
                JSON.parse(data).forEach(item => {
                    $(`#current_queue_${item.id}`).text(item.current_queue);
                });
            }
        })
    }

    setInterval(() => {
        counterQueue()
    }, 3000);
</script>
<?= $this->endSection(); ?>
