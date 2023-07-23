<?= $this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
)) ?>

<?= $this->Html->script('timer.js') ?>


<div class="container text-center">
    <h1 class='mb-5'><?= h($video->title) ?></h1>

    <div class="row align-items-center">
        <div class="col">
            <video id="video" src="https://canne.tv/replay/video/3513/A/2022-01-21_10-20-00___2022-01-21_10-34-18.mp4" type="video/mp4" controls></video>
        </div>
        <div class="col align-self-center">
            <div type="button" class="btn btn-danger btn-lg">
                <?= $this->Form->create(null, ['id' => 'point_form_red']) ?>
                <?= $this->Form->hidden('color_point', ['value' => 'red']) ?>
                <?= $this->Form->hidden('video_id', ['value' => $video->id]) ?>
                <?= $this->Form->hidden('assessment_id', ['value' => $assessmentId]) ?>
                <?= $this->Form->hidden('current_time', ['id' => 'current_time_red']); ?>
                <?= $this->Form->button($points['red'], ['id' => 'redButton', 'class' => 'btn btn-danger']) ?>
                <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="col align-self-center">
            <div type="button" class="btn btn-primary btn-lg">
                <?= $this->Form->create(null, ['id' => 'point_form_blue']) ?>
                <?= $this->Form->hidden('color_point', ['value' => 'blue']) ?>
                <?= $this->Form->hidden('video_id', ['value' => $video->id]) ?>
                <?= $this->Form->hidden('assessment_id', ['value' => $assessmentId]) ?>
                <?= $this->Form->hidden('current_time', ['id' => 'current_time_blue']); ?>
                <?= $this->Form->button($points['blue'], ['id' => 'blueButton','class' => 'btn btn-primary']) ?>
                <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <div class="progress bg-secondary mx-auto mt-4" style="height: 30px;">
        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        </div>
    </div>
</div>