<?= $this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
)) ?>

<?= $this->Html->script('timer.js') ?>

<!-- Ajout du bloc pour les messages flash -->
<div class="row">
    <div class="col">
        <?= $this->Flash->render() ?>
    </div>
</div>

<div class="container text-center">
    <h1 class='mb-3'><?= h($video->title) ?></h1>
    <div class="row align-items-center">
        <video id="video" autoplay=true controls data-next-video="<?= $this->Url->build(['controller' => 'Assessments', 'action' => 'review', $video->id, $assessmentId]); ?>">
            <source src="https://canne.tv/replay/video/3513/A/2022-01-21_10-20-00___2022-01-21_10-34-18.mp4" type="video/mp4" style='width:100%' />
        </video>
    </div>

    <div id="points-button" class="row justify-content-between">
        <div class="col-auto">
            <div type="button" class="btn btn-danger btn-lg p-0">
                <?= $this->Form->create(null, ['id' => 'point_form_red']) ?>
                <?= $this->Form->hidden('color_point', ['value' => 'red']) ?>
                <?= $this->Form->hidden('video_id', ['value' => $video->id]) ?>
                <?= $this->Form->hidden('current_time', ['id' => 'current_time_red']); ?>
                <?= $this->Form->button($points['red'], ['id' => 'redButton', 'class' => 'btn btn-danger px-5 fw-bold']) ?>
                <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="col-auto">
            <p>Vous pouvez utiliser les touches <strong>q</strong> et <strong>m</strong> de votre clavier</p>
        </div>

        <div class="col-auto">
            <div type="button" class="btn btn-primary btn-lg p-0">
                <?= $this->Form->create(null, ['id' => 'point_form_blue']) ?>
                <?= $this->Form->hidden('color_point', ['value' => 'blue']) ?>
                <?= $this->Form->hidden('video_id', ['value' => $video->id]) ?>
                <?= $this->Form->hidden('current_time', ['id' => 'current_time_blue']); ?>
                <?= $this->Form->button($points['blue'], ['id' => 'blueButton', 'class' => 'btn btn-primary px-5 fw-bold']) ?>
                <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]); ?>
                <?= $this->Form->end() ?>     
            </div>
        </div>
    </div>

    <div>
        <div id="flagContainer"></div>
        <div id="timeProgress" class="progress bg-secondary mx-auto mt-4">
        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>
