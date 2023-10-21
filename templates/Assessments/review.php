<?php
// pr($assessments->toArray());

$this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
)) ?>

<!-- Ajout du bloc pour les messages flash -->
<div class="row">
    <div class="col">
        <?= $this->Flash->render() ?>
    </div>
</div>

<div class="container text-center">
    <?php foreach ($videos as $video) : ?>
        <h1><?= h($video->title) ?></h1>
    <?php endforeach ?>

    <div class="row align-items-center">
        <video id="video" autoplay controls>
            <source src="https://canne.tv/replay/video/3513/A/2022-01-21_10-20-00___2022-01-21_10-34-18.mp4" type="video/mp4" style='width:100%' />
        </video>
    </div>

    <div id="points-button" class="row align-items-center">
        <div class="col align-self-center">
            <div type="button" class="btn btn-danger btn-lg">
                <?= $this->Form->create(null, ['id' => 'point_form_red']) ?>
                <!-- <?= $this->Form->hidden('video_id', ['value' => $assessment->video_id]) ?> -->
                <?= $this->Form->button($points['red'], ['id' => 'redButton', 'class' => 'btn btn-danger']) ?>
                <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="col align-self-center">
            <div type="button" class="btn btn-primary btn-lg">
                <?= $this->Form->create(null, ['id' => 'point_form_blue']) ?>
                <!-- <?= $this->Form->hidden('video_id', ['value' => $assessment->video_id]) ?> -->
                <?= $this->Form->button($points['blue'], ['id' => 'blueButton', 'class' => 'btn btn-primary']) ?>
                <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <div>
        <div id="flagContainer">
            <?php foreach ($flagPoints as $point) : ?>
                <div class="point-flag <?= h($point['color']) ?>" style="left: <? $point['position'] ?>%"></div>
            <?php endforeach; ?>
        </div>
        <div id="timeProgress" class="progress bg-secondary mx-auto mt-4"">
            <div id=" progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>
</div>