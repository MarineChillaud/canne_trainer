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