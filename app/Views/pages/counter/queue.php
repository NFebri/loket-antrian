<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<h1 class="mb-3">Antrian</h1>

<div class="row justify-content-center">
    <div class="col-md-6 mb-5">
        <div class="card w-75">
            <div class="card-header text-center"><?= htmlspecialchars($counter->name) ?></div>
            <div class="card-body text-center my-5">
                <h1 id="current_queue"><?= isset($queue->current_queue) ? htmlspecialchars($queue->current_queue) : '--' ?></h1>
            </div>
            <div class="card-footer">
                <?php if(isset($queue) && ($queue->current_queue != 0)): ?>
                    <button type="button" id="play" class="btn btn-sm btn-primary">Panggil</button>
                <?php endif; ?>
                <?php if(isset($queue) && ($queue->current_queue != $queue->total_queue)): ?>
                    <a href="<?= route_to('counters_next-queue', $counter->id) ?>" class="btn btn-sm btn-info">Antrian selanjutnya</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card w-75">
            <div class="card-header text-center">Total Antrian</div>
            <div class="card-body text-center my-5">
                <h1><?= isset($queue->total_queue) ? htmlspecialchars($queue->total_queue) : '--' ?></h1>
            </div>
            <div class="card-footer">
                <a href="<?= route_to('counters_add-queue', $counter->id) ?>" class="btn btn-sm btn-info">Tambah / Cetak Antrian</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // Initialize new SpeechSynthesisUtterance object
    let speech = new SpeechSynthesisUtterance();

    // Set Speech Language
    speech.lang = "en";
    window.speechSynthesis.onvoiceschanged = () => {
        // Initially set Indonesian voice.
        speech.voice = window.speechSynthesis.getVoices()[11];
    };

    const textToSpeech = (text) => {
        speech.rate = 1;
        speech.volume = 1;
        speech.pitch = 1;
        speech.text = text;

        // Start Speaking
        window.speechSynthesis.speak(speech);
    }

    $("#play").click(() => {
        textToSpeech(`nomor antrian, ${$('#current_queue').html()}`);
    });
</script>
<?= $this->endSection(); ?>
